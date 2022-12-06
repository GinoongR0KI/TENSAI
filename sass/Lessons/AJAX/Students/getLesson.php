<?php

// Import
if (session_status() === PHP_SESSION_NONE) {session_start();}

require_once("../../../functions/dbConn.php");
require_once("../../Classes/lessonDisplayer.php");
//

//
$displayer = new lessonDisplayer($db);
//

//
$displayer->lessonDisplay($_POST['lessonID']);
//