<?php

// Import
if (session_status() === PHP_SESSION_NONE) {session_start();}

require_once("../../../functions/dbConn.php");
require_once("../../Classes/studentManager.php");
//

//
$manager = new studentManager($db);
//

//
if ($manager->saveStudent($_POST['values'])) {
    echo "true";
} else {
    echo "false";
}
//