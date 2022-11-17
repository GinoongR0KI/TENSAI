<?php

// Import PHP Scripts
require_once("../../functions/dbConn.php");
require_once("../Classes/schoolGetter.php");
//

// Variables
$getter = new schoolGetter($db);
//

// Process
$getter->getID($_POST['uType']);
//