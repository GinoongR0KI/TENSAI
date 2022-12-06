<?php

// Import
require_once("../../../functions/dbConn.php");
require_once("../../Classes/pageManager.php");
//

//
$manager = new pageManager($db);

    // Process data here
$titleData = explode("'", $_POST['title']);
$title = "";

for ($i = 0; $i < count($titleData); $i++) {
    if ($i+1 >= count($titleData)) {
        $title .= $titleData[$i];
    } else {
        $title .= $titleData[$i] . "\'";
    }
}

$descriptionData = explode("'", $_POST['description']);
$desc = "";

for ($i = 0; $i < count($descriptionData); $i++) {
    if ($i+1 >= count($descriptionData)) {
        $desc .= $descriptionData[$i];
    } else {
        $desc .= $descriptionData[$i] . "\'";
    }
}

$pageData = explode("|amp|", $_POST['pageData']);
$pages = "";

for ($i = 0; $i < count($pageData); $i++) {
    if ($i+1 >= count($pageData)) {
        $pages .= $pageData[$i];
    } else {
        $pages .= $pageData[$i] . "&";
    }
}

$pageData = explode("'", $pages);
$pages = "";

for ($i = 0; $i < count($pageData); $i++) {
    if ($i+1 >= count($pageData)) {
        $pages .= $pageData[$i];
    } else {
        $pages .= $pageData[$i] . "\'";
    }
}
    //

//

// Process
if ($manager->save($_POST['lessonID'], $title, $desc, $pages)) {
    echo "true";
} else {
    echo "false";
}
//