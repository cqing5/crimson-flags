<?php
session_start();
  include("../scripts/conn.php");

  $currentUser=$_SESSION['sessionUserID'];

  $getUserInfo = "SELECT * FROM user WHERE userID = '$currentUser'";
  $UInfo = $conn->query(  $getUserInfo);
  $row = $UInfo->fetch_assoc();

  $isAdmin = $row['isAdmin'];

  if($isAdmin == 1){

  $currentReport = $_GET['verificationNum'];
  $trueClause = true;
  if (!isset($currentReport)) {
    $trueClause = false;
  }
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Verification</title>
    <link rel="stylesheet" href="style.css" />
    <link rel="stylesheet" href="../navbar/main.css" />
    <link rel="stylesheet" href="../footer/style.css" />
    <link rel="stylesheet" href="../navbar/adminNav/style.css" />
  </head>
  <body>
  <?php 
  include("../scripts/conn.php");
  include("../navbar/index.php");
  ?>



  <div class="quizPageWrapper">
    <div class="leftChatPage">
      <?php include('scripts/pullVerifications.php'); ?>
    </div>

    <div class="rightChatPage">
      <?php include('../navbar/adminNav/index.php'); ?>
      <h1 class="header">Verify Users</h1>
      <div class="rightChatPageContent">
      <?php 
        if($trueClause) {
          include('scripts/displayVerification.php'); 
        }?>
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

<?php

} else {
  header("Location: ../home/");
}

?>