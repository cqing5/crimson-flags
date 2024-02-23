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
    <title>Matches</title>
    <link rel="stylesheet" href="style.css" />
    <link rel="stylesheet" href="../navbar/main.css" />
    <link rel="stylesheet" href="../footer/style.css" />
  
  </head>
  
  <body>
    <?php
include("../scripts/conn.php");
include("../navbar/index.php");

$error = $_GET['error'];
$success = $_GET['success'];

if (isset($error)) {
  echo("<div class='errorAlert'>");
  if ($error === 'NoUser') {
    echo("That User Does Not Exist");
  }
  if ($error === 'alreadyExists') {
    echo("You already have a pending match request with that user");
  }

  echo("</div>");
}

if (isset($success)) {
  echo("<div class='successAlert'>");
  if ($success === 'matchadded') {
    echo("Match Request Sent!");
  }
  if ($success === 'matchremoved') {
    echo("Match Request Removed!");
  }
  echo("</div>");
}

?>


    <h1 class="your-matches">Your Top Matches</h1>
  
    <div class="pageContent">
      <div class="mainCards">
      <?php include("scripts/matchingAlgorithm.php"); ?>
    </div>
      <p class="matchOnInfo">Already have a roommate in mind?<br>Match based on phone number or email!</p>

    </div>

      <div class="modal">
          <div class="modalContent">
            <h1>Add match with phone number<br>or email</h1>
            <form method="POST" action="scripts/addMatchFromPhoneEmail.php">
              <label>Email:</label>
              <input placeholder="example@email.com" name="email"></input>
              <label>Phone number:</label>
              <input placeholder="123-456-7890" name="phone"></input>
  
              <button type="submit" name="addMatchFromPhone">Add Match</button>
            </form>
          </div>
      </div>

    <?php include("../footer/index.php"); ?>

    <script src="scripts/main.js"></script>
  </body>
</html>

<?php } ?>