<?php

// Import
if (session_status() === PHP_SESSION_NONE) {session_start();}

require_once("../../../functions/dbConn.php");
require_once("../../Classes/lessonDetail.php");
//

//
$detail = new lessonDetail($db);
//

//
$detail->getAvailableLessons();
//