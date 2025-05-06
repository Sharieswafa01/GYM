<?php
$servername = "localhost";  // Adjust this based on your database server
$username = "root";  // Your database username
$password = "";  // Your database password
$dbname = "gym_management";  // Your database name

// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
?>
