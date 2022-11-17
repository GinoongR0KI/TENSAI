<?php

// Import
if (session_status() === PHP_SESSION_NONE) {session_start();}

require_once("../../functions/dbConn.php");
require_once("../Classes/reportManager.php");
//

//
$manager = new reportManager($db);
//

//
if (isset($_SESSION['uType'])) {
    switch ($_SESSION['uType']) {
        case "Admin":
            $manager->reportStudentsAdmin($_POST['search']);
        break;
        case "Principal":
            $manager->reportStudentsPrincipal($_SESSION['schoolID'], $_POST['search']);
        break;
        case "Teacher":
            $manager->reportStudentsTeacher($_SESSION['sectionID'], $_POST['search']);
        break;
    }
}
//