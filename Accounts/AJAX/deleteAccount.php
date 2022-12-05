<?php

// Import PHP Scripts
require_once("../../functions/dbConn.php");
require_once("../Classes/accountManager.php");
//

// Variables
$manager = new accountManager($db);
//

// Process
// if ($manager->delete($_POST['email'])) {
//     echo "true";
// } else {
//     echo "false";
// }
if ($manager->terminate($_POST['accID'])) {
    echo "true";
} else {
    echo "false";
}
//