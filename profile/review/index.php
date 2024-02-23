<form action="review/sendReview.php?rUser=<?php echo($userID);?>" method="POST">
<!-- text box for review -->
<div class="reviewBox">
  <textarea id="desc" class="text" name="review-txt" placeholder= "Write your review here (255 characters)..."></textarea>
</div>
<button type="submit" name="submit" value="Submit">Submit</button>
</form> 