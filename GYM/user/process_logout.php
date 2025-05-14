<?php
session_start();
include 'db_connection.php';
date_default_timezone_set('Asia/Manila');

$user_id = trim($_POST['user_id']);

if (empty($user_id)) {
    $_SESSION['message'] = "Please enter an ID number.";
    $_SESSION['message_type'] = "error";
    header("Location: user_login.php");
    exit();
}

if (!isset($_SESSION['user_id']) || $_SESSION['user_id'] !== $user_id) {
    $_SESSION['message'] = "Invalid ID. Please try again.";
    $_SESSION['message_type'] = "error";
    header("Location: user_login.php");
    exit();
}

// Verify user's ID in the database
$query = "SELECT * FROM users WHERE student_id = ? OR customer_id = ? OR faculty_id = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("sss", $user_id, $user_id, $user_id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 1) {
    $user = $result->fetch_assoc();
    $internalId = $user['id'];
    $logoutTime = date("Y-m-d H:i:s");

    // Update the latest login record for this user
    $update = $conn->prepare("UPDATE attendance SET status = 'Logout', logout_time = ? WHERE user_id = ? AND logout_time IS NULL ORDER BY id DESC LIMIT 1");
    $update->bind_param("si", $logoutTime, $internalId);
    $update->execute();

    // Save data before session ends
    $name = $_SESSION['name'] ?? 'N/A';
    $age = $_SESSION['age'] ?? 'N/A';
    $gender = $_SESSION['gender'] ?? 'N/A';
    $type = $_SESSION['type'] ?? 'N/A';
    $course = $_SESSION['course'] ?? 'N/A';
    $section = $_SESSION['section'] ?? 'N/A';

    session_unset();
    session_destroy();
    session_start();

    // Save logout data for display
    $_SESSION['logout_time'] = $logoutTime;
    $_SESSION['name'] = $name;
    $_SESSION['age'] = $age;
    $_SESSION['gender'] = $gender;
    $_SESSION['type'] = $type;
    $_SESSION['course'] = $course;
    $_SESSION['section'] = $section;

    $_SESSION['notification'] = "Logout Successful";
    $_SESSION['notification_type'] = "logout-success";
} else {
    $_SESSION['message'] = "Invalid ID.";
    $_SESSION['message_type'] = "error";
}

header("Location: user_login.php");
exit();
?>
