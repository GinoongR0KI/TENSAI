<?php

// Import
if (session_status() === PHP_SESSION_NONE) {session_start();}

require_once("../../../functions/dbConn.php");
require_once("../../Classes/questionManager.php");
//

//
$manager = new questionManager($db);
//

//
$manager->displayQuestions($_POST['assessID']);
//