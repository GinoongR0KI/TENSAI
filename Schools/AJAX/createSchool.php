<?php

// Import PHP Scripts
require_once("../../functions/dbConn.php");
require_once("../../functions/school/schoolManager.php");
//

// Variables
$manager = new schoolManager($db);
//

// Process
if ($manager->create($_POST['schoolID'], $_POST['schoolName'], $_POST['municipality'], $_POST['principalID'])) {
    echo "true";
} else {
    echo "false";
}
//