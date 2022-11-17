<?php

// Import
require_once("../../functions/dbConn.php");
require_once("../Classes/assessmentManager.php");
//

//
$manager = new assessmentManager($db);
//

//
if ($manager->delete($_POST['assessmentID'])) {
    echo "true";
} else {
    echo "false";
}
//