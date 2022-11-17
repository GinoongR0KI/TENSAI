<?php

// Import
if (session_status() === PHP_SESSION_NONE) {session_start();}

require_once("../../../functions/dbConn.php");
require_once("../../Classes/assessmentDisplayer.php");
//

//
$displayer = new assessmentDisplayer($db);
//

//
$displayer->dashboardDisplay();
//