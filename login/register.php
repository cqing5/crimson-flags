<?php
session_start();


//get user email from google
//if email in system {

// session_start();
// Session["Id"] = "1";  


//} else {

include "conn.php";
// assign variables
if($_SERVER['REQUEST_METHOD'] == "POST"){
  $fname = $_POST["fname"];
  $sanitized_fname = filter_var($fname, FILTER_SANITIZE_STRING);
  $lname = $_POST["lname"];
  $sanitized_lname = filter_var($lname, FILTER_SANITIZE_STRING);
  $dob = $_POST["dob"];
  $email = $_POST["email"];
  $phone = $_POST["phone"];
  $major = $_POST["major"];
  $bio = $_POST["bio"];
  $sanitized_bio = filter_var($bio, FILTER_SANITIZE_STRING);
  $username = $_POST["username"];
  $gender = $_POST["gender"];
  $profilePic= $_POST["profPic"];


  // if there are any empty fields, display error message
  if(empty($fname) || empty($lname) || empty($dob) || empty($email) || empty($phone) || empty($major) || empty($username) || empty($gender) || empty($bio)) {
      header("location: register_form.php?error=emptyfield");
      exit();
  }
  
  // if bio is too long, display error message
  if (strlen($_POST['bio']) > 255) {
    header("location: register_form.php?error=biolength");
    exit();
  }

  // if email is not valid, display error message
  if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
    header("location: register_form.php?error=invalidemail");
    exit();
  }

  //handle User Name :)
  $checkUserNameValid = "SELECT * FROM user where userName = '$username'";
  $run = $conn->query($checkUserNameValid);
  if (mysqli_num_rows($run) > 0) {
    header("location: register_form.php?error=userunavailable");
    exit();
  }
  




 // add user info to the database
$sql = "INSERT INTO user (fname, lname, dob, email, phone, major, bio, userName, gender, profilePicture) VALUES ('$sanitized_fname', '$sanitized_lname', '$dob', '$email', '$phone', '$major', '$sanitized_bio', '$username', '$gender','$profilePic')"; 

if ($conn->query($sql) === TRUE) {
  $grabUser = "SELECT * from user WHERE userName = '$username'";
  $grabUserID = $conn->query($grabUser);
  while($row = $grabUserID->fetch_assoc()) {
    $_SESSION['sessionUserID'] = $row['userID'];
    header("location: ../home/");
    exit();
  }
}
else {
  echo "Error: " . $sql . "<br>" . $conn->error;
}


}
// else, redirect to the register page 
else {
  header("location: register_form.php");
  exit();
}


?>