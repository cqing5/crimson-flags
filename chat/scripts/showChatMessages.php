<?php
session_start();
include("../../scripts/conn.php");

$currentUser = $_SESSION['sessionUserID'];
$currentOtherUser = $_GET['m'];

$grabUser = "SELECT * FROM user where userID = '$currentOtherUser'";
$otherUserInfo = $conn->query($grabUser);

$grabUser = "SELECT * FROM user where userID = '$currentUser'";
$ourUserInfo = $conn->query($grabUser);

while($ourUserInfoRow = $ourUserInfo->fetch_assoc()) {
    while($currentRow = $otherUserInfo->fetch_assoc()) {
        $grabMessages = "SELECT * FROM messages where (sender = '$currentOtherUser' AND receiver = '$currentUser') OR (sender = '$currentUser' AND receiver = '$currentOtherUser')";


        $otherUserInfo = $conn->query($grabMessages);

        echo('<div class="matchedWithContent">
        <div class="matchedWithContentPicture"><img src="'.$currentRow['profilePicture'].'" onerror="this.src=`https://www.srikiran.org/wp-content/uploads/2021/07/new_Avatar-Blank-Profile-Picture-Display-Pic-Mystery-Man-973460.png`"></div>
        <h1 class="matchedWithContentH1">'.$currentRow['fname']." ".$currentRow['lname'].'</h1>
       
    </div>');

        while($currentUserMessage = $otherUserInfo->fetch_assoc()) {

            if($currentUserMessage['sender'] === $currentUser) {
                echo("<div class='sentMessage'>
                        <div class='sentMessageContent'>");

                            echo("<div class='sentMessageWords'>");
                                    if($currentUserMessage['messageText'] == ":like:"){
                                        echo("<svg xmlns='http://www.w3.org/2000/svg' class='icon icon-tabler icon-tabler-thumb-up' width='44' height='44' viewBox='0 0 24 24' stroke-width='1.5' stroke='#2c3e50' fill='none' stroke-linecap='round' stroke-linejoin='round'>
                                        <path stroke='none' d='M0 0h24v24H0z' fill='none'/>
                                        <path d='M7 11v8a1 1 0 0 1 -1 1h-2a1 1 0 0 1 -1 -1v-7a1 1 0 0 1 1 -1h3a4 4 0 0 0 4 -4v-1a2 2 0 0 1 4 0v5h3a2 2 0 0 1 2 2l-1 5a2 3 0 0 1 -2 2h-7a3 3 0 0 1 -3 -3' />
                                      </svg>");
                                    } else {
                                        echo("<p>".$currentUserMessage['messageText']."</p>");
                                    }
    
                                echo("</div>");
                            echo("<div class='sentIcon'><img src='".$ourUserInfoRow['profilePicture']."' onerror='this.src=`https://www.srikiran.org/wp-content/uploads/2021/07/new_Avatar-Blank-Profile-Picture-Display-Pic-Mystery-Man-973460.png`'></div>");

                        echo("</div>
                            <p class='timeSent'>".$currentUserMessage['receiveTime']."</p>
                    </div>");
            } else {
                echo("<div class='recievedMessage'>
                        <div class='recievedMessageContent'>");

                            echo("<div class='recievedIcon'><img src='".$currentRow['profilePicture']."' onerror='this.src=`https://www.srikiran.org/wp-content/uploads/2021/07/new_Avatar-Blank-Profile-Picture-Display-Pic-Mystery-Man-973460.png`'></div>");
                            echo("<div class='recievedMessageWords'>");
                            
                            
                            
                            if($currentUserMessage['messageText'] == ":like:"){
                                echo("<svg xmlns='http://www.w3.org/2000/svg' class='icon icon-tabler icon-tabler-thumb-up' width='44' height='44' viewBox='0 0 24 24' stroke-width='1.5' stroke='#2c3e50' fill='none' stroke-linecap='round' stroke-linejoin='round'>
                                <path stroke='none' d='M0 0h24v24H0z' fill='none'/>
                                <path d='M7 11v8a1 1 0 0 1 -1 1h-2a1 1 0 0 1 -1 -1v-7a1 1 0 0 1 1 -1h3a4 4 0 0 0 4 -4v-1a2 2 0 0 1 4 0v5h3a2 2 0 0 1 2 2l-1 5a2 3 0 0 1 -2 2h-7a3 3 0 0 1 -3 -3' />
                              </svg>");
                            } else {
                                echo("<p>".$currentUserMessage['messageText']."</p>");
                            }
                            
                            
                            
                            echo("</div>");

                        echo("</div>
                            <p class='timeRecieved'>".$currentUserMessage['receiveTime']."</p>
                    </div>");

            }

        }

    }
}
?>