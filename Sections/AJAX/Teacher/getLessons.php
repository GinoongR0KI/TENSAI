<?php

// Import
if (session_status() === PHP_SESSION_NONE) {session_start();}

require_once("../../../functions/dbConn.php");
require_once("../../Classes/lessonManager.php");
//

//
$manager = new lessonManager($db);
//

//
$manager->displayLessons($_POST['search']);
//