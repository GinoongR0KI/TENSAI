<?php

// Import
if(session_status() === PHP_SESSION_NONE) {session_start();} // Checks and activates the session

require_once("../../functions/dbConn.php");
require_once("../Classes/schoolManager.php");
//

//
$manager = new schoolManager($db);
//

//
$manager->getPrincipalName($_POST['principalID']);
//