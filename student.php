<?php

// Import PHP Scripts
require_once("functions/dbConn.php");
require_once("functions/security/redirector.php");
//

// Variables
$redir = new redirector();
//

// Redirecting
$redir->out("../login.php");
//

// Process

//

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
    <link rel="stylesheet" href="css/custom.min.css">
    <link rel="stylesheet" href="css/student.css">
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TENSAI - Dashboard</title>

    <script src="RINA/rinaJS.js"></script>
</head>
<body>
    <!-- Toast -->
    <div aria-live="polite" aria-atomic="true" class="d-flex align-items-center">
        <div class="toast-container position-absolute" id="cont_toasts" style="position:fixed; bottom:1vh; right: 1vh">
            
        </div>
    </div>

    <!-- Toast -->

    <!--Background-->
    <div class="tensai-body" style="background-image: url('src/s1.png');">
        <div class="color-overlay">
            <div class="tensai-account d-flex flex-start position-relative">
                <button type="button" class="btn btn-outline-palette2 position-absolute" data-bs-toggle="modal" data-bs-target="#rina_modalConfirmLogout">
                    <i class="bi bi-person-circle p-5 fs-5"></i>
                </button>
            </div>
            <div style="position:fixed; bottom:10px;left:10px;">
                <p id="rina_speech"></p>
                <button id='btnTalk' onclick="logger()" onclick="audioCall()">Give Command!</button>
            </div>
            <div class="d-flex justify-content-center align-items-center">
                <div class="tensai-text">
                    <h1 class="m-5">WELCOME, <?php echo $_SESSION['fname']; ?>!</h1>
                    <h3 class="m-5">What should we do today?</h3>
                    <a href="Lessons/lessonDashboard.php" class="btn btn-outline-palette4 btn-lg m-5 custBtn" id="btn_lessons"><img class="imgIcons" src="src/lessonIcon.png" alt="Lessons"><br/>Lessons</a> <!-- Lesson Viewing -->
                    <a href="Assessments/assessmentDashboard.php" class="btn btn-outline-palette4 btn-lg m-5 custBtn" id="btn_assessments"><img class="imgIcons" src="src/assessIcon.png" alt="Assessments"><br/>Assessments</a> <!-- Assessment Taking -->
                </div>
            </div>
        </div>
    </div>

    <!-- Modals -->
    <div class="modal fade" id="rina_modalConfirmLogout" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Logout</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Are you sure to logout?
                </div>
                <div class="modal-footer">
                    <a href="functions/login/logout.php" id="btn_logout"><button type="button" class="btn btn-palette2" data-bs-dismiss="modal">LOGOUT</button></a>
                </div>
            </div>
        </div>
    </div>
    <!--  -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous"></script>
</body>
</html>