<?php
session_start();
include("../../scripts/conn.php");

$receiver = $_GET['m'];


//EVENTUALLY ADD SESSION DATA
$sender = $_SESSION['sessionUserID'];


if (isset($_POST['sendTheMessageToThePerson'])) {

    $messageText = $_POST["sendMessageText"];



    echo('test4');
    // Change the line below to your timezone!
    date_default_timezone_set('America/Indianapolis');
    $date = date('m-d-Y H:i:s', time());
    echo($date);

    echo('test5');

    $sql = "INSERT INTO messages (sender, receiver, receiveTime, messageText) VALUES ('$sender','$receiver', STR_TO_DATE('$date', '%m-%d-%Y %H:%i:%s'),'$messageText')";

    if ($conn->query($sql) === TRUE) {
        header("location: ../?m=$receiver");
    }
    else {
        echo "Error: " . $insertNewMatchRequestSQL . "<br>" . $conn->error;
    }
}



?>