<?php

if(session_status() === PHP_SESSION_NONE) {session_start();} // Checks and activates the session

// Import PHP Scripts
require_once("../../../functions/dbConn.php");
require_once("../../Classes/sectionManager.php");
//

// Variables
$manager = new sectionManager($db);
//

// Process
$manager->display($_POST['schoolID'], $_POST['search']);
//