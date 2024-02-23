<?php 
session_start();
include("../../scripts/conn.php");

$repID = $_GET['num'];
$user = $_GET['u'];

$grabReportSQL = "UPDATE user SET isVerified = 1 WHERE userID = '$user' ";
$processReport = $conn->query($grabReportSQL);

$deleteVerificationSQL = "DELETE FROM verification where verificationID = '$repID'";
$processReport = $conn->query($deleteVerificationSQL);

header("location: ../")

?>