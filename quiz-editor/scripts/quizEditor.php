<?php
session_start();
include("../../scripts/conn.php");

$currentQuestion = $_GET['q'];

$grabQuestions = "SELECT * FROM question WHERE questionID = '$currentQuestion'";
$ourQuestions = $conn->query($grabQuestions);

$row = $ourQuestions->fetch_assoc();

echo("<div class='question'>
        <form method='POST' action='scripts/updateQuizQuestion.php?q=" . $currentQuestion . "'>
            <div>
            <label>Question #" . $row['questionID'] . ":</label>
            <input type='text' value='" . $row['question'] . "' name='questionName'>
            </div>

            <div>
            <label>Question Tier:</label>
            <select name='tier'>");

if ($row['tierNumber'] === '1') {
    echo("<option value='1' selected>Red Flag Question</option>
                <option value='2'>Regular Question</option>");
}
else {
    echo("<option value='1'>Red Flag Question</option>
                <option value='2' selected>Regular Question</option>");
}

echo("
            </select>
            </div>

            <div class='options'>
            <div>
            <label>Option 1:</label>
            <input type='text' value='" . $row['answerChoice1'] . "' name='option1'>
            </div>

            <div>
            <label>Option 2:</label>
            <input type='text' value='" . $row['answerChoice2'] . "' name='option2'>
            </div>
            
            <div>
            <label>Option 3:</label>
            <input type='text' value='" . $row['answerChoice3'] . "' name='option3'>
            </div>
            
            <div>
            <label>Option 4:</label>
            <input type='text' value='" . $row['answerChoice4'] . "' name='option4'>
            </div>

            <div>
            <label>Option 5:</label>
            <input type='text' value='" . $row['answerChoice5'] . "' name='option5'>
            </div>
            </div>

            <button type='submit' id='submit' name='submit'>Update Question</button>
        </form>

");
echo("</div>");

?>