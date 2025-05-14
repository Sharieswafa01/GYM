<?php
session_start();
include 'db_connection.php';
date_default_timezone_set('Asia/Manila');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user_id = trim($_POST['user_id']);

    if (empty($user_id)) {
        $_SESSION['message'] = "Please enter an ID number.";
        $_SESSION['message_type'] = "error";
        header("Location: user_login.php");
        exit();
    }

    if (isset($_SESSION['user_id']) && $_SESSION['user_id'] === $user_id) {
        $_SESSION['message'] = "You're already logged in.";
        $_SESSION['message_type'] = "error";
        header("Location: user_login.php");
        exit();
    }

    $query = "SELECT * FROM users WHERE student_id = ? OR customer_id = ? OR faculty_id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("sss", $user_id, $user_id, $user_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 1) {
        $user = $result->fetch_assoc();

        // Store session values
        $_SESSION['user_id'] = $user_id;
        $_SESSION['name'] = $user['first_name'] . " " . $user['last_name'];
        $_SESSION['age'] = $user['age'];
        $_SESSION['gender'] = $user['gender'];
        $_SESSION['login_time'] = date("Y-m-d h:i:s A");

        // Determine role
        if ($user['student_id'] === $user_id) {
            $_SESSION['type'] = 'Student';
            $_SESSION['course'] = $user['course'];
            $_SESSION['section'] = $user['section'];
        } elseif ($user['customer_id'] === $user_id) {
            $_SESSION['type'] = 'Customer';
        } elseif ($user['faculty_id'] === $user_id) {
            $_SESSION['type'] = 'Faculty';
        }

        // Insert into attendance table
        $loginTime = date("Y-m-d H:i:s");
        $internalId = $user['id'];
        $insert = $conn->prepare("INSERT INTO attendance (user_id, status, login_time) VALUES (?, 'Login', ?)");
        $insert->bind_param("is", $internalId, $loginTime);
        $insert->execute();

        $_SESSION['notification'] = "Login Successful";
        $_SESSION['notification_type'] = "login-success";
    } else {
        $_SESSION['message'] = "Invalid ID. Please try again.";
        $_SESSION['message_type'] = "error";
    }

    header("Location: user_login.php");
    exit();
}
?>
