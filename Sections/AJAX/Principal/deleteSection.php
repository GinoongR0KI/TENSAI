<?php

// Import PHP Scripts
require_once("../../../functions/dbConn.php");
require_once("../../Classes/sectionManager.php");
//

// Variables
$manager = new sectionManager($db);
//

// Process
if ($manager->delete($_POST['id'])) {
    echo "true";
} else {
    echo "false";
}
//