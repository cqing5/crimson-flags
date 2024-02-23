<?php

session_start();

include('../../scripts/conn.php');


$currentQuestion = $_GET['q'];




if (isset($_POST['submit'])) {
    $name = $_POST['questionName'];
    $tier = $_POST['tier'];
    $option1 = $_POST['option1'];
    $option2 = $_POST['option2'];
    $option3 = $_POST['option3'];
    $option4 = $_POST['option4'];
    $option5 = $_POST['option5'];




    $sql = "UPDATE question SET question = '$name', tierNumber = '$tier', answerChoice1 = '$option1', answerChoice2 = '$option2', answerChoice3 = '$option3', answerChoice4 = '$option4', answerChoice5 = '$option5' WHERE questionID = '$currentQuestion'";

    if ($conn->query($sql) === TRUE) {
        echo "New record created successfully";
    }
    else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
    header("Location: ../index.php?q=$currentQuestion");




}

?>