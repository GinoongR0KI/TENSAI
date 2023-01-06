<?php

// Import
require_once("../../../functions/dbConn.php");
require_once("../../Classes/pageManager.php");
//

//
$manager = new pageManager($db);

//

// Process
if ($manager->publish($_POST['lessonID'])) {
    echo "true";
} else {
    echo "false";
}
//