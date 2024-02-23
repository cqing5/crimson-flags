<?php
session_start();
include('../../scripts/conn.php');

$currentUser = $_SESSION['sessionUserID'];
$reportedUser = $_GET['rUser'];

if (isset($_POST['submit'])) {
    $reportReason = $_POST['reason'];
    $reasonDesc = $_POST['reasonDesc'];
    $combinedReason = $reportReason . '-' . $reasonDesc;

    $sql = "INSERT INTO reports (userID, reportedUserID, reasonForReport) VALUES ('$currentUser', '$reportedUser', '$combinedReason')";

    if ($conn->query($sql) === TRUE) {
        echo "New record created successfully";
      } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
    header("location: ../../home/?success=report");

}
?>
