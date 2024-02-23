<!-- JavaScript function for the Other text box -->
<script>
   function changeradioother(){
	  if(document.getElementById("Other").checked ) {
        if(document.getElementById("inputtext").value == ''){
            alert('input required');
        }
    }
    return false
    }
</script>

<!-- Form -->
<form action="report/report.php?rUser=<?php echo($userID);?>" method="POST" onsubmit="return changeradioother()">
  <!-- multiple choice options -->
  <div class="radioPair">
    <input type="radio" id="choice1" name="reason" value="Posting inappropriate context" required>
    <label for="choice1">Posting inappropriate content</label>
    </div>

    <div class="radioPair">
  <input type="radio" id="choice2" name="reason" value="Pretending to be someone else">
  <label for="choice2">Pretending to be someone else</label>
  </div>

  <div class="radioPair">
  <input type="radio" id="choice3" name="reason" value="Harassment or bullying">
  <label for="choice3">Harassment or bullying</label>
  </div>

  <div class="radioPair">
  <input type="radio" id="choice4" name="reason" value="Violence or threat of violence">
  <label for="choice4">Violence or threat of violence</label>
  </div>

  <div class="radioPair">
  <input type="radio" id="choice5" name="reason" value="Other">
  <label for="choice5">Other</label>
</div>

  <!-- text box for description -->
  <div class="radioPair">
  <textarea id="desc" class="text" name="reasonDesc" onchange="changeradioother()" placeholder= "(Optional) Briefly explain... (255 characters)"></textarea>
</div>
<button type="submit" class="submit-btn" name="submit" value="Submit">Submit</button>
</form> 