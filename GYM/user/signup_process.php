<?php
session_start();
include 'config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $first_name  = $_POST['first_name'];
    $last_name   = $_POST['last_name'];
    $age         = $_POST['age'];
    $gender      = $_POST['gender'];
    $email       = $_POST['email'];
    $phone       = $_POST['phone'];
    $role        = $_POST['type'];

    $student_id = $course = $section = null;
    $customer_id = $payment_plan = $services = null;

    if ($role === 'Student') {
        $student_id = $_POST['student_id'] ?? null;
        $course     = $_POST['course'] ?? null;
        $section    = $_POST['section'] ?? null;
    } elseif ($role === 'Customer') {
        $customer_id  = $_POST['customer_id'] ?? strval(mt_rand(1000000, 9999999));
        $payment_plan = $_POST['payment_plan'] ?? null;
        $services     = $_POST['services'] ?? null;
    }

    if (empty($first_name) || empty($last_name) || empty($age) || empty($gender) || empty($email) || empty($phone) || empty($role)) {
        die("All required fields must be filled.");
    }

    $check_query = "SELECT * FROM users WHERE email = ? OR phone = ?";
    $stmt = $conn->prepare($check_query);
    $stmt->bind_param("ss", $email, $phone);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($result->num_rows > 0) {
        header("Location: user_login.php");
        exit();
    }

    $query = "INSERT INTO users 
        (first_name, last_name, age, gender, email, phone, role, student_id, course, section, customer_id, payment_plan, services) 
        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

    $stmt = $conn->prepare($query);
    if (!$stmt) {
        die("Error preparing statement: " . $conn->error);
    }

    $stmt->bind_param("ssissssssssss", $first_name, $last_name, $age, $gender, $email, $phone, $role,
        $student_id, $course, $section, $customer_id, $payment_plan, $services);

    if ($stmt->execute()) {
        if ($role === 'Customer') {
            $subject = "Your Gym Customer ID";
            $message = "Dear $first_name $last_name,\n\nYour Customer ID is: $customer_id\nUse it to log in.\n\nThank you!";
            $headers = "From: noreply@ctudanaogym.com";
            mail($email, $subject, $message, $headers);
        }

        header("Location: user_login.php");
        exit();
    } else {
        die("Database error: " . $stmt->error);
    }

    $stmt->close();
    $conn->close();
}
?>
