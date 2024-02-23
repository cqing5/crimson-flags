<?php
session_start();
  if ($_SESSION['sessionUserID'] == null){
    header("location: ../");  
  }else{

$requestState = false;
if(isset($_GET['r'])){
  $requestState = true;
}

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
}


$currentChatMessageUser = $_GET['m'];
?>


<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Chat</title>
    <link rel="stylesheet" href="style.css" />
    <link rel="stylesheet" href="../navbar/main.css" />
    <link rel="stylesheet" href="../footer/style.css" />

    
  </head>
  <body>
  <?php 
  include("../navbar/index.php");
  ?>



  <div class="chatPageWrapper">
    
  
  <div class="leftChatPage">
      <div class="inbox-request-wrapper">


        <button class="inbox-request inbox-button 
        <?php 
        if ($requestState === false) {
          echo("is-active");
        }
      
      ?>
      ">Current Inbox</button>
        <button class="inbox-request request-button
        
        <?php 
        if ($requestState === true) {
          echo("is-active");
        }
      
      ?>
        
        ">Requests</button>


      </div>
      <div class="white-line"></div>
    
      <div class='requestsMatchWrapper 
      
      <?php 
        if ($requestState === false) {
          echo("disabled-menu");
        }
      
      ?>
      
      '>
        <!-- <div class='requestsInboxMatch'>
              <div class="requestsInboxLeft">
                <div class="requestsInboxProfilePicture"></div>
              </div>
              <div class="requestsInboxRight">
                <p class="matchName">Karen Williams</p>
                <div class="accept-or-decline">
                  <button class="accept">Accept</button>
                  <button class="decline">Decline</button>
                </div>
              </div>
            </div> -->
            <?php include('scripts/pullMatchRequests.php')?>
      </div>
      
      <div class='currentInboxMatchWrapper
      <?php 
        if ($requestState === true) {
          echo("disabled-menu");
        }
      
      ?>
      
      
      '>
        <?php include('scripts/pullMatches.php')?>
          <!-- <div class='currentInboxMatch'>
            <div class="currentInboxLeft">
              <div class="currentInboxProfilePicture"></div>
            </div>
            <div class="currentInboxMiddle">
              <p class="matchName">Karen Williams</p>
              <p class="matchMessageNumber">2 new messages</p>
            </div>
            <div class="currentInboxRight">
              <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-message-circle" width="44" height="44" viewBox="0 0 24 24" stroke-width="1.5" stroke="#2c3e50" fill="none" stroke-linecap="round" stroke-linejoin="round">
                <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                <path d="M3 20l1.3 -3.9a9 8 0 1 1 3.4 2.9l-4.7 1" />
                <line x1="12" y1="12" x2="12" y2="12.01" />
                <line x1="8" y1="12" x2="8" y2="12.01" />
                <line x1="16" y1="12" x2="16" y2="12.01" />
              </svg>
            </div>
          </div>
          
          <div class='currentInboxMatch is-active'>
            <div class="currentInboxLeft">
              <div class="currentInboxProfilePicture"></div>
            </div>
            <div class="currentInboxMiddle">
              <p class="matchName">Karen Williams</p>
              <p class="matchMessageNumber">2 new messages</p>
            </div>
            <div class="currentInboxRight">
              <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-message-circle" width="44" height="44" viewBox="0 0 24 24" stroke-width="1.5" stroke="#2c3e50" fill="none" stroke-linecap="round" stroke-linejoin="round">
                <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                <path d="M3 20l1.3 -3.9a9 8 0 1 1 3.4 2.9l-4.7 1" />
                <line x1="12" y1="12" x2="12" y2="12.01" />
                <line x1="8" y1="12" x2="8" y2="12.01" />
                <line x1="16" y1="12" x2="16" y2="12.01" />
              </svg>
            </div>
          </div> -->

        


      </div>
    </div>
    <div class="rightChatPage">
      <div class="rightChatPageMessages">

        <!--All content on the right side of the screen is contained in this div 
        
        When building the page, put the most recent message at the top and oldest message at the bottom. This is because of how flex-direction works: if they have a lot of messages, it always scrolls to the newest one first when the page is reloaded-->


        <!-- Structure of a sent message:
        * place content of message within the <p> of 'sentMessageWords' div
        * place link to profile image within "sentIcon" div
        * place timestamp of the message within the <p> of "timeSent" div
          
        <div class="sentMessage">
          <div class="sentMessageContent">
            <div class="sentMessageWords">
              <p>Content of Messege goes here</p>
            </div>
            <div class="sentIcon"></div>
          </div>
          <p class="timeSent">time message was sent goes here</p>
        </div>
      -->


      <!-- Structure of a recieved message:
        * place content of message within the <p> of 'recievedMessageWords' div
        * place link to profile image within "recievedIcon" div
        * place timestamp of the message within the <p> of "timeRecieved" div

      <div class="recievedMessage">
        <div class="recievedMessageContent">
          <div class="recievedIcon"></div>
          <div class="recievedMessageWords">
            <p>Content of Messege goes here</p>
          </div>
        </div>
        <p class="timeRecieved">time message was sent goes here</p>
      </div>

        -->
        <?php 
        include('scripts/showChatMessages.php')
        ?>
        

      <!-- Matched with information, should be placed below all messages sent and recieved but still within the rightChatPageMessages div 
      

      Structure of Matched with information:
      <div class="matchedWithContent">
          <div class="matchedWithContentPicture"></div>
          <h1 class="matchedWithContentH1">Other User Name</h1>
          <h3 class="matchedWithContentH3">Matched with Time</h3>
      </div>
      
      -->

 
      </div>

      <?php 
        if(!empty($_GET['m'])) { ?>
      <div class="bottomInputBar">
      <div class="emojiKeyboardMenu hideEmoji"><div class="emojiHolder"></div></div>
        <div class="inputBarBottom">
    
          <form id='sendAMessage' name='sendAMessage' method="POST" action="scripts/sendMessage.php?m=<?php echo($currentChatMessageUser);?>">
          
            <textarea maxlength="255" id="inputBarBottomText" name='sendMessageText'></textarea>
            <button name='sendTheMessageToThePerson' type='submit' id="send"> Send </button> 
          </form>

          <div class="emojiKeyboard"><svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-mood-smile" width="44" height="44" viewBox="0 0 24 24" stroke-width="1.5" stroke="#2c3e50" fill="none" stroke-linecap="round" stroke-linejoin="round">
            <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
            <circle cx="12" cy="12" r="9" />
            <line x1="9" y1="10" x2="9.01" y2="10" />
            <line x1="15" y1="10" x2="15.01" y2="10" />
            <path d="M9.5 15a3.5 3.5 0 0 0 5 0" />
          </svg></div>
        </div>
        <div class="likeButton">
        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-thumb-up" width="44" height="44" viewBox="0 0 24 24" stroke-width="1.5" stroke="#2c3e50" fill="none" stroke-linecap="round" stroke-linejoin="round">
  <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
  <path d="M7 11v8a1 1 0 0 1 -1 1h-2a1 1 0 0 1 -1 -1v-7a1 1 0 0 1 1 -1h3a4 4 0 0 0 4 -4v-1a2 2 0 0 1 4 0v5h3a2 2 0 0 1 2 2l-1 5a2 3 0 0 1 -2 2h-7a3 3 0 0 1 -3 -3" />
</svg>
        </div>
      </div>
            <?php }?>
  </div>

  <button class="showHideMobile">
    <div class="showHideMobileOn">X</div>
    <div class="showHideMobileOff isON"><</div>
  </button>
  
  </div>


  <?php 

  include("../footer/index.php");
  ?>

  <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

  <!-- <script type="text/javascript">
      // jQuery Document
      $(document).ready(function(){
        $("#send").on("click", function(){
          $.ajax({
            url: insertMessage.php,
            method: "POST",
            data:{
              sender: $("#sender").val(),
              receiver: $("#receiver").val(),
              message: $("#messageText").val(),
            },
            dateType: "Text",
            success:function(data)
            {
              $("#recievedMessageWords").val(" ");
            }
          });
        });
      });
  </script> -->

  

  <script src="main.js"></script>
  </body>
</html>

<?php } ?>
