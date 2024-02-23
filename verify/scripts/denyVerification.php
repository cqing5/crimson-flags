<?php
session_start();
include("../../scripts/conn.php");

$repID = $_GET['num'];

$deleteVerificationSQL = "DELETE FROM verification where verificationID = '$repID'";
$processReport = $conn->query($deleteVerificationSQL);

header("location: ../")



?>