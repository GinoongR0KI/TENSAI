<?php

// Import PHP Scripts
require_once("../../functions/dbConn.php");
require_once("../Classes/schoolManager.php");
//

// Variables
$schoolManager = new schoolManager($db);
//

// Process
$schoolManager->displaySchools($_POST['search']);
//