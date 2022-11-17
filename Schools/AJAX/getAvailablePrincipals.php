<?php

// Import
require_once("../../functions/dbConn.php");
require_once("../Classes/accountDetail.php");
//

// Vars
$detail = new accountDetail($db);
//

// Process
$detail->getAvailablePrincipals();
//