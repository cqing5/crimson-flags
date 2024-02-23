<?php
session_start();
  if ($_SESSION['sessionUserID'] == null){
    header("location: ../");  
  }else{

    include("../scripts/conn.php");
// session_start();
//take user to the login page if there's no information stored in session variable
// if($_SESSION["user"] == NULL) { 
//    header('Location: https://cgi.luddy.indiana.edu/~team01/login/login.php'); 
// }  

$currentUser = $_SESSION['sessionUserID'];
$sqlGrabCurrentUserInfo = "SELECT * from user where userID='$currentUser'";
$currentUserInfo = $conn->query($sqlGrabCurrentUserInfo);
$admin = 0;
while ($row2 = $currentUserInfo->fetch_assoc()) {
  $admin = $row2['isAdmin'];
}



$userPage = "";

if (isset($_GET['user'])) {
  $userPage = $_GET['user'];
}
else {
  //set userpage based on session
  $userPage = "";
}




$sqlGrabUserInformation = "SELECT * from user where userName = '$userPage'";
$userInformation = $conn->query($sqlGrabUserInformation);

while ($row = $userInformation->fetch_assoc()) {

  $userID = $row['userID'];
  $fname = $row['fname'];
  $lname = $row['lname'];
  $dob = $row['dob'];
  $email = $row['email'];
  $phone = $row['phone'];
  $major = $row['major'];
  $bio = $row['bio'];
  $profilePic = $row['profilePicture'];
  $verification = $row['isVerified'];
  $areAdmin = $row['isAdmin'];
  $areBanned = $row['isBanned'];
}



?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Profile</title>
    <link rel="stylesheet" href="style.css" />
    <link rel="stylesheet" href="../navbar/main.css" />
    <link rel="stylesheet" href="../footer/style.css" />
  </head>
  <body>
  <?php include("../navbar/index.php"); ?>

  <main>
    <div class="profilePageWrapper">
    <div class="profileSection">
    <div class="topSection">
        <div class="profilePictureSection"><img src="<?php echo($profilePic); ?>" alt="profile picture" class="profile-pic" onerror='this.src=`https://www.srikiran.org/wp-content/uploads/2021/07/new_Avatar-Blank-Profile-Picture-Display-Pic-Mystery-Man-973460.png`'>

        <?php if($verification == 1) { ?>
          <div class='verificationCheck'>✓<span class="tooltiptext">This user has been verified to be an IU student</span></div>
        <?php }?>

      </div>
        <h1 class="profileName"><?php echo($fname . " " . $lname); ?></h1>
        
        <?php
          $today = date("Y-m-d");
          $diff = date_diff(date_create($dob), date_create($today));
          echo('<h2 class="ageYear">' . $diff->format('%y') . '</h2>');
        ?>

        <h2 class="major"><?php echo($major); ?> Major</h2>
      </div>

      <div class="middleSection">
        <div class="middleSection-leftSection">
          <h4 class="biographyTitle">Biography</h4>
        </div>


        <div class="middleSection-rightSection">


          <!--Verify Account-->
          <?php
            //Make sure verify account button only appears if we are on our user's page
            if ($currentUser == $userID) { ?>
            <?php if($verification != 1) { ?>
            <h5 class="verifyAccount">Verify Account</h5>
            <?php }?>
          <?php } ?>

          <!--Edit Profile-->
          <?php
            //Make sure edit profile button only appears if we are on our user's page
            if ($currentUser == $userID) { ?>
              <a href="../edit-profile/" class="editProfile">Edit Profile</a>
          <?php } ?>

          <!--Report User-->
          <?php
            //Make sure report button only appears if we are on a different user's page
            if ($currentUser != $userID) { ?>
              <h5 class="reportProfile">Report</h5>
          <?php } ?>

          <!--Make Admin-->
          <?php
            //Make sure make admin button only appears if we are on a different user's page and they are not already an admin
            if ($currentUser != $userID) { ?>
            <?php if($admin == 1) {
              if($areAdmin == 0) { ?>
              <h5 class="userPermissions">Make Admin</h5>
            <?php }} ?>
          <?php } ?>

            <!--Make Basic User-->
            <?php
            if ($currentUser != $userID) { ?>
            <?php if($admin == 1) {
              if($areAdmin == 1) { ?>
              <h5 class="makeBasicUserType">Make Basic User</h5>
            <?php }} ?>
          <?php } ?>


          <!--Review User-->
          <?php
            //Make sure review user button only appears if we are on a different user's page
            // select query so that this is only shown to current matches
            $grabMatch = "SELECT * from matches where (fromUserID = '$currentUser' AND toUserID = '$userID' AND approveDenyPending = 'approved') OR (fromUserID = '$userID' AND toUserID = '$currentUser' AND approveDenyPending = 'approved')";
            $matchInfo = $conn->query($grabMatch);
            if (mysqli_num_rows($matchInfo) == 1) {
            if ($currentUser != $userID) { ?>
              <h5 class="reviewUser">Review</h5>
          <?php }} ?>

          <!-- ban user -->
          <?php
            if ($currentUser != $userID) { ?>
            <?php if($admin == 1) {
              if($areBanned == 0) { ?>
              <a href="banUser.php?rUser=<?php echo($userID);?>" class='logout' onclick="return confirm('Are you sure you wish to ban this user?')">Ban User</a>
            <?php }} ?>
          <?php } ?>
            
          <!-- unban user -->
          <?php
            if ($currentUser != $userID) { ?>
            <?php if($admin == 1) {
              if($areBanned == 1) { ?>
              <a href="unbanUser.php?rUser=<?php echo($userID);?>" class='logout' onclick="return confirm('Are you sure you wish to unban this user?')">Unban User</a>
            <?php }} ?>
          <?php } ?>
          <!-- unmatch with user -->
          <?php
            //Make sure unmatch user button only appears if we are on a different user's page
            $grabMatches = "SELECT * from matches where (fromUserID = '$currentUser' AND toUserID = '$userID' AND approveDenyPending = 'approved') OR (fromUserID = '$userID' AND toUserID = '$currentUser' AND approveDenyPending = 'approved')";
            $matchInformation = $conn->query($grabMatches);
            if (mysqli_num_rows($matchInformation) == 1) {
            if ($currentUser != $userID) { ?>
              <a href="unmatch.php?rUser=<?php echo($userID);?>" class="editProfile" onclick="return confirm('You will unmatch from this user if you proceed.')">Unmatch</a>
          <?php }} ?>


          <!--Logout-->
          <?php
            if ($currentUser == $userID) { ?>
              <a href="../login/logout.php" class='logout'>Logout</a>
          <?php } ?>

        </div>
      </div>

      <div class="biographyContent">
        <p class="biographyWords"><?php echo($bio); ?></p>

      </div>

      <div class='dividerLine'></div>
      <!-- Display other users' reviews -->
      <div class="reviewWords"><h4>Reviews<h4></div>
      <?php include("review/displayReview.php"); ?>


      <!--Verify Account-->
      <?php
      //Make sure verify profile button only appears if we are on our user's page
      if ($currentUser == $userID) { ?>
        <div class="modal verify">
            <div class="modalContent">
            <div class="textContentReport">
            <form action='upload.php?user=<?php echo($userPage)?>' method="post" enctype="multipart/form-data">
            <div class="titleSection">
                <h1> Verify Account </h1>
                <p></p>
                <p> Please submit the following information to submit a verification request.</p>
            </div> 
            <div class="container">
                <p>Verification is used as a way to confirm IU enrollment and allow other students to feel safer about matching. You do not need to be verified to use the platform; 
                however, verified users have a higher success rate of finding a good roommate match!</p>
        
                <p>You may have only one request open at a time. Our admins review each request as soon as possible and a checkmark appears on your profile if you are approved.</p>

            </div>
            <label for="file_name">Upload file: </label>
            <input type="file" name="anyfile" id="anyfile">
            <p><strong>Note:</strong> Only .jpg files allowed.</p>
            <label for="verificationDescription">Provide any additional details: </label>
            <input class='verifyTextInput' type="text" name='verificationDescription'>
            <button type="submit" name="submit" value="submit">Upload</button>
        
            </form> 
              
            </div>
        </div>
      <?php } ?>

      <!--Report User-->
      <?php
      //Make sure report user button only appears if we are on another user's page
      if ($currentUser != $userID) { ?>
      <div class="modal report">
          <div class="modalContent">
            <div class="textContentReport">
              <h1 class="reportTitle">Report <?php echo($fname." ".$lname); ?></h1>
              <p>Please select a reason. The  user will not know that you are taking this action.</p>
            </div>
            <?php include('report/report_form.php');?>
          </div>
      </div>
      <?php } ?>

      <!--Make Admin-->
      <?php
      //Make sure make admin button only appears if we are on another user's page
      if ($currentUser != $userID) { ?>
      <div class="modal makeAdmin">
          <div class="modalContent">
            <div class="textContentReport">
              <h1 class="reportTitle">Make Admin</h1>
              <p>Are you sure you want to make <?php echo($fname." ".$lname); ?> an admin?</p>
            </div>
            <?php include('user-permissions/makeAdminForm.php');?>
          </div>
      </div>
      <?php } ?>

      <!--Make Basic User-->
      <?php
      //Make sure make basic user button only appears if we are on another user's page
      if ($currentUser != $userID) { ?>
      <div class="modal makeBasicUser">
          <div class="modalContent">
            <div class="textContentReport">
              <h1 class="reportTitle">Make Basic User</h1>
              <p>Are you sure you want to make <?php echo($fname." ".$lname); ?> a basic user?</p>
            </div>
            <?php include('user-permissions/makeBasicForm.php');?>
          </div>
      </div>
      <?php } ?>

      <!--Review User-->
      <?php
        if ($currentUser != $userID) { ?>
        <div class="modal modalReview">
            <div class="modalContent">
              <div class="textContentReport">
                <h1 class="reportTitle">Leave a Review</h1>
                <p>Briefly discuss your living experience with this user below.</p>
              </div>
              <?php include('review/index.php');?>
            </div>
        </div>
     
      <?php }?> 
  
      <script src="main.js"></script>
  </main>


  <?php
include("../footer/index.php");
?>
  </body>
</html>
<?php }?>
