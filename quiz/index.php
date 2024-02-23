<?php
session_start();
  if ($_SESSION['sessionUserID'] == null){
    header("location: ../");  
  }else{
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Quiz</title>
    <link rel="stylesheet" href="style.css" />
    <link rel="stylesheet" href="../navbar/main.css" />
    <link rel="stylesheet" href="../navbar/adminNav/style.css" />
    <link rel="stylesheet" href="../footer/style.css" />
  </head>
  <body>
  <?php 
  include("../scripts/conn.php");
  include("../navbar/index.php");
  $currentUser= $_SESSION['sessionUserID'];

  $getUserInfo = "SELECT * FROM user WHERE userID = '$currentUser'";
  $UInfo = $conn->query(  $getUserInfo);
  $row = $UInfo->fetch_assoc();

  $isAdmin = $row['isAdmin'];

  ?>



  <div class="quizPageWrapper">
    <div class="leftChatPage">
      <?php include('scripts/pullQuestion.php')?>
    </div>
    <div class="rightChatPage">
        <?php 
        if($isAdmin == 1){
          include('../navbar/adminNav/index.php');
        } ?>
      <h1 class="quizHeader">Compatibility Quiz</h1>
      <div class="rightChatPageContent">
        
        <?php 
        if(empty($_GET['q'])) { ?>

          <div class="noQuestions">
     
            <div class="cards">
              <div class="card card1">
                <div class="icon"><svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-notes" width="100%"  viewBox="0 0 24 24" stroke-width="1.5" stroke="#2c3e50" fill="none" stroke-linecap="round" stroke-linejoin="round">
  <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
  <rect x="5" y="3" width="14" height="18" rx="2" />
  <line x1="9" y1="7" x2="15" y2="7" />
  <line x1="9" y1="11" x2="15" y2="11" />
  <line x1="9" y1="15" x2="13" y2="15" />
</svg></div>
                <h4>Getting Started</h4>
                <p>The compatability quiz is used to pair students with other like-minded students</p>
                <p>To get started, answer all the questions on the quiz</p>
              </div>

              <div class="card card2">
                <div class="icon"><svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-flag-3" width="100%"  viewBox="0 0 24 24" stroke-width="1.5" stroke="#2c3e50" fill="none" stroke-linecap="round" stroke-linejoin="round">
  <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
  <path d="M5 14h14l-4.5 -4.5l4.5 -4.5h-14v16" />
</svg></div>
                <h4>Red Flags vs Regular Questions</h4>
                <p>While answering questions, consider what exactly is most important to you when looking for a new roommate.</p><p>Red flag questions will completely filter out users whom you do not allign with. When answering them, consider if they are truely a dealbreaker or not.</p>
              </div>
              <div class="card card3">
                <div class="icon"><svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-users" width="100%"  viewBox="0 0 24 24" stroke-width="1.5" stroke="#2c3e50" fill="none" stroke-linecap="round" stroke-linejoin="round">
  <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
  <circle cx="9" cy="7" r="4" />
  <path d="M3 21v-2a4 4 0 0 1 4 -4h4a4 4 0 0 1 4 4v2" />
  <path d="M16 3.13a4 4 0 0 1 0 7.75" />
  <path d="M21 21v-2a4 4 0 0 0 -3 -3.85" />
</svg></div>
                <h4>Finding Your Matches!</h4>
                <p>When all questions are answered, head on over to the matches page to find the perfect roommate based on your answers!</p>
              </div>
            </div>
            <a href="?q=1" class="start">Start the Quiz</a>
          </div>


        <?php }else{
          include('scripts/currentQuestion.php');
        }
        
        ?>
</div>
    </div>

    <button class="showHideMobile">
      <div class="showHideMobileOn">X</div>
      <div class="showHideMobileOff isON"><</div>
    </button>

  </div>



  <?php 
  include("../footer/index.php");
  ?>

  <script src="main.js"></script>
  </body>
</html>
<?php }?>