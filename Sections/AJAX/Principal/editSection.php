<?php

// Import
require_once("../../../functions/dbConn.php");
require_once("../../Classes/sectionManager.php");
//

// Vars
$manager = new sectionManager($db);
//

// Process
if ($manager->edit($_POST['sectionID'], $_POST['sectionName'], $_POST['advisorID'])) {
    echo "true";
} else {
    echo "false";
}
//