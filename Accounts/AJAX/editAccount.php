<?php

// Import PHP Scripts
require_once("../../functions/dbConn.php");
require_once("../Classes/accountManager.php");
//

// Variables
$manager = new accountManager($db);
//

// Process
switch ($_POST['uType']) {
    case "Teacher":
        if ($manager->editTeacher($_POST['email'], $_POST['fname'], $_POST['mname'], $_POST['lname'], $_POST['profID'], $_POST['schoolID'])) {
            echo "true";
        } else {
            echo "false";
        }
    break;
    case "Student":
        if ($manager->editStudent($_POST['email'], $_POST['fname'], $_POST['mname'], $_POST['lname'], $_POST['bday'], $_POST['sex'], $_POST['gfname'], $_POST['gmname'], $_POST['glname'], $_POST['gcontact'], $_POST['gemail'])) {
            echo "true";
        } else {
            echo "false";
        }
    break;
    default:
        if ($manager->edit($_POST['email'], $_POST['fname'], $_POST['mname'], $_POST['lname'])) {
            echo "true";
        } else {
            echo "false";
        }
    break;
}
//