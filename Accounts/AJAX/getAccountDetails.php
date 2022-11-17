<?php

require_once("../../functions/dbConn.php");
require_once("../Classes/AccountManager.php");

$accManager = new accountManager($db);

$accManager->getAccountDetails($_POST['email']);

?>