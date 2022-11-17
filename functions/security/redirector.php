<?php

if(session_status() === PHP_SESSION_NONE) {session_start();} // Checks and activates the session

class redirector {

    // Built-in Functions
    function __construct() {
        
    }
    // Built-in Functions

    // Custom Functions
    function out($destination) { // This function returns the user to the login page if they are not logged in. (useful for session_destroy())
        if (!isset($_SESSION['isLoggedTENSAI'])) {
            header("Location: $destination");
        }
    }

    function logged($destination) { // This function will most likely to be used only in the login page to redirect people back into the system.
        if (isset($_SESSION['isLoggedTENSAI'])) {
            header("Location: $destination");
        }
    }

    function unAuth($userType, $destination) { // This function keeps a specific unauthorized role out of a page.
        if ($_SESSION['uType'] == $userType) {
            header("Location: $destination");
        }
    }

    function exclusive($userType, $destination) { // This function makes the page exclusive for a specific role.
        if ($_SESSION['uType'] != $userType) {
            header("Location: $destination");
        }
    }

}