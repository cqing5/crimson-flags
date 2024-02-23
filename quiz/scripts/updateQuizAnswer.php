<?php 
session_start();

include('../../scripts/conn.php');

$currentUser = $_SESSION['sessionUserID'];
$currentQuestion = $_GET['q'];
$nextQuestion = $currentQuestion + 1;


if (isset($_POST['submit'])) {
    $ourValue = $_POST['inputOption'];
    $sql = "UPDATE answer SET userAnswer = '$ourValue' WHERE userID = '$currentUser' AND questionID = '$currentQuestion'";

    if ($conn->query($sql) === TRUE) {
        echo "New record created successfully";
      } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    if($currentQuestion === '20') {
      header("Location: ../../matches/");
    } else {
      header("Location: ../index.php?q=$nextQuestion");
    }
    

}

?>