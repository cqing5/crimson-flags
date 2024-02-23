<?php
$servername = "db.luddy.indiana.edu";
$username = "i494f21_team01";
$password = "my+sql=i494f21_team01";
$database = "i494f21_team01";

// Create connection
$conn = new mysqli($servername, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
?>