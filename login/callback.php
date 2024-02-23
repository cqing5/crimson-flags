<?php
    require_once "config.php";

    if (isset($_SESSION['access_token']))
        $client -> setAccessToken($_SESSION['access_token']);
    if (isset($_GET['code'])){
        $token = $client -> fetchAccessTokenWithAuthCode($_GET['code']);
        $_SESSION['access_token'] = $token;
    } else {
        header('Location: login.php');
        exit();
    }

    $oAuth = new Google_Service_Oauth2($client);
    $userData = $oAuth -> userinfo_v2_me -> get();

    $_SESSION['id'] = $userData['id'];
    $_SESSION['email'] = $userData['email'];
    $_SESSION['gender'] = $userData['gender'];
    $_SESSION['picture'] = $userData['picture'];
    $_SESSION['lname'] = $userData['familyName'];
    $_SESSION['fname'] =  $userData['givenName'];

    header('Location: register_form.php');
    exit();

?>
