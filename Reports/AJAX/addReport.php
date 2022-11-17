<?php

// Import
if (session_status() === PHP_SESSION_NONE) {session_start();}

require_once("../../functions/dbConn.php");
require_once("../Classes/reportManager.php");
//

// Vars
$manager = new reportManager($db);
//

// Process
if ($manager->add($_POST['studentID'], $_POST['assessID'], $_POST['score'], $_POST['items'])) {
    echo "true";
} else {
    echo "false";
}
//