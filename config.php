<?php
// Database configuration
$host = 'localhost';
$username = 'root';
$password = '';
$dbname = 'iiuc_library';

// Create a database connection
$conn = new mysqli($host, $username, $password, $dbname);

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
