<?php
session_start();
include('../conn.php');

//pull from session eventually
$ourUser = $_SESSION['sessionUserID'];

$grabMatchRequests = "SELECT * FROM matches WHERE toUserID = '$ourUser' AND approveDenyPending = 'pending'";
$ourMatchRequests = $conn->query($grabMatchRequests);

while ($row = $ourMatchRequests->fetch_assoc()) {
    $senderID = $row['fromUserID'];


    $senderInformationSQL = "SELECT * FROM user WHERE userID = '$senderID'";
    $grabSenderInfo = $conn->query($senderInformationSQL);
    $info = $grabSenderInfo->fetch_assoc();

    echo("<div class='requestsInboxMatch'>
    <div class='requestsInboxLeft'>
      <div class='requestsInboxProfilePicture'>
        <a href='../profile/?user=" . $info['userName'] . "'>
        <img src='" . $info['profilePicture'] . "' alt='profile picture' onerror='this.src=`https://www.srikiran.org/wp-content/uploads/2021/07/new_Avatar-Blank-Profile-Picture-Display-Pic-Mystery-Man-973460.png`'>
        </a>
        </div>
    </div>
    <div class='requestsInboxRight'>
      <p class='matchName'>" . $info['fname'] . " " . $info['lname'] . "</p>
      <div class='accept-or-decline'>
        <a href='scripts/updateMatchRequest.php?AD=approve&mID=" . $row['matchID'] . "' class='accept'>Accept</a>
        <a href='scripts/updateMatchRequest.php?AD=deny&mID=" . $row['matchID'] . "' class='decline'>Decline</a>
      </div>
    </div>
  </div>");
}

?>