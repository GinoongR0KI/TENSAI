<?php

// Import
if (session_status() === PHP_SESSION_NONE) {session_start();}

require_once("../../../functions/dbConn.php");
require_once("../../Classes/assessmentManager.php");
//

//
$manager = new assessmentManager($db);
//

//
$manager->displayAssessments($_POST['search']);
//