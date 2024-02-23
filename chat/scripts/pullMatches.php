<?php
session_start();
include("../../scripts/conn.php");

$currentUser = $_SESSION['sessionUserID'];
$currentOtherUser = $_GET['m'];
$grabMatches = "SELECT * FROM matches where (fromUserID = '$currentUser' OR toUserID = '$currentUser') AND approveDenyPending = 'approved'";
$ourMatches = $conn->query($grabMatches);
while($row = $ourMatches->fetch_assoc()) {
    $theOtherPerson = "";
    if ($row['fromUserID'] === $currentUser) {
        $theOtherPerson = $row['toUserID'];
    } else if (($row['toUserID'] === $currentUser)) {
        $theOtherPerson = $row['fromUserID'];
    }

    $grabUser = "SELECT * FROM user where userID = '$theOtherPerson'";
    $otherUserInfo = $conn->query($grabUser);
    while($row2 = $otherUserInfo->fetch_assoc()) {

    
        echo("<div class='currentInboxMatch ");
        if($currentOtherUser === $row2['userID']) {
            echo("is-active ");
        }
        
        echo("'>
            
                <div class='currentInboxLeft'>
                    <div class='currentInboxProfilePicture'><a href='../profile?user=".$row2['userName']."'><img src='".$row2['profilePicture']."' onerror='this.src=`https://www.srikiran.org/wp-content/uploads/2021/07/new_Avatar-Blank-Profile-Picture-Display-Pic-Mystery-Man-973460.png`'></a></div>
                </div>


                
                <div class='currentInboxMiddle'>
                    <a href='?m=".$row2['userID']."'>
                    <p class='matchName'>".$row2['fname']." ".$row2['lname']."</p>
                    </a>
                </div>
            
                <div class='currentInboxRight'>
                    <a href='?m=".$row2['userID']."'>
                  <svg xmlns='http://www.w3.org/2000/svg' class='icon icon-tabler icon-tabler-message-circle' width='44' height='44' viewBox='0 0 24 24' stroke-width='1.5' stroke='#2c3e50' fill='none' stroke-linecap='round' stroke-linejoin='round'>
                    <path stroke='none' d='M0 0h24v24H0z' fill='none'/>
                    <path d='M3 20l1.3 -3.9a9 8 0 1 1 3.4 2.9l-4.7 1' />
                    <line x1='12' y1='12' x2='12' y2='12.01' />
                    <line x1='8' y1='12' x2='8' y2='12.01' />
                    <line x1='16' y1='12' x2='16' y2='12.01' />
                  </svg>
                  </a>
                </div>
                "); 

            echo("
            </div>");

        //     <div class="currentInboxRight">
        //       <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-message-circle" width="44" height="44" viewBox="0 0 24 24" stroke-width="1.5" stroke="#2c3e50" fill="none" stroke-linecap="round" stroke-linejoin="round">
        //         <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
        //         <path d="M3 20l1.3 -3.9a9 8 0 1 1 3.4 2.9l-4.7 1" />
        //         <line x1="12" y1="12" x2="12" y2="12.01" />
        //         <line x1="8" y1="12" x2="8" y2="12.01" />
        //         <line x1="16" y1="12" x2="16" y2="12.01" />
        //       </svg>
        //     </div>
        //   </div>
    
    }



}
?>