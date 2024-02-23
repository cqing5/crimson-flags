<?php
session_start();
include("../../../scripts/conn.php");

//our user (eventually will be a session)
$ourUserID = $_SESSION['sessionUserID'];

//grab user information
$sqlGrabUserInformation = "SELECT * from user where userID = '$ourUserID'";
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
    $gender = $row['Gender'];
    $username = $row['username'];

}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./verify.css" />
    <title>test</title>
</head>
<body>
<main>
    <div class="profilePageWrapper">
        <div class="profileSection">
            <!-- <div class="titleSection">
                <h1> Verify Account </h1>
                <p> Please submit the following information to submit a verification request.</p>
            </div> -->
            <!-- <div class="container">
                <p>Verification is used as a way to confirm IU enrollment and allow other students to feel safer about matching. You do not need to be verified to use the platform; 
                however, verified users have a higher success rate of finding a good roommate match!</p>
        
                <p>You may have only one request open at a time. Our admins review each request as soon as possible and send a notification if you are approved or denied.</p>

            </div> -->
    
    <div class="container2">
        <p class="color"> Upload Proof of Being an IU Student <p>
        <form action="upload.php" method="post" enctype="multipart/form-data">
            <!-- <label for="file_name">Filename:</label> -->
            <input type="text" name="anyfile" id="anyfile">
            <!-- <p><strong>Note:</strong> Only .jpg, .jpeg, .png, .pdf formats allowed.</p> -->
            <button type="submit" name="submit" value="upload">Upload</button>
        
        </form> 
        <!-- <div class="textBox">
            <p class="color">Text Response</p>
            <textarea name="description" class="description" rows="4" cols="20"  resize="none" id="decription" placeholder="Provide any additional information here."> </textarea>
        </div> -->
        <br> 
        <br>
<!-- will add these back in later -->
        <!-- <input type="submit" name="submit" value="submit">
        <br>
        <input type="submit" value="cancel" name="cancel"> -->
    </div>
    
    
</div>
</main>
</body>
</html>