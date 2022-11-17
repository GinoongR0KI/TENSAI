<?php

// Import
require_once("../../functions/dbConn.php");
require_once("../Classes/assessmentManager.php");
//

//
$manager = new assessmentManager($db);
//

//
if ($manager->create($_POST['title'], $_POST['lessonID'])) {
    echo "true";
} else {
    echo "false";
}
//