<?php
session_start();
include("../../scripts/conn.php");

$repID = $_GET['num'];

$grabReportSQL = "DELETE FROM reports where reportID = '$repID'";
$processReport = $conn->query($grabReportSQL);

header("location: ../")



?>