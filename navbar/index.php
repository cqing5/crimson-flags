<?php
session_start();
include('../scripts/conn.php');
$currentUser = $_SESSION['sessionUserID'];

$grabNotificationsSQL = "SELECT * FROM notification where userID = '$currentUser'";
$grabNotifications = $conn->query($grabNotificationsSQL);
$actual_link = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
$link = "link";
if (strpos($actual_link, '?') !== false) {
  $link = "noLink";
}

?>
   <nav>
      <div class="navbar-container">
        <h1 class="nav-title"><a href="../home/" class="nav-title-a">Crimson Flags</a></h1>
        <div class="navbar-menu">
          <a href="../matches/">Matches</a>
          <a href="../chat/" class="">Chat</a>
          <a href="../quiz/" class="">Quiz</a>
        </div>
        <div class="navbar-right-menu">
          <div class="notification-icon">
            <?php if(mysqli_num_rows($grabNotifications) > 0) { ?>
              <div class='notification-count'>
              <?php echo(mysqli_num_rows($grabNotifications)); ?>
              </div>
              <?php }?>
            

            <svg
              xmlns="http://www.w3.org/2000/svg"
              class="icon icon-tabler icon-tabler-bell"
              width="44"
              height="44"
              viewBox="0 0 24 24"
              stroke-width="1.5"
              stroke="#2c3e50"
              fill="none"
              stroke-linecap="round"
              stroke-linejoin="round"
            >
              <path stroke="none" d="M0 0h24v24H0z" fill="none" />
              <path
                d="M10 5a2 2 0 0 1 4 0a7 7 0 0 1 4 6v3a4 4 0 0 0 2 3h-16a4 4 0 0 0 2 -3v-3a7 7 0 0 1 4 -6"
              />
              <path d="M9 17v1a3 3 0 0 0 6 0v-1" />
            </svg>
            <?php 
          if(!empty($_GET['notifOpen'])) {
            echo("<div class='notificationDropdownTriangle isActive'>");
          }else {
            echo("<div class='notificationDropdownTriangle'>");
            }      ?>
            </div>
          </div>

          <?php 
          if(!empty($_GET['notifOpen'])) {
            echo("<div class='notificationDropdown isActive'>");
          }else {
            echo("<div class='notificationDropdown'>");
            }      ?>
        <div class="notificationDropdownContent">
          <div class="notificationTopContent">
            <h4 class="notificationText">Notifications:</h4>
            <div class="notificationClose">X</div>
          </div>
          <div class="notificationBottomContent">

            <?php
            if (mysqli_num_rows($grabNotifications) == 0 ){
              echo('<div class="notificationMessage">
              <p class="notificationMessageWords" style="margin-left: auto; margin-right: auto">You have no notifications yet.</p>
                </div>');
            }
while ($row = $grabNotifications->fetch_assoc()) {
  echo('<div class="notificationMessage">');
  if ($row['notificationType'] === 'regular') {
    $senderUserID = $row['senderID'];
    $getUserProfilePictureSQL = "SELECT * from user where userID = '$senderUserID'";
    $grabSenderInfo = $conn->query($getUserProfilePictureSQL);

    $sender = $grabSenderInfo->fetch_assoc();
    echo('
                
                <div class="notificationMessageImage">
                  <a href="../profile?user=' . $sender['userName'] . '">
                  <img src="' . $sender['profilePicture'] .'" onerror="this.src=`https://www.srikiran.org/wp-content/uploads/2021/07/new_Avatar-Blank-Profile-Picture-Display-Pic-Mystery-Man-973460.png`"'. '>


                  </a>
                </div>
                <p class="notificationMessageWords">' . $row['notificationMsg'] . '</p>
              <a class="notificationCloseButton" href="../navbar/deleteNotification.php?notiNum='.$row['notificationID'].'&actual_link='.$link.'">X</a>');
  }
  echo('</div>');
}

?>




          </div>
        </div>
      </div>


          <div class="profile-icon">


          
            <?php
$grabUserNameSQL = "SELECT * FROM user where userID = '$currentUser'";
$grabUserName = $conn->query($grabUserNameSQL);


$grabProfile = $grabUserName->fetch_assoc();
echo('<a href="../profile/?user=' . $grabProfile['userName'] . '">');
?>
            <svg
              xmlns="http://www.w3.org/2000/svg"
              class="icon icon-tabler icon-tabler-user"
              width="44"
              height="44"
              viewBox="0 0 24 24"
              stroke-width="1.5"
              stroke="#2c3e50"
              fill="none"
              stroke-linecap="round"
              stroke-linejoin="round"
            >
              <path stroke="none" d="M0 0h24v24H0z" fill="none" />
              <circle cx="12" cy="7" r="4" />
              <path d="M6 21v-2a4 4 0 0 1 4 -4h4a4 4 0 0 1 4 4v2" />
            </svg>
          </a>
          </div>
        </div>
        <button class="hamburger">
          <span></span>
          <span></span>
          <span></span>
        </button>
      </div>
      <div class="mobile-menu">
        <a href="../matches/">Matches</a>
        <a href="../chat/" class="">Chat</a>
        <a href="../quiz/" class="">Quiz</a>
      </div>
    </nav>
    <script src="../navbar/main.js"></script>
