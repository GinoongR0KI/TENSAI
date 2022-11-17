<?php

// Import PHP Scripts
require_once("../../functions/dbConn.php");
require_once("../Classes/schoolManager.php");
//

// Variables
$manager = new schoolManager($db);
//

// Process
if ($manager->edit($_POST['origID'], $_POST['schoolID'], $_POST['schoolName'], $_POST['municipality'], $_POST['principal'])) {
    echo "true";
} else {
    echo "false";
}
//