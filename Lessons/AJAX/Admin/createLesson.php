<?php

// Import
require_once("../../../functions/dbConn.php");
require_once("../../Classes/lessonManager.php");
//

// Vars
$manager = new lessonManager($db);
//

// Process
if ($manager->create($_POST['title'], $_POST['desc'], $_POST['teacherID'])) {
    echo "true";
} else {
    echo "false";
}
//