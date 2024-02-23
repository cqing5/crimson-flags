<?php
session_start();
include('../scripts/conn.php');

$currentUser = $_SESSION['sessionUserID'];
$bannedUser = $_GET['rUser'];

// update database
    $sql = "UPDATE user SET isBanned = 1 WHERE userID = '$bannedUser'";

    if ($conn->query($sql) === TRUE) {
        echo "New record created successfully";
      } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
    header("location: ../home/?success=banned");
?>