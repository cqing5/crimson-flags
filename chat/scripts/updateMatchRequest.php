<?php
session_start();
include('../conn.php');
$mID = $_GET['mID'];
$approveDeny = $_GET['AD'];


if ($approveDeny === "approve") {
    $sql = "UPDATE matches SET approveDenyPending = 'approved' WHERE matchID = '$mID'";
    $conn->query($sql);

    //get user ID's for notification
    $getUserSQL = "SELECT * from matches WHERE matchID = '$mID'";
    $getUser = $conn->query($getUserSQL);
    while ($row = $getUser->fetch_assoc()) {
        $fromUser = $row['fromUserID'];
        $toUser = $row['toUserID'];

        //add notification
        $addNotifSQL = "INSERT INTO notification (userID, notificationType, notificationMsg, senderID) VALUES ('$fromUser','regular','Your match request has been accepted!','$toUser')";
        $conn->query($addNotifSQL);
    }
    header('Location: ../../chat/?r=1');
}
elseif ($approveDeny === "deny") {
    $sql = "UPDATE matches SET approveDenyPending = 'denied' WHERE matchID = '$mID'";
    $conn->query($sql);
    header('Location: ../../chat/?r=1');

}
else {

    header('Location: ../../chat/?r=1');
}

?>