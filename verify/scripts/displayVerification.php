<?php
session_start();
include("../../scripts/conn.php");

$verificationID = $_GET['verificationNum'];

$grabReports = "SELECT * FROM verification WHERE verificationID = '$verificationID'";
$ourReports = $conn->query($grabReports);

$row = $ourReports->fetch_assoc();

$verificationUserID = $row['userID'];
$verificationReason = $row['description'];
$verificationPic = $row['proofOfIdentity'];


$grabReportedUserInfoSQL = "SELECT * FROM user where userID = '$verificationUserID'";
$repUserInfo = $conn->query($grabReportedUserInfoSQL);
$row = $repUserInfo->fetch_assoc();

$repUserFName = $row['fname'];
$repUserLName = $row['lname'];
$repUserBio = $row['bio'];
$repUserPic = $row['profilePicture'];
$repUserUName = $row['userName'];

echo("<div class='reportContainer'> 
        <a class='pic' href='../profile?user=$repUserUName'><img src='$repUserPic' alt='profile picture' onerror='this.src=`https://www.srikiran.org/wp-content/uploads/2021/07/new_Avatar-Blank-Profile-Picture-Display-Pic-Mystery-Man-973460.png`'></a>
        <h2>$repUserFName $repUserLName ($repUserUName)</h2> 
        <p>$repUserBio</p>

        <h3>Request Description:</h3>
        <p>$verificationReason</p>
        <div class='approve-deny-wrapper'>
        <a class='approve-verification' href='scripts/approveVerification.php?u=$verificationUserID&num=$verificationID'>Approve</a>
        <a class='deny-verification' href='scripts/denyVerification.php?num=$verificationID'>Deny</a>
        </div>
        <h4 class='view-image'>View Verification Image</h4>

        




</div>
<div class='modal-popup'>
<img src='../profile/$verificationPic' alt='request proof'></div>");



?>