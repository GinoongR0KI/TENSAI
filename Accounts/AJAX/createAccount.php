<?php

// Import PHP Scripts
require_once("../../functions/dbConn.php");
require_once("../../functions/registration/registration.php");
//

// Variables
$reg = new registration($db);
$email = null;
$role = null;
$school = null;

if (isset($_POST['regInEmail'])) {$email = $_POST['regInEmail'];}

// if (isset($_POST['regInRoles'])) {
//     if ($_POST['regInRoles'] != "null" || $_POST['regInRoles'] != null || $_POST['regInRoles'] != "") {
//         $role = $_POST['regInRoles'];
//     }
// }

if (isset($_POST['regInSchoolID'])) {$school = $_POST['regInSchoolID'];}
//

// Process
if ($reg->createAccount($email, $school)) {
    echo "true";
} else {
    echo "false";
}
//