<?php
session_start();
include('../../scripts/conn.php');

$reviewingUser = $_SESSION['sessionUserID'];
$reviewedUser = $_GET['rUser'];

if (isset($_POST['submit'])) {
    $reviewText = $_POST['review-txt'];

    $sql = "INSERT INTO reviews (userID, reviewedUserID, reviewDesc) VALUES ('$reviewingUser', '$reviewedUser', '$reviewText')";

    if ($conn->query($sql) === TRUE) {
        echo "New record created successfully";
      } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
    header("location: ../../home/?success=review");

}
?>
