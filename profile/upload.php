<?php 
session_start();
include("../scripts/conn.php");

$currentUser =  $_GET['user'];

$sqlGrabUserInformation = "SELECT * from user where userName = '$currentUser'";
$userInformation = $conn->query($sqlGrabUserInformation);

while ($row = $userInformation->fetch_assoc()) {
  $userID = $row['userID'];
}



if(isset($_POST['submit'])) {
    echo 'no';
    $file = $_FILES['anyfile'];
    $fileName = $_FILES['anyfile']['name'];
    $fileTmpName = $_FILES['anyfile']['tmp_name'];
    $fileSize = $_FILES['anyfile']['size'];
    $fileError = $_FILES['anyfile']['error'];
    $fileType = $_FILES['anyfile']['type'];
    $verificationDescription = $_POST['verificationDescription'];

    $fileExt = explode('.', $fileName); 
    $fileActualExt = strtolower(end($fileExt));

    print_r($_FILES);

    if ($fileError === 0) {
        echo("no ERRROR");
        
        if ($fileSize < 1000000) {
            echo('file is good size');
    
            if ($fileActualExt === "jpg") {
                echo("file correct type");
        

                $fileNameNew = $currentUser.'.jpg';
                $fileDestination = "images/".$fileNameNew;
                if(move_uploaded_file($fileTmpName, $fileDestination)) {
                    echo('uploadWorked');
                    chmod($fileDestination, 0755);

                    
                    $checkIfValidateExists = "SELECT * from verification where userID = '$userID'";
                    $checkVerification = $conn->query( $checkIfValidateExists);

                    if(mysqli_num_rows($checkVerification) > 0) {
                        $sql = "UPDATE verification SET description = '$verificationDescription', proofOfIdentity = '$fileDestination' WHERE userID = '$userID'";
                    } else {
                        $sql = "INSERT INTO verification (userID, description, proofOfIdentity) VALUES ('$userID','$verificationDescription', '$fileDestination')";
                    }

                    if ($conn->query($sql) === TRUE) {
                        header("location: ./?user=$currentUser");
                    }
                    else {
                        echo "Error: $conn->error";
                    }
            
                } else {
                    echo('upload failed');
                }

            } else {
                echo('must be jpg');
            }

        } else {
            echo('file too big');
        }
    
    
    } else {
        echo('encountered an error');
    }

}else{
echo 'yes';
} 

?>