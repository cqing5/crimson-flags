<?php

//Conncect to Database
include("../../scripts/conn.php");

//eventually pull from session
$ourUser = $_GET['u1'];
$otherUser = $_GET['u2'];

$sql = "DELETE FROM matches WHERE fromUserID='$ourUser' AND toUserID='$otherUser'";
if ($conn->query($sql) === TRUE) {
    header("location: ../../?success=matchremoved");
}
else {
    echo "Error: " . $insertNewMatchRequestSQL . "<br>" . $conn->error;
}

?>