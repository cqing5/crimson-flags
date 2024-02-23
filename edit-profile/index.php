<?php
session_start();
if ($_SESSION['sessionUserID'] == null){
  header("location: ../");  
}else{

//connect to database
include("../scripts/conn.php");

//our user (eventually will be a session)
$ourUserID = $_SESSION['sessionUserID'];

//grab user information
$sqlGrabUserInformation = "SELECT * from user where userID = '$ourUserID'";
$userInformation = $conn->query($sqlGrabUserInformation);
while($row = $userInformation->fetch_assoc()) {

  $userID = $row['userID'];
  $ourUsername = $row['userName'];
  $fname = $row['fname'];
  $lname = $row['lname'];
  $dob = $row['dob'];
  $phone = $row['phone'];
  $major = $row['major'];
  $bio = $row['bio'];
  $profilePic = $row['profilePicture'];
  $gender = $row['Gender'];

}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>test</title>
  <link rel="stylesheet" href="edit.css" />
  <link rel="stylesheet" href="../navbar/main.css">
  <link rel="stylesheet" href="../footer/style.css">
</head>

<body>
  <main>
    <?php include('../navbar/index.php'); ?>

      <div class='profileWrapper'>
        <div class="titleSection">
          <h1>Edit Profile</h1>
          <p> Please update your information and submit when complete.</p>
          <div class="profilePictureSection"><img src="<?php echo($profilePic);?>" alt="profile picture" class="profile-pic"></div>
        </div> 
        
      <!-- error message for bio -->
       <!-- <div class="error-msg"></div> -->
          <?php
          // if($_SERVER['REQUEST_METHOD'] == "GET"){
          //     if($_GET["error"] == "biolength"){
          //       echo "<p><i><b> Your biography has exceeded the limit of 255 characters. Please shorten it.</b></i></p>";
          //     }
          //   }
          ?> 
          
        <div class="userInformation"> 
          <form name="editInfo" action="scripts/profile_update.php?user=<?php echo($ourUsername);?>" method="POST" class="profileForm">

              <!--First Name-->
              <div class="item">
                <label for="fname">First Name</label>
                <input type="text" id="fname" name="fname" size="20" value="<?php echo($fname);?>">
              </div>

              <!--Last Name-->
              <div class="item">
                <label for="lname">Last Name</label>
                <input type="text" id="lname" name="lname" size="20" maxlength="50" value="<?php echo($lname);?>">
              </div>

              <!--Phone-->
              <div class="item">
                <label for="phone">Phone</label>
                <input type="tel" id="phone" name="phone" size="20" pattern="[0-9]{3}-[0-9]{3}-[0-9]{4}" value="<?php echo($phone);?>">
              </div>


              <!--Birthday-->
              <div class="item">
                <label for="dob">Birthday</label>
                <input type="date" id="dob" name="dob" size="20" value="<?php echo($dob);?>">
              </div>

              <!--Gender-->
              <div class="item">
                <label for="gender">Gender</label>
                <select name="gender" id="gender">
                  <option value="male" <?php if($gender == "male"){echo('selected');}?>>Male</option>
                  <option value="female"<?php if($gender == "female"){echo('selected');}?>>Female</option>
                  <option value="nonbinary"<?php if($gender == "nonbinary"){echo('selected');}?>>Non-binary</option><br>
                </select>
              </div>

              <!--Major-->
              <div class="item">
                <label for="major">Major(s)</label>
                <input type="text" id="major" name="major" size="20" maxlength="50" value="<?php echo($major);?>">
              </div>

              <!--Biography-->
              <div class="double-item">
                <label for="bio">Biography</label>
                <textarea id="bio" class="bio" name="bio"><?php echo($bio);?></textarea>
              </div>

              <!--Buttons-->
              <div class="buttons">
                <a class='button-option cancel-btn' href="../profile/?user=<?php echo($ourUsername);?>">Cancel</a>
                <button type="submit" class="submit-btn button-option" name="update" value="update">Submit</button>
              </div>
          </form>
        </div>
</div>
    <?php include('../footer/index.php'); ?>
  </main>
</body>

</html>
<?php }?>