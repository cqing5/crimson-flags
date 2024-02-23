<?php

include("config.php");
//Reset OAuth access token
$client->revokeToken();
//Destroy  session data
session_destroy();
//redirect page to login
header("location: ../");

?>