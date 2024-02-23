<?php
session_start();
include '../../scripts/conn.php';
//replace with session data eventually
$ourUser = $_SESSION['sessionUserID'];

if (isset($_POST['addMatchFromPhone'])) {
    $email = $_POST['email'];
    $phone = $_POST['phone'];

    //if both are empty redirect back to matches
    if ((empty($email)) && (empty($phone))) {
        header("location: ../?error=NoUser");
    }


    //check email valid first
    if (!empty($email)) {
        $findUserWeAreRequestingSQL = "SELECT * from user WHERE email = '$email'";
        $getFindUserWeAreRequesting = $conn->query($findUserWeAreRequestingSQL);
        $sendTo = $getFindUserWeAreRequesting->fetch_assoc();

        $sendNotif = ($sendTo['userID']);
        if (mysqli_num_rows($getFindUserWeAreRequesting) > 0) {
            //send notification to user

            $notificationSQL = "INSERT INTO notification (userID, notificationType, notificationMsg, senderID) VALUES ('$sendNotif', 'regular', 'You have a new match request', '$ourUser')";
            //insert the data
            if ($conn->query($notificationSQL) === TRUE) {
                echo('it works');
            }
            else {
                echo "Error: " . $notificationSQL . "<br>" . $conn->error;
            }
            $sendToUserID = $sendTo['userID'];
            handleMatchRequest($sendToUserID, $ourUser);
            exit();
        }
        else {
            header("location: ../?error=NoUser ");
        }
    }

    //check phone valid
    if (!empty($phone)) {
        $findUserWeAreRequestingSQL = "SELECT * from user WHERE phone = '$phone'";
        $getFindUserWeAreRequesting = $conn->query($findUserWeAreRequestingSQL);
        $sendTo = $getFindUserWeAreRequesting->fetch_assoc();

        echo($sendTo['userID']);
        if (mysqli_num_rows($getFindUserWeAreRequesting) > 0) {
            $sendToUserID = $sendTo['userID'];
            handleMatchRequest($sendToUserID, $ourUser);
            exit();
        }
        else {
            header("location: ../?error=NoUser ");
        }
    }

}
else {
    header("location: ../?error=NoUser");
}



function handleMatchRequest($userWeAreSendingAMatchRequestTo, $userWeAre)
{

    //Conncect to Database
    include("../../scripts/conn.php");

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
        header("location: ../?error=alreadyExists");
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
            header("location: ../?success=matchadded");
        }
        else {
            echo "Error: " . $insertNewMatchRequestSQL . "<br>" . $conn->error;
        }



    }
}

?>