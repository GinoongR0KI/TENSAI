<?php

    // This php script is solely for the functionality to logout the user's session.

    if(session_status() === PHP_SESSION_NONE) {session_start();} // Checks and activates the session
    session_destroy(); // destroys the session.

    header("Location: ../../login.php"); // sends the user back to the login page.

?>