<?php
session_start();
include("../../scripts/conn.php");

$currentQuestion = $_GET['q'];
$grabQuestions = "SELECT * FROM question";
$ourQuestions = $conn->query($grabQuestions);

while ($row = $ourQuestions->fetch_assoc()) {
    echo("<a href='?q=" . $row['questionID'] . "' class='leftQuestionLink");

    if ($row['questionID'] === $currentQuestion) {
        echo(" active");
    }

    echo("'><div class='questionLeftSideBox'><p class='questionLeftSide'>Question #" . $row['questionID'] . "</p>
        </div></a>
    ");
}


?>