<?php
// Database configuration
$db_host = 'localhost';
$db_user = 'root'; // Default user for XAMPP/WAMP/MAMP
$db_pass = '';     // Default password is empty
$db_name = 'connect_four_db';

// Create connection
$conn = new mysqli($db_host, $db_user, $db_pass, $db_name);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
