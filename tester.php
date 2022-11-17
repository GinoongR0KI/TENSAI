<?php

if (session_status() === PHP_SESSION_NONE) {session_start();}
require_once("functions/dbConn.php");
require_once("Reports/Classes/reportManager.php");
$manager = new reportManager($db);
echo $manager->getMonthlyReport(64);

// $test = explode("|amp|", 'You |amp|amp; I<div><img src="images/fbpfp.png"><br></div>|sep|<strike>This </strike>is a <b>test to see</b> how well <i>it </i><u>could </u>go.|sep|');
// $tester = "";
// for ($i = 0; $i < count($test); $i++) {
//     if ($i + 1 >= count($test)) {
//         $tester .= $test[$i];
//     } else {
//         $tester .= $test[$i] . "&";
//     }
// }
// echo $tester;

// if (session_status() === PHP_SESSION_NONE) {session_start();}
// require_once("functions/dbConn.php");
// require_once("Sections/Classes/lessonManager.php");
// $manager = new lessonManager($db);

// if ($manager->saveLesson("1,false.|.2,false.|.3,false")) {
    
// }

// if ($manager->saveLesson("1,false.|.2,true.|.3,false")) {
//     echo "true";
// } else {
//     echo "false";
// }
// $schoolGetter = new schoolDetail($db);
// $schoolGetter->getAvailableSchools();


// require_once("Accounts/Classes/AccountManager.php");

// $accManager = new accountManager($db);

// $accManager->displayAccounts("All", "ID");

// if (isset($_POST['inImage'])) {
//     $files = $_FILES['inImage']['name'];
//     $tempName = $_FILES['inImage']['tmp_name'];

//     echo "success";
//     echo $files;
//     echo "<br/>";
//     echo $tempName;
// } else {
//     echo "Image not set";
// }

// $code = "10SAI|1|".date("Y/m/d H:i:s");
// echo $code;
// $code = md5($code);
// echo "<br>" . $code;

// echo "<br>";

// $code = "10SAI|2|".date("Y/m/d H:i:s");
// echo $code;
// $code = md5($code);
// echo "<br>" . $code;

// $email = "mail.roqueperez@gmail.com";
// $code = "aun1yz7y9scdyzd7a8c209c2q";

// $content = file_get_contents("email/confirmation.php");

// echo $content;

// $content = sprintf($content, $email, $email, $code);

// echo $content;

// require_once("email.php");

// $mailer = new tensaimailer();
// $email = "mail.roqueperez@gmail.com";
// $code = "aun1yz7y9scdyzd7a8c209c2q";
// $content = file_get_contents("email/confirmation.php");
// $content = sprintf($content, $email, $email, $code);
// $mailer->send($email, "Account Activation", $content, $mailer->setHTML());

?>