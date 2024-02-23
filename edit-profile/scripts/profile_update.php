<?php  
session_start();
//connect to database
include('../../scripts/conn.php');

$uName = $_GET['user'];
//eventually use sessions
$ourUserID = $_SESSION['sessionUserID'];

//get information from form
if (isset($_POST['update'])) {
    $userID=$_POST['userID'];
    $fname=$_POST['fname'];
    $sanitized_fname = filter_var($fname, FILTER_SANITIZE_STRING);
    $lname=$_POST['lname'];
    $sanitized_lname = filter_var($lname, FILTER_SANITIZE_STRING);
    $dob=$_POST['dob'];
    $phone=$_POST['phone'];
    $major=$_POST['major'];
    $bio=$_POST['bio'];
    $sanitized_bio = filter_var($bio, FILTER_SANITIZE_STRING);
    $Gender=$_POST['gender'];   

  // if bio is too long, display error message
    // if (strlen($_POST['bio']) > 255) {
    //     header("location: index.php?error=biolength");
    //     exit();
    // }

    // Getting current user information from database
    $user_check_query = "SELECT * from user WHERE userID='$ourUserID'";
    $result = $conn->query($user_check_query);
    $row = mysqli_fetch_assoc($result);


    $sql = "UPDATE user SET fname='$sanitized_fname', lname='$sanitized_lname', dob='$dob', phone='$phone', major='$major', Gender='$Gender', bio='$sanitized_bio' WHERE userID = '$ourUserID'";


    if ($conn->query($sql) === TRUE) {
        echo("Records updated successfully");
    }
    else {
        echo("Error: ".$sql."<br>".$conn->error);
    }
    
    //return user to page
    header("location: ../../profile/?user=$uName");


} else {
    header("location: index.php?errorEncountered");
    exit();
}


?> 