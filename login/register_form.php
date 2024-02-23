<?php
session_start();
include('config.php');
include('../scripts/conn.php');

$userEmail = ($_SESSION['email']);

//check if email in system
$checkIfEmailExists = "SELECT * FROM user where email='$userEmail'";
$run = $conn->query($checkIfEmailExists);

while ($row = $run->fetch_assoc()) {
  $userID = $row['userID'];
  $isBanned = $row['isBanned'];
  if($isBanned == 1) {
    header("location: ../?banned=banned");
    exit();
  } else {
    $_SESSION['sessionUserID'] = $userID;
    header("location: ../home/");
    exit();
  }
}

?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Register</title>
    <link rel="stylesheet" href="style.css" />
  </head>
  <body>
    <main>
      <div class="profileWrapper">
        <div class="titleSection">
          <h1>Welcome to Crimson Flags!</h1>
          <p>We have imported some data from Google. Please confirm that it is correct and complete the unfilled sections.</p>
          <!-- error messages -->
          <div class="error-msg"></div>
          <?php
          if($_SERVER['REQUEST_METHOD'] == "GET"){
              // respond to different possible errors by displaying an error message
              if($_GET["error"] == "emptyfield"){
                  echo "<p><i><b> You must fill in every field. </b></i></p>";
              }
              else if($_GET["error"] == "invalidemail"){
                  echo "<p><i><b> Enter a proper email. </b></i></p>";
              }
              else if($_GET["error"] == "userunavailable"){
                  echo "<p><i><b> The username you entered is already taken. Please try again. </b></i></p>";
              }
              else if($_GET["error"] == "biolength"){
                echo "<p><i><b> Your biography has exceeded the limit of 255 characters. Please shorten it.</b></i></p>";
            }
              else if($_GET["error"] == "none"){
                  echo "<p><i><b> You have successfully created an account. </b></i></p>";
              }
            }
        ?> 
        </div>
        
        <div class="profilePictureSection"><img src="<?php echo $_SESSION["picture"]; ?>" alt="profile picture" class="profile-pic"></div>
        </div> 
      <div class="userInformation"> 
        <form action="register.php" method="POST" class="profileForm">

            <input type='text' id='profPic' value="<?php echo $_SESSION["picture"]; ?>" name="profPic" hidden>

            <!-- Insert First Name-->
            <div class="item">
              <label for="fname">First Name</label>
              <input type="text" id="fname" name="fname" size="20" value="<?php echo $_SESSION['fname']; ?>">
            </div>

            <!-- Insert Last Name-->
            <div class="item">
              <label for="lname">Last Name</label>
              <input type="text" id="lname" name="lname" size="20" maxlength="50" value="<?php echo $_SESSION['lname']; ?>">
            </div>

            <!-- Create Username -->
            <div class="item">
              <label for="username">Create Username</label>
              <input type="text" id="username" name="username" size="20" maxlength="50">
            </div>

            <!-- Insert Phone Number -->
            <div class="item">
              <label for="phone">Phone</label>
              <input type="tel" id="phone" name="phone" size="20" pattern="[0-9]{3}-[0-9]{3}-[0-9]{4}" placeholder="123-456-7890">
            </div>

            <!-- Insert Email -->
            <div class="item">
              <label for="phone">Email</label>
              <input type="email" id="email" name="email" size="20" maxlength="50" value="<?php echo $_SESSION['email']; ?>"> 
            </div>

            <!-- Insert Birthday -->
            <div class="item">
              <label for="dob">Birthday</label>
              <input type="date" id="dob" name="dob" size="20">
            </div>

            <!-- Gender Drop-down -->
            <div class="item">
              <label for="gender">Gender</label>
              <select name="gender" id="gender">
                <option value="male">Male</option>
                <option value="female">Female</option>
                <option value="nonbinary">Non-binary</option><br><br>
              </select>
            </div>

            <!-- Insert Major -->
            <div class="item">
              <label for="major">Major(s)</label>
              <input type="text" id="major" name="major" size="20" maxlength="50">
            </div>

            <!-- Insert Biography -->
            <div class="double-item">
              <label for="bio">Biography (255 characters)</label>
              <textarea id="bio" class="bio" name="bio"></textarea>
            </div>

            <!--Buttons-->
            <div class="buttons">
              <button type="reset" class="reset-btn button-option" name="reset">Reset</button>
              <button type="submit" class="submit-btn button-option" name="submit">Submit</button>
            </div>
        </form>
      </div>
  </div>
</main>
</body>
</html>
