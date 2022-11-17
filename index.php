<?php

require_once("functions/dbConn.php");

if (isset($_SESSION['isLoggedTENSAI'])) { // Checks if the user is already logged in.
    header("Location: dashboard.php"); // Redirects the user to the appropriate location
    exit;
}

header("Location: login.php"); // Redirect the unlogged user to the login page.
exit;

?>