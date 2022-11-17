<?php

// Import PHP Scripts
if(session_status() === PHP_SESSION_NONE) {session_start();} // Checks and activates the session

require_once("../../../functions/dbConn.php");
require_once("../../Classes/sectionManager.php");
//

// Variables
$manager = new sectionManager($db);
//

// Process
$manager->getStudentCount($_POST['sectionID']);
//