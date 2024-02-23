<?php

require_once 'config.php';
$google_login_btn = '<a href="'.$client->createAuthUrl().'"><img src="g-signin-btn.png" alt="sign-in button"/></a>';

// // $loginURL = $client -> createAuthUrl();
// session_start();

// if(!isset($_SESSION['access_token'])) {
//     //Create URL to obtain user authorization
//     $google_login_btn = '<a href="'.$client->createAuthUrl().'"><img src="g-signin-btn" /></a>';
//    } else {
//      header("Location: register_form.php");
//    }

// if(isset($_GET["code"]))
// {
// // attempt to exchange a code for an valid authentication token
// $token = $google_client->fetchAccessTokenWithAuthCode($_GET["code"]);
// // check if error occurs during geting authentication token
// if(!isset($token['error']))
// {
// // set access token used for requests
// $client->setAccessToken($token['access_token']);
// // store "access_token" value in $_SESSION variable for future use.
// $_SESSION['access_token'] = $token['access_token'];
// // create object of Google Service OAuth 2 class
// $google_service = new Google_Service_Oauth2($google_client);
// // get user profile data from Google
// $data = $google_service->userinfo->get();
// //  Get profile data and store into $_SESSION variable
// if(!empty($data['given_name']))
// {
// $fname = $data['given_name'];
// echo $fname;
// }
// }
// }
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="login.css">
    <title>Crimson Flags</title>

</head>

<body>

        

        <div id='login'>
            <div class='login__left'>
                <h1>Crimson Flags</h1>
                <p> Match, connect with, and find your future roommate!</p>
                <img src='samplegates.png' alt='sample gates'>
            </div>
            <div class='login__right'>
                <div class='login-wrapper'>
                    <h2> Login </h2>
                    <p> Crimson Flags links to your Google profile! All users, sign in below: </p>
                    <div class='login-box'><?php echo '<div align="center">'.$google_login_btn . '</div>' ?></div>
                </div>
            </div>
        </div>
</body>
</html>