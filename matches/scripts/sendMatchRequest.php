<?php
session_start();
//Conncect to Database
include("../../scripts/conn.php");

//eventually pull from session
$ourUser = $_GET['u1'];
$otherUser = $_GET['u2'];


handleMatchRequest($otherUser, $ourUser);


function handleMatchRequest($userWeAreSendingAMatchRequestTo, $userWeAre)
{

    //Conncect to Database
    include("../../scripts/conn.php");

    //send notification to user
    $notificationSQL = "INSERT INTO notification (userID, notificationType, notificationMsg, senderID) VALUES ('$userWeAreSendingAMatchRequestTo', 'regular', 'You have a new match request', '$userWeAre')";
    //insert the data
    if ($conn->query($notificationSQL) === TRUE) {
        echo('it works');
    }
    else {
        echo "Error: " . $notificationSQL . "<br>" . $conn->error;
    }

    //see if a match request between these users already exists
    $checkCurrentMatchRequestsSQL =
        "SELECT * from matches WHERE 
    (fromUserID = '$userWeAre' OR fromUserID = '$userWeAreSendingAMatchRequestTo') 
    AND 
    (toUserID = '$userWeAreSendingAMatchRequestTo' OR toUserID = '$userWeAre')";


    //parse the sql statement to see if this pair already exists in the system
    $checkForCurrentMatchPair = $conn->query($checkCurrentMatchRequestsSQL);


    //if it already exists ...
    if (mysqli_num_rows($checkForCurrentMatchPair) > 0) {
        header("location: ../../?error=alreadyExists");
    }
    else {

        // Change the line below to your timezone!
        date_default_timezone_set('America/Indianapolis');
        $date = date('m-d-Y H:i:s', time());

        //insert new data
        $insertNewMatchRequestSQL = "INSERT INTO matches 
        (fromUserID, toUserID, approveDenyPending, timeSent) VALUES
        ('$userWeAre', '$userWeAreSendingAMatchRequestTo', 'pending', STR_TO_DATE('$date', '%m-%d-%Y %H:%i:%s'))";

        //insert the data
        if ($conn->query($insertNewMatchRequestSQL) === TRUE) {
            header("location: ../../?success=matchadded");
        }
        else {
            echo "Error: " . $insertNewMatchRequestSQL . "<br>" . $conn->error;
        }



    }
}

?>