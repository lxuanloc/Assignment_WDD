<?php
$servername = "localhost";
$database = "testing";
$username = "root";
$password = "";

// Create connection
$conn = new mysqli('localhost', 'root', '');

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
echo "Connected successfully";
?>