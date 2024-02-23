<?php
session_start();
//Conncect to Database
include("../../scripts/conn.php");

//ourUser (for testing, in real version will pull from session)
$ourUserID = $_SESSION['sessionUserID'];

//numberOfQuestions pulls from count of question
$numQues = "SELECT * from question";
$numofQuesQuery = $conn->query($numQues);
$numberOfQuestions = mysqli_num_rows($numofQuesQuery);

//grab a list of all users
$sqlGrabUsers = "SELECT * from user where NOT userID = '$ourUserID'";
$sqlResultGrabUsers = $conn->query($sqlGrabUsers);

//store in array: the question rank, then their answer
$ourUserAnswersSQL = "SELECT * from answer WHERE userID = '$ourUserID' ORDER BY questionID ASC";
$sqlGrabAnswerTable = $conn->query($ourUserAnswersSQL);



//Current top matches
$currentWinner1 = "";
$currentWinner1Score = 0;

$currentWinner2 = "";
$currentWinner2Score = 0;

$currentWinner3 = "";
$currentWinner3Score = 0;

//Checks if the user has answered all the questions
if (mysqli_num_rows($sqlGrabAnswerTable) >= $numberOfQuestions) {

    //loops through all other users in the database
    while ($row = $sqlResultGrabUsers->fetch_assoc()) {

        $noExistingMatches = true;


        //selects the user we are comparing and grabs their answers
        $userWeAreCurrentlyOn = $row['userID'];
        if($row['isBanned'] == 0) {


        //loop through current matches and see if we already have an existing match
        //grab all matches where our user is a part of it.
        $grabAllCurrentMatchesSQL = "SELECT * from matches where fromUserID = '$ourUserID' OR toUserID = '$ourUserID'"; 
        $grabAllCurrentMatches = $conn->query($grabAllCurrentMatchesSQL);
        while ($matches = $grabAllCurrentMatches->fetch_assoc()) {
            if(($matches['fromUserID'] === $userWeAreCurrentlyOn) || ($matches['toUserID'] === $userWeAreCurrentlyOn)){
                $noExistingMatches = false;
            }
        }

        if($noExistingMatches == true){


        $currentUserWeAreOnAnswers = "SELECT * from answer WHERE userID = '$userWeAreCurrentlyOn'";
        $currentUserWeAreOnAnswersRows = $conn->query($currentUserWeAreOnAnswers);


        //checks if the user we are comparing has answered all the questions
        if (mysqli_num_rows($currentUserWeAreOnAnswersRows) >= $numberOfQuestions) {

            //loops through the rows of answers
            while ($currentUserAnswer = $currentUserWeAreOnAnswersRows->fetch_assoc()) {

                //Stores Question ID
                $currentQuestion = $currentUserAnswer['questionID'];

                //Used to store the current question tier
                $currentQuestionTierSQL = "SELECT * from question WHERE questionID = '$currentQuestion'";
                $currentQuizQuestionTier = $conn->query($currentQuestionTierSQL);
                $currentQuizQuestionTierRow = $currentQuizQuestionTier->fetch_assoc();
                $currentTier = $currentQuizQuestionTierRow['tierNumber'];

                //Used to store the answer we are currently comparing
                $currentUsersAnswerAnswer = $currentUserAnswer['userAnswer'];

                //Stores our users answer to the same question
                $grabOurUsersQuestionAnswerSQL = "SELECT * from answer WHERE userID = '$ourUserID' AND questionID = '$currentQuestion'";
                $grabOurUserAnswer = $conn->query($grabOurUsersQuestionAnswerSQL);
                $ourRow = $grabOurUserAnswer->fetch_assoc();
                $currentOurUserAnswer = $ourRow['userAnswer'];

                //If a red flag question, checks if they have the same answer. If not, gives them a super low score so they will not match
                if ($currentTier === "1") {
                    if ($currentUsersAnswerAnswer != $currentOurUserAnswer) {
                        $currentOtherUserScore = -10000;
                    }
                }
                //If it is an important question, it assigns them a score based on how close they were. Important questions are worth 2x as much as regular questions
                if ($currentTier === "2") {
                    $currentOtherUserScore = $currentOtherUserScore + ((compareAnswers(((int)$currentUsersAnswerAnswer), (int)$currentOurUserAnswer)) * 2);

                }
                //If it is an regular question, it assigns them a score based on how close they were. 
                if ($currentTier === "3") {
                    $currentOtherUserScore = $currentOtherUserScore + (compareAnswers((int)$currentUsersAnswerAnswer, (int)$currentOurUserAnswer));
                }

            }

            //After all questions have been looped through. Uses compareUsers() to compare the users against the users already looped through. If they have a higher score, it adjusts the current ranking as appropriate
            compareUsers($userWeAreCurrentlyOn, $currentOtherUserScore);

            //reset the score to 0 to be looped through again
            $currentOtherUserScore = 0;
        }
        else {
        //uncomment out to see all users who do not have enough answers
        //echo($userWeAreCurrentlyOn."does not have enough<br>");
        }
    }
        
    }
    }
    if($currentWinner1 == "") {
        echo('<p class="no-matches">Unfortunately, it looks like we have no matches for you. Consider adjusting your answers, especially to the Crimson Flag questions. These questions completely filter out users with whom you do not 100% align with. When answering them, consider if they are truly a dealbreaker or not, as each subsequent flag will drastically reduce your number of potential matches.</p>');
    
    }
}
else {
    //What is echoed if the user does not have enough questions answered
    echo("<a class='answerMore' href='../quiz/?q=1'><p>To find a match you need to answer more questions<p></a>");

}



//Echo the highest match //
$sqlGrabWinner1 = "SELECT * from user where userID = '$currentWinner1'";
$sqlGrabWinner1Row = $conn->query($sqlGrabWinner1);

while ($rowWinner1 = $sqlGrabWinner1Row->fetch_assoc()) {
    echo("<div class='matchContainer card1'>
            <div class='leftHalfMatchContainer'>
                <div class='leftHalfMatchContainerProfilePicture'>
                <a href='../profile/?user=" . $rowWinner1['userName'] . "'><img src='" . $rowWinner1['profilePicture'] . "' class='profile-pic' onerror='this.src=`https://www.srikiran.org/wp-content/uploads/2021/07/new_Avatar-Blank-Profile-Picture-Display-Pic-Mystery-Man-973460.png`'></a>
                </div>
                <div class='leftHalfMatchContainerContent'>
                    <h3 class='matchName'>" . $rowWinner1['fname'] . " " . $rowWinner1['lname'] . "</h3>
                    <h4 class='matchYear'>" . $rowWinner1['major'] . " Major" . "</h4>
                </div>
            </div>

            <div class='middleMatchContainer'>
                <p class='matchDescription'>" . $rowWinner1['bio'] . "</p>
            </div>

            <div class='rightMatchContainer'>");

            $sql = "SELECT * FROM matches where fromUserID='$ourUserID' AND toUserID='$currentWinner1' AND approveDenyPending='pending'";
            $checkIfActiveRequest = $conn->query($sql);
            if (mysqli_num_rows($checkIfActiveRequest) > 0) {
                echo("<a href='scripts/cancelMatchRequest.php/?u1=" . $ourUserID . "&u2=" . $rowWinner1['userID'] . "' class='sendMessage unsendMatch'>Cancel Request</a>");
            } else {
                echo("<a href='scripts/sendMatchRequest.php/?u1=" . $ourUserID . "&u2=" . $rowWinner1['userID'] . "' class='sendMessage'>Add Match</a>");
            }
        echo("</div></div>");
}


//Echo the second highest match //
$sqlGrabWinner2 = "SELECT * from user where userID = '$currentWinner2'";
$sqlGrabWinner2Row = $conn->query($sqlGrabWinner2);

while ($rowWinner2 = $sqlGrabWinner2Row->fetch_assoc()) {
    echo("<div class='matchContainer card2'>
            <div class='leftHalfMatchContainer'>
                <div class='leftHalfMatchContainerProfilePicture'>
                <a href='../profile/?user=" . $rowWinner2['userName'] . "'><img src='" . $rowWinner2['profilePicture'] . "' class='profile-pic' onerror='this.src=`https://www.srikiran.org/wp-content/uploads/2021/07/new_Avatar-Blank-Profile-Picture-Display-Pic-Mystery-Man-973460.png`'></a>
                </div>
                <div class='leftHalfMatchContainerContent'>
                    <h3 class='matchName'>" . $rowWinner2['fname'] . " " . $rowWinner2['lname'] . "</h3>
                    <h4 class='matchYear'>" . $rowWinner2['major'] . " Major" . "</h4>
                </div>
            </div>

            <div class='middleMatchContainer'>
                <p class='matchDescription'>" . $rowWinner2['bio'] . "</p>
            </div>

            <div class='rightMatchContainer'>");

            $sql = "SELECT * FROM matches where fromUserID='$ourUserID' AND toUserID='$currentWinner2' AND approveDenyPending='pending'";
            $checkIfActiveRequest = $conn->query($sql);
            if (mysqli_num_rows($checkIfActiveRequest) > 0) {
                echo("<a href='scripts/cancelMatchRequest.php/?u1=" . $ourUserID . "&u2=" . $rowWinner2['userID'] . "' class='sendMessage unsendMatch'>Cancel Request</a>");
            } else {
                echo("<a href='scripts/sendMatchRequest.php/?u1=" . $ourUserID . "&u2=" . $rowWinner2['userID'] . "' class='sendMessage'>Add Match</a>");
            }
        echo("</div></div>");
}


//Echo the third highest match //
$sqlGrabWinner3 = "SELECT * from user where userID = '$currentWinner3'";
$sqlGrabWinner3Row = $conn->query($sqlGrabWinner3);

while ($rowWinner3 = $sqlGrabWinner3Row->fetch_assoc()) {
    echo("<div class='matchContainer card3'>
            <div class='leftHalfMatchContainer'>
                <div class='leftHalfMatchContainerProfilePicture'>
                    <a href='../profile/?user=" . $rowWinner3['userName'] . "'><img src='" . $rowWinner3['profilePicture'] . "' class='profile-pic' onerror='this.src=`https://www.srikiran.org/wp-content/uploads/2021/07/new_Avatar-Blank-Profile-Picture-Display-Pic-Mystery-Man-973460.png`'></a>
                </div>
                <div class='leftHalfMatchContainerContent'>
                    <h3 class='matchName'>" . $rowWinner3['fname'] . " " . $rowWinner3['lname'] . "</h3>
                    <h4 class='matchYear'>" . $rowWinner3['major'] . " Major" . "</h4>
                </div>
            </div>

            <div class='middleMatchContainer'>
                <p class='matchDescription'>" . $rowWinner3['bio'] . "</p>
            </div>

            <div class='rightMatchContainer'>");

            $sql = "SELECT * FROM matches where fromUserID='$ourUserID' AND toUserID='$currentWinner3' AND approveDenyPending='pending'";
            $checkIfActiveRequest = $conn->query($sql);
            if (mysqli_num_rows($checkIfActiveRequest) > 0) {
                echo("<a href='scripts/cancelMatchRequest.php/?u1=" . $ourUserID . "&u2=" . $rowWinner3['userID'] . "' class='sendMessage unsendMatch'>Cancel Request</a>");
            } else {
                echo("<a href='scripts/sendMatchRequest.php/?u1=" . $ourUserID . "&u2=" . $rowWinner3['userID'] . "' class='sendMessage'>Add Match</a>");
            }
        echo("</div></div>");
}

//helper function to compare users inside main loop
function compareUsers($user, $score)
{
    global $currentWinner1, $currentWinner1Score, $currentWinner2Score, $currentWinner2, $currentWinner3, $currentWinner3Score;
    //compared user is the highest scoring
    if ($score >= $currentWinner1Score) {

        //set winner 2 to winner 3
        $currentWinner3Score = $currentWinner2Score;
        $currentWinner3 = $currentWinner2;

        //set winner 1 to winner 2
        $currentWinner2Score = $currentWinner1Score;
        $currentWinner2 = $currentWinner1;

        //set new winner to winner 1
        $currentWinner1Score = $score;
        $currentWinner1 = $user;


    }
    elseif ($score >= $currentWinner2Score) {

        //set winner 2 to winner 3
        $currentWinner3Score = $currentWinner2Score;
        $currentWinner3 = $currentWinner2;

        //set new winner to winner 2
        $currentWinner2Score = $score;
        $currentWinner2 = $user;

    }
    elseif ($score >= $currentWinner3Score) {
        //set new winner to winner 3
        $currentWinner3Score = $score;
        $currentWinner3 = $user;
    }

}

//Helper Function compares quiz answers and returns what score should be added to total running score
function compareAnswers($answer1, $answer2)
{
    if ($answer1 === 5) {
        if ($answer2 === 5) {
            return (2);
        }
        elseif ($answer2 === 4) {
            return (1);
        }
        elseif ($answer2 === 3) {
            return (0);
        }
        elseif ($answer2 === 2) {
            return (-1);
        }
        elseif ($answer2 === 1) {
            return (-2);
        }
    }

    if ($answer1 === 4) {
        if ($answer2 === 5) {
            return (1);
        }
        elseif ($answer2 === 4) {
            return (2);
        }
        elseif ($answer2 === 3) {
            return (1);
        }
        elseif ($answer2 === 2) {
            return (0);
        }
        elseif ($answer2 === 1) {
            return (-1);
        }
    }


    if ($answer1 === 3) {
        if ($answer2 === 5) {
            return (0);
        }
        elseif ($answer2 === 4) {
            return (1);
        }
        elseif ($answer2 === 3) {
            return (2);
        }
        elseif ($answer2 === 2) {
            return (1);
        }
        elseif ($answer2 === 1) {
            return (0);
        }
    }

    if ($answer1 === 2) {
        if ($answer2 === 5) {
            return (-1);
        }
        elseif ($answer2 === 4) {
            return (0);
        }
        elseif ($answer2 === 3) {
            return (1);
        }
        elseif ($answer2 === 2) {
            return (2);
        }
        elseif ($answer2 === 1) {
            return (1);
        }
    }

    if ($answer1 === 1) {
        if ($answer2 === 5) {
            return (-2);
        }
        elseif ($answer2 === 4) {
            return (-1);
        }
        elseif ($answer2 === 3) {
            return (0);
        }
        elseif ($answer2 === 2) {
            return (1);
        }
        elseif ($answer2 === 1) {
            return (2);
        }
    }

}



?>