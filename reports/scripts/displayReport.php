<?php
session_start();
include("../../scripts/conn.php");

$repID = $_GET['reportNum'];

$grabReports = "SELECT * FROM reports WHERE reportID = '$repID'";
$ourReports = $conn->query($grabReports);

$row = $ourReports->fetch_assoc();

$reportedUserID = $row['reportedUserID'];
$reporterUserID = $row['reporterUserID'];
$reportReason= $row['reasonForReport'];


$grabReportedUserInfoSQL = "SELECT * FROM user where userID = '$reportedUserID'";
$repUserInfo = $conn->query($grabReportedUserInfoSQL);
$row = $repUserInfo->fetch_assoc();

$repUserFName = $row['fname'];
$repUserLName = $row['lname'];
$repUserBio = $row['bio'];
$repUserPic = $row['profilePicture'];
$repUserUName = $row['userName'];

echo("<div class='reportContainer'> 
        <a href='../profile?user=$repUserUName'><img src='$repUserPic' alt='profile picture' onerror='this.src=`https://www.srikiran.org/wp-content/uploads/2021/07/new_Avatar-Blank-Profile-Picture-Display-Pic-Mystery-Man-973460.png`'></a>
        <h2>$repUserFName $repUserLName ($repUserUName)</h2> 
        <p>$repUserBio</p>

        <h3>Reported for:</h3>
        <p>$reportReason</p>

        <a href='scripts/removeReport.php?num=$repID' class='resolve'>Mark as Resolved</a>




</div>");



?>