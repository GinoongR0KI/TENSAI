<?php

require_once("functions/dbConn.php");

if (isset($_SESSION['isLoggedTENSAI'])) { // Checks if the user is already logged in.
    header("Location: dashboard.php"); // Redirects the user to the appropriate location
    exit;
}

header("Location: login.php"); // Redirect the unlogged user to the login page.
exit;

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="manifest" href="../manifest.json">
    <title>Document</title>
</head>
<body>
    
</body>
</html>