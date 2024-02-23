<?php
session_start();
require_once 'google-api/vendor/autoload.php';

//Creating client request
$client = new Google_Client();
$client -> setClientId('374585355189-mu0rd45fm5chgi2ps6fnidt8tlhb3545.apps.googleusercontent.com');
$client -> setClientSecret('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');
$client -> setRedirectUri('https://cgi.luddy.indiana.edu/~team01/login/callback.php');
$client -> addScope('profile');
$client -> addScope('email');
?>
