<?php
session_start();
include("../../scripts/conn.php");

$currentUser = $_SESSION['sessionUserID'];
$currentQuestion = $_GET['q'];

$grabQuestions = "SELECT * FROM question WHERE questionID = '$currentQuestion'";
$ourQuestions = $conn->query($grabQuestions);

$row = $ourQuestions->fetch_assoc();

if($row['tierNumber'] === "1") {
    echo(
        "
        <div class='popup'>
    <h2>CRIMSON FLAG<br>QUESTION</h2>

  </div><div class='question redFlag'>
            <h2 class='redFlagHeading'>Crimson Flag</h2>
            <h3>".$row['questionID'].". ".$row['question']."</h3>
            <div class='formHolder'>");

                $checkIfAlreadyAnswered = "SELECT * FROM answer WHERE questionID = '$currentQuestion' AND userID = '$currentUser'";
                $isItAlreadyAnswered = $conn->query($checkIfAlreadyAnswered);
                $fetchRow = $isItAlreadyAnswered->fetch_assoc();
                if (mysqli_num_rows($isItAlreadyAnswered) > 0) {
                    echo("<form action='scripts/updateQuizAnswer.php?q=$currentQuestion' method='post'>
                    <ul>");
                        
                        if($fetchRow['userAnswer'] === "1") {
                            echo("<li><input class='inputOption' type='radio' name='inputOption' value='1' checked id='option1'></input>
                            <label for='option1'>".$row['answerChoice1']."</label></li>
                            <li><input class='inputOption' type='radio' name='inputOption' value='2' id='option2'></input>
                            <label for='option2'>".$row['answerChoice2']."</label></li>");
                        } else {
                            echo("<li><input class='inputOption' type='radio' name='inputOption' value='1' id='option1'></input>
                            <label for='option1'>".$row['answerChoice1']."</label></li>
                            <li><input class='inputOption' type='radio' name='inputOption' value='2' checked id='option2'></input>
                            <label for='option2'>".$row['answerChoice2']."</label></li>");
                        }
                        echo("
                    </ul>
                    <button type='submit' name='submit'>submit</button> 
                </form>");
                
                } else {
                    echo("<form action='scripts/addQuizAnswer.php?q=$currentQuestion' method='post'>
                    <ul>
                        <li><input class='inputOption' type='radio' name='inputOption' value='1' id='option1'></input>
                        <label for='option1'>".$row['answerChoice1']."</label></li>
                        <li><input class='inputOption' type='radio' name='inputOption' value='2' id='option2'></input>
                        <label for='option2'>".$row['answerChoice2']."</label></li>
                    </ul>
                    <button type='submit' name='submit'>submit</button> 
                </form>");
                }

            echo("</div>

            <div class='prevNext'>");
                if($currentQuestion > 1) {
                    echo("<a href='?q=".($currentQuestion - 1)." class='prev'>Previous</a>");
                }

                //numberOfQuestions pulls from count of question
                $numQues = "SELECT * from question";
                $numofQuesQuery = $conn->query($numQues);
                $numberOfQuestions = mysqli_num_rows($numofQuesQuery);

                if($currentQuestion < $numberOfQuestions) {
                echo("<a href='?q=".($currentQuestion + 1)."' class='next'>Next Question</a>");
                }
            echo("</div>
        </div>");

} elseif($row['tierNumber'] === "2") {
    echo(
        "<div class='question'>
            <h3>".$row['questionID'].". ".$row['question']."</h3>
            <div class='formHolder'>");


            $checkIfAlreadyAnswered = "SELECT * FROM answer WHERE questionID = '$currentQuestion' AND userID = '$currentUser'";
            $isItAlreadyAnswered = $conn->query($checkIfAlreadyAnswered);
            $fetchRow = $isItAlreadyAnswered->fetch_assoc();


            if (mysqli_num_rows($isItAlreadyAnswered) > 0) {
                echo("<form action='scripts/updateQuizAnswer.php?q=$currentQuestion' method='post'>
                <ul>");

                        //Option 1
                        echo("<li><input class='inputOption' type='radio' name='inputOption' value='1'  id='option1'"); 
                        if($fetchRow['userAnswer'] === "1") {
                            echo("checked");
                        }
                        echo("></input><label for='option1'>".$row['answerChoice1']."</label></li>");

                        //Option 2
                        echo("<li><input class='inputOption' type='radio' name='inputOption' value='2'  id='option2'"); 
                        if($fetchRow['userAnswer'] === "2") {
                            echo("checked");
                        }
                        echo("></input><label for='option2'>".$row['answerChoice2']."</label></li>");

                        //Option 3
                        if($row['answerChoice3'] != null) {
                            echo("<li><input class='inputOption' type='radio' name='inputOption' value='3'  id='option3'"); 
                            if($fetchRow['userAnswer'] === "3") {
                                echo("checked");
                            }
                            echo("></input><label for='option3'>".$row['answerChoice3']."</label></li>");
                        }

                        //Option 4
                        if($row['answerChoice4'] != null) {
                            echo("<li><input class='inputOption' type='radio' name='inputOption' value='4'  id='option4'"); 
                            if($fetchRow['userAnswer'] === "4") {
                                echo("checked");
                            }
                            echo("></input><label for='option4'>".$row['answerChoice4']."</label></li>");
                        }

                        //Option 5
                        if($row['answerChoice5'] != null) {
                            echo("<li><input class='inputOption' type='radio' name='inputOption' value='5'  id='option5'"); 
                            if($fetchRow['userAnswer'] === "5") {
                                echo("checked");
                            }
                            echo("></input><label for='option5'>".$row['answerChoice5']."</label></li>");
                        }


                    echo("</ul>
                    <button type='submit' name='submit'>submit</button> 
                </form>");

                }else{
                    echo("<form action='scripts/addQuizAnswer.php?q=$currentQuestion' method='post'>
                    <ul>
                            <li><input class='inputOption' type='radio' name='inputOption' value='1' id='option1'></input>
                            <label for='option1'>".$row['answerChoice1']."</label></li>

                            <li><input class='inputOption' type='radio' name='inputOption' value='2' id='option2'></input>
                            <label for='option2'>".$row['answerChoice2']."</label></li>");
    
                                if($row['answerChoice3'] != null) {
                                    echo("<li><input class='inputOption' type='radio' name='inputOption' value='3' id='option3'></input>
                                    <label for='option3'>".$row['answerChoice3']."</label></li>");
                                }
                                if($row['answerChoice4'] != null) {
                                    echo("<li><input class='inputOption' type='radio' name='inputOption' value='4' id='option4'></input>
                                    <label for='option4'>".$row['answerChoice4']."</label></li>");
                                }
                                if($row['answerChoice5'] != null) {
                                    echo("<li><input class='inputOption' type='radio' name='inputOption' value='5' id='option5'></input>
                                    <label for='option5'>".$row['answerChoice5']."</label></li>");
                                }
    

                        echo("</ul>
                        <button type='submit' name='submit'>submit</button> 
                    </form>");
                    }

                    
            echo(
                "</div>

            <div class='prevNext'>");
                if($currentQuestion > 1) {
                    echo("<a href='?q=".($currentQuestion - 1)."' class='prev'>Previous</a>");
                }

                //numberOfQuestions pulls from count of question
                $numQues = "SELECT * from question";
                $numofQuesQuery = $conn->query($numQues);
                $numberOfQuestions = mysqli_num_rows($numofQuesQuery);

                if($currentQuestion < $numberOfQuestions) {
                echo("<a href='?q=".($currentQuestion + 1)."' class='next'>Next Question</a>");
                }
            echo("</div>
        </div>");
}

?>