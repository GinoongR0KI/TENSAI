<?php

// Import
require_once("../../functions/dbConn.php");
require_once("../Classes/schoolDetail.php");
//

// Vars
$detail = new schoolDetail($db);
//

// Process
$detail->getAvailableSchools();
//