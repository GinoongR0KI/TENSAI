<?php

// Import

if (session_status() === PHP_SESSION_NONE) {session_start();}

// require_once("../../../functions/dbConn.php");
// require_once("../Classes/lessonManager.php");

//

//
// $manager = new lessonManager($db);
//

//
$filename = explode(".", $_FILES['file']['name']);
$nfn = time() . "." . end($filename);
$uID = $_SESSION['id'];
$fname = substr($_SESSION['fname'], 0, 1);
$lname = $_SESSION['lname'];

$dir = "../../../src/lessons/".$uID.$lname.$fname;
$dest = "../../../src/lessons/".$uID.$lname.$fname."/".$nfn;

if (!is_dir($dir)) {
    mkdir($dir);
}

if (move_uploaded_file($_FILES['file']['tmp_name'], $dest)) {
    echo "../src/lessons/".$uID.$lname.$fname."/".$nfn;
} else {
    echo "failed";
}

// if (!file_exists("images/".$var)) {
//     $dest = "images/".$var;
//     file_put_contents($dest, file_get_contents($var));

//     echo "<img src='$dest'>";
// }

//