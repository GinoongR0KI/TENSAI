<?php

// Import PHP Scripts
require_once("../../functions/dbConn.php");
require_once("../Classes/schoolManager.php");
//

// Variables
$manager = new schoolManager($db);
//

// Process
if ($manager->delete($_POST['schoolID'])) {
    echo "true";
} else {
    echo "false";
}
//