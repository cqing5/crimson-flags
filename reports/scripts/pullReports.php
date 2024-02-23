<?php 
session_start();
include('../conn.php');


$repNum = $_GET['reportNum'];
$grabMatchRequests = "SELECT * FROM reports";
$ourMatchRequests = $conn->query($grabMatchRequests);

while ($row = $ourMatchRequests->fetch_assoc()) {
    echo("<a class='leftReportOptionLink");
    
    if ($row['reportID'] === $repNum) {
        echo(" active");
    }

    
    echo("' href='?reportNum=".$row['reportID']."'>
        Report #".$row['reportID']."</a>");

}
?>