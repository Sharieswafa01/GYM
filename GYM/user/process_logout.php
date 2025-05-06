<?php
session_start();

// Check if user_id is empty
if (empty($_POST['user_id'])) {
    $_SESSION['notification'] = "Please fill out this field";
    $_SESSION['notification_type'] = "error";
    header("Location: user_login.php");
    exit();
}

// Capture necessary info before destroying session
$logoutTime = date("Y-m-d H:i:s");
$name       = $_SESSION['name'] ?? 'N/A';
$age        = $_SESSION['age'] ?? 'N/A';
$gender     = $_SESSION['gender'] ?? 'N/A';
$type       = $_SESSION['type'] ?? 'N/A';

// Clear session
session_unset();
session_destroy();

// Start fresh session and restore logout info
session_start();
$_SESSION['logout_time'] = $logoutTime;
$_SESSION['name']        = $name;
$_SESSION['age']         = $age;
$_SESSION['gender']      = $gender;
$_SESSION['type']        = $type;

// Notification
$_SESSION['notification'] = "Logout Successful";
$_SESSION['notification_type'] = "logout-success";

// Redirect back to login page
header("Location: user_login.php");
exit();
