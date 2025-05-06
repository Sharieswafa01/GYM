<?php 
session_start();
include 'db_connection.php';

// Set the timezone to Philippine Time (UTC +8)
date_default_timezone_set('Asia/Manila');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user_id = trim($_POST['user_id']);

    // Check if user is already logged in
    if (isset($_SESSION['user_id'])) {
        $_SESSION['message'] = "You're already logged in!";
        header("Location: user_login.php");
        exit();
    }

    $query = "SELECT * FROM users WHERE student_id = ? OR customer_id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("ss", $user_id, $user_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();

        $_SESSION['user_id'] = $user_id;
        $_SESSION['name'] = $user['first_name'] . " " . $user['last_name'];
        $_SESSION['age'] = $user['age'];
        $_SESSION['gender'] = $user['gender'];
        $_SESSION['type'] = $user['type'];

        // Set login time to 12-hour format with Filipino time zone (Asia/Manila)
        $_SESSION['login_time'] = date("Y-m-d h:i:s A");

        // Clear logout time if exists
        unset($_SESSION['logout_time']);

        // Notification
        $_SESSION['notification'] = "Login Successful";
        $_SESSION['notification_type'] = "login-success";

        header("Location: user_login.php");
        exit();
    } else {
        // Invalid ID
        $_SESSION['message'] = "Invalid ID. Please try again.";
        $_SESSION['message_type'] = "error";  // Optionally, you can set a message type for styling
        header("Location: user_login.php");
        exit();
    }
}
