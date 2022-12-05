<?php

// Import
require_once("../../../functions/dbConn.php");
require_once("../../Classes/pageManager.php");
//

//
$manager = new pageManager($db);

    // Process data here
$pageData = explode("|amp|", $_POST['pageData']);
$pages = "";

for ($i = 0; $i < count($pageData); $i++) {
    if ($i+1 >= count($pageData)) {
        $pages .= $pageData[$i];
    } else {
        $pages .= $pageData[$i] . "&";
    }
}
    //

//

// Process
if ($manager->publish($_POST['lessonID'], $_POST['title'], $_POST['description'], $pages)) {
    echo "true";
} else {
    echo "false";
}
//