<?php
// Include your database connection
require_once 'db_connection.php'; // Adjust the path if needed

// Get the field and value from the AJAX request
$field = $_POST['field'] ?? '';
$value = $_POST['value'] ?? '';

// Define allowed fields to prevent SQL injection
$allowed_fields = ['email', 'phone', 'student_id'];

// Validate input
if (empty($field) || empty($value) || !in_array($field, $allowed_fields)) {
    echo 'invalid';
    exit;
}

// Construct the query dynamically using allowed fields
$query = "SELECT COUNT(*) FROM users WHERE $field = ?";

$stmt = $conn->prepare($query);

if ($stmt) {
    $stmt->bind_param("s", $value);
    $stmt->execute();
    $stmt->bind_result($count);
    $stmt->fetch();
    $stmt->close();

    echo ($count > 0) ? 'exists' : 'available';
} else {
    echo 'error';
}
?>



