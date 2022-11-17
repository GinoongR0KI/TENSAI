<?php

// Import
if (session_status() === PHP_SESSION_NONE) {session_start();}

require_once("../../functions/dbConn.php");
require_once("../Classes/reportManager.php");
//

//
$manager = new reportManager($db);
//

//
$manager->reportSection($_SESSION['sectionID']);
//