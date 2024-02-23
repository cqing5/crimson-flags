<?php  

//connect to database
include('../../../scripts/conn.php');


//eventually use sessions
$ourUserID = '2';

//get information from form
if (isset($_POST['delete'])) {
    $userID=$_POST['userID'];
    $fname=$_POST['fname'];
    $lname=$_POST['lname'];
    $dob=$_POST['dob'];
    $email=$_POST['email'];
    $phone=$_POST['phone'];
    $major=$_POST['major'];
    $bio=$_POST['bio'];
    $profilePicture=$_POST['profilePicture'];
    // $userName=$_POST['userName'];
    $Gender=$_POST['Gender'];   

     // Getting current user information from database
    $user_check_query = "SELECT * from user WHERE userID='$ourUserID'";
    $result = $conn->query($user_check_query);
    $row = mysqli_fetch_assoc($result);


    $sql = "DELETE FROM user WHERE userID = '$ourUserID'";


    if ($conn->query($sql) === TRUE) {
        echo("Records Deleted successfully");
    }
    else {
        echo("Error: ".$sql."<br>".$conn->error);
    }
    
    //return user to page
    header("location: ../");


} else {
    // header("location: index.php?errorEncountered");
    exit();
}


?> 