<?php
    include('../scripts/conn.php');

    $link = $_GET['actual_link'];
    $notif = $_GET['notiNum'];
    $previous = "javascript:history.go(-1)";
    if(isset($_SERVER['HTTP_REFERER'])) {
        $previous = $_SERVER['HTTP_REFERER'];
    }
    $addon = "";

    if ($link === "link") {
        $addon = "?";

    }

    

    $SQL = "DELETE FROM notification WHERE notificationID = '$notif'";
    if ($conn->query($SQL) === TRUE) {
        echo "New record created successfully";
        header("location: $previous".$addon."&nocache='".time()."&notifOpen=true");
        echo($link);

      } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

?>
