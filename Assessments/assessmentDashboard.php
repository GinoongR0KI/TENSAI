<?php

// Import PHP Scripts
require_once("../functions/dbConn.php");
require_once("../functions/security/redirector.php");
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
    <link rel="stylesheet" href="../css/custom.min.css">
    <link rel="stylesheet" href="../css/student.css">
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TENSAI - Assessment List</title>

    <script src="AJAX/Students/assessments.js"></script>
    
    <script src="../javascript/toaster.js"></script>
    <script src="../RINA/rinaJS.js"></script>
</head>
<body>
    <!-- Toast -->
    <div aria-live="polite" aria-atomic="true" class="d-flex align-items-center">
        <div class="toast-container position-absolute" id="cont_toasts" style="position:fixed; bottom:1vh; right: 1vh">
            
        </div>
    </div>
    <!--  -->

    <input type="hidden" id="cont_studID" value="<?php echo $_SESSION['id']; ?>">

    <div class="tensai-body" style="background-image: url('../src/s1.jpg');">
        <div class="color-overlay d-flex flex-column">
            <div class="tensai-head d-flex">
                <div class="mb-2 p-3 justify-content-start align-items-start">
                <h1 class=>ASSESSMENT</h1>
                </div>

                <div class="mb-2 p-4 ms-auto">
                    <a href="../student.php" class="form-control" id="btn_back"><i class="bi bi-arrow-return-left"></i> GO BACK</a>
                </div>
            </div>

            <!--Lesson Cards-->
            <div class="container-fluid">
                <div style="position:fixed; bottom:10px;left:10px;">
                    <p id="rina_speech"></p>
                    <button id='btnTalk' onclick="logger()" onclick="audioCall()">Give Command!</button>
                </div>
                <div class="row row-cols-5 row-cols-md-2 g-4 mt-3">
                    <div class="col">
                        <div class="tensai-lesson d-flex flex-row">
                            <div class="card-group" id="cont_assessments">
                                <!--Sample card-->
                                <div class="card border-palette3 bg-transparent" style="width: 15rem;">
                                    <img src="../src/s2.jpg" class="card-img-top">
                                    <div class="card-body">
                                        <h5 class="card-title">ASSESSMENT 1</h5>
                                        <p class="card-text">This is about SCIENCE!!</p>
                                        <a href="assessment_viewer.php" class="btn btn-palette3">VIEW LESSON</a>
                                    </div>
                                </div>
                                
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>

    <!-- modals -->
        <!-- Logout Confirmation -->
    <div class="modal fade" id="rina_modalConfirmLogout" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Confirm Action</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Are you sure to logout?
                </div>
                <div class="modal-footer">
                    <a href="../functions/login/logout.php" id="btn_logout"><button type="button" class="btn btn-palette2" data-bs-dismiss="modal">LOGOUT</button></a>
                </div>
            </div>
        </div>
    </div>
    <!--  -->

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous"></script>
    
    <script>
        loadAssessments();
    </script>
</body>
</html>