<?php

// Import

// require_once("../../functions/dbConn.php");
// require_once("../Classes/lessonManager.php");

//

//
// $manager = new lessonManager($db);
//

//
$filename = $_FILES['file']['name'];

$dest = "../../../src/lessons/".$filename;

if (move_uploaded_file($_FILES['file']['tmp_name'], $dest)) {
    echo "../src/lessons/".$filename;
} else {
    echo "failed";
}

// if (!file_exists("images/".$var)) {
//     $dest = "images/".$var;
//     file_put_contents($dest, file_get_contents($var));

//     echo "<img src='$dest'>";
// }

//