<?php

// Import PHP Scripts
require_once("../../functions/dbConn.php");
//

// Variables
    // Account
$email = mysqli_real_escape_string($db, $_POST['email']);
$pass = mysqli_real_escape_string($db, $_POST['password']);
$passConfirm = mysqli_real_escape_string($db, $_POST['passwordConfirm']);
$uType = mysqli_real_escape_string($db, $_POST['uType']);
    //

    // General
$fname = mysqli_real_escape_string($db, $_POST['fname']);
$mname = mysqli_real_escape_string($db, $_POST['mname']);
$lname = mysqli_real_escape_string($db, $_POST['lname']);
    //

    // Other Info
        // Student
if (isset($_POST['gfname'])) {$gfname = mysqli_real_escape_string($db, $_POST['gfname']);}
if (isset($_POST['gmname'])) {$gmname = mysqli_real_escape_string($db, $_POST['gmname']);}
if (isset($_POST['glname'])) {$glname = mysqli_real_escape_string($db, $_POST['glname']);}
if (isset($_POST['gemail'])) {$gemail = mysqli_real_escape_string($db, $_POST['gemail']);}
if (isset($_POST['gcontact'])) {$gcontact = mysqli_real_escape_string($db, $_POST['gcontact']);}
        //

        // Teacher
if (isset($_POST['profID'])) {$profID = mysqli_real_escape_string($db, $_POST['profID']);}
        //
    //

$sel = "SELECT id FROM uAccounts WHERE email = '$email';";
$selQ = $db->query($sel);

if ($selQ->num_rows > 0) {
    while ($result = $selQ->fetch_assoc()) {
        $id = $result['id'];
    }
}

$pass = password_hash($pass, PASSWORD_BCRYPT);
$up = "UPDATE uAccounts SET password = '$pass', fname = '$fname', mname = '$mname', lname = '$lname', isActivated = 1 WHERE email = '$email';";
switch ($uType) {
    case "Teacher":
        $upTeacher = "UPDATE uTeachers SET profID = $profID WHERE id = $id;";
    break;
    case "Student":
        $upStudent = "UPDATE uStudents SET gfname = '$gfname', gmname = '$gmname', glname = '$glname', gcontact = $gcontact, gemail = '$gemail' WHERE id = $id;";
    break;
}
//

// Process

// if ($pass != $passConfirm) { // go back because passwords don't match
//     echo "<script>history.go(-1);</script>";
//     exit;
// }

    // Update the account information
if ($db->query($up)) {
    echo "true";
    $del = "DELETE FROM etcCodes WHERE email = '$email';";
    $db->query($del);
}
switch ($uType) {
    case "Teacher":
        $db->query($upTeacher);
    break;
    case "Student":
        $db->query($upStudent);
    break;
}

    //

//
?>

<h1>Thank you for Registering!</h1>
<p>You my now login with your account</p>
<button><a href="../../login.php">TO LOGIN PAGE</a></button>