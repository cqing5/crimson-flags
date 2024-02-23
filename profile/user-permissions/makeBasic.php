<?php
session_start();
include('../../scripts/conn.php');

$currentUser = $_SESSION['sessionUserID'];
$newAdmin = $_GET['rUser'];

    $sql = "UPDATE user SET isAdmin = 0 WHERE userID = $newAdmin";

    if ($conn->query($sql) === TRUE) {
        echo "New record created successfully";
      } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
    header("location: ../../home/?success=makeAdmin");

?>