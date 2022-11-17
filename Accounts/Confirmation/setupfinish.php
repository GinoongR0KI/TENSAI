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

    // Update the account information
if ($db->query($up)) {
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

<!DOCTYPE html>
<html lang="en">
<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">    <meta charset="UTF-8">
    <link rel="stylesheet" href="../../css/custom.min.css">
    <link rel="stylesheet" href="../../css/style.css">
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TENSAI - Setup your account</title>
</head>
<body>
        <div class="successful d-flex flex-column justify-content-center align-items-center">
            <div class="successful-header text-center">
                <h4>Account Setup Successful!</h4>
            </div>
            <div class="successful-mark text-center">
                <i class="bi bi-check-circle" style="color: #5FD068; font-size: 6rem;"></i>
            </div>
            <div class="successful-footer">
            <a href="../../login.php"><button type="button" class="btn btn-outline-palette2">GO TO LOG IN PAGE</button></a>
            </div>
        </div>
    
</body>
</html>