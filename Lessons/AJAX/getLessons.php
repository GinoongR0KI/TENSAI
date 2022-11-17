<?php

// Import
if (session_status() === PHP_SESSION_NONE) {session_start();}

require_once("../../functions/dbConn.php");
require_once("../Classes/lessonManager.php");
//

// Vars
$manager = new lessonManager($db);
//

// Process
$manager->displayLessons($_POST['search']);
//