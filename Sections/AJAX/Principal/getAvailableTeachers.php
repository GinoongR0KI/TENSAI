<?php

// Import PHP Scripts
if(session_status() === PHP_SESSION_NONE) {session_start();} // Checks and activates the session

require_once("../../../functions/dbConn.php");
require_once("../../Classes/teacherDetail.php");
//

// Variables
$manager = new teacherDetail($db);
//

// Process
$manager->getAvailableTeachers($_POST['schoolID']);
//