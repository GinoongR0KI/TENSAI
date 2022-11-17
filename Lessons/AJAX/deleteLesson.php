<?php

// Import
require_once("../../functions/dbConn.php");
require_once("../Classes/lessonManager.php");
//

//
$manager = new lessonManager($db);
//

//
if ($manager->delete($_POST['lessonID'])) {
    echo "true";
} else {
    echo "false";
}
//