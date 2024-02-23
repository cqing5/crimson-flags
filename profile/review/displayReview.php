<?php 
session_start();
include('../scripts/conn.php');

$reviewedUser = $_GET['user'];

$grabID = "SELECT * from user where userName = '$reviewedUser'";
$grabIDrow = $conn->query($grabID);
$row = $grabIDrow->fetch_assoc();

$currentUserID = $row['userID'];
$grabReview = "SELECT * from reviews where reviewedUserID = '$currentUserID'";
$grabReviewRow = $conn->query($grabReview);


echo("<div class='reviews'>");
while ($row = $grabReviewRow->fetch_assoc()) {
  $review = $row['reviewDesc'];
  // gets ID of user who wrote the review
  $reviewUserID = $row['userID'];
  $grabReviewDesc = "SELECT * from user where userID = '$reviewUserID'";
  $grabReviewDescRow = $conn->query($grabReviewDesc);
  $row2 = $grabReviewDescRow->fetch_assoc();
  $revUserFName = $row2['fname'];
  $revUserLName = $row2['lname'];
  $revUserPic = $row2['profilePicture'];
  $revUserUName = $row2['userName'];
  
 
  echo(
  "<div class='review'>
    <div class='leftReview'>
      <div class='reviewPicture'><a href='../profile?user=$revUserUName'><img src='$revUserPic' alt='profile picture' onerror='this.src=`https://www.srikiran.org/wp-content/uploads/2021/07/new_Avatar-Blank-Profile-Picture-Display-Pic-Mystery-Man-973460.png`'></a></div>
    </div>

    <div class='rightReview'>
      <div class='topReview'>
        <h3>$revUserFName $revUserLName</h3>
      </div>
      <div class='bottomReview'>
        <p>$review</p>
      </div>
    </div>
  </div>");
}
echo("</div>");








