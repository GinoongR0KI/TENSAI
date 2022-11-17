<?php

// Import PHP Scripts
require_once("../../../functions/dbConn.php");
require_once("../../Classes/sectionManager.php");
//

// Variables
$manager = new sectionManager($db);
//

// Process
if ($manager->create($_POST['sectionName'], $_POST['schoolID'], $_POST['advisorID'])) {
    echo "true";
} else {
    echo "false";
}
//