<?php
session_start();
include('../scripts/conn.php');

// users 
$unmatchingUser = $_SESSION['sessionUserID'];
$unmatchedUser = $_GET['rUser'];

// delete from database
    $user_check_query = "DELETE FROM matches WHERE fromUserID='$unmatchingUser' and toUserID='$unmatchedUser' or fromUserID='$unmatchedUser' and toUserID='$unmatchingUser'";

// if / else to tell what to do if works vs not 
    if ($conn->query($user_check_query) === TRUE) {
        echo("Records Deleted successfully");
    }
    else {
        echo("Error: ".$user_check_query."<br>".$conn->error);
    }
    
    //return user to page
    header("location: ../home/?success=unmatch");
    // header("location: ../");


?>