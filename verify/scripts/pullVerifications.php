<?php 
session_start();
include('../../conn.php');


$verifyNum = $_GET['verificationNum'];
$grabMatchRequests = "SELECT * FROM verification";
$ourMatchRequests = $conn->query($grabMatchRequests);

while ($row = $ourMatchRequests->fetch_assoc()) {
    echo("<a class='leftVerifyOptionLink");
    
    if ($row['verificationID'] === $verifyNum) {
        echo(" active");
    }

    
    echo("' href='?verificationNum=".$row['verificationID']."'>
        Request #".$row['verificationID']."</a>");

}
?>