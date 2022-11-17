<?php

// Import
require_once("../../functions/dbConn.php");
require_once("../Classes/pageManager.php");
//

//
$manager = new pageManager($db);
//

//
$manager->displayLesson($_POST['lessonID']);
//