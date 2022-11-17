<?php

if (session_status() === PHP_SESSION_NONE) {session_start();}

require_once("../../functions/dbConn.php");
require_once("../Classes/AccountManager.php");

$accManager = new accountManager($db);

$accManager->displayAccounts($_POST['search']);

?>