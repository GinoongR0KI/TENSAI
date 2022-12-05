<?php

    // Import PHP scripts here
    require_once("functions/dbConn.php");
    require_once("functions/security/redirector.php");
    //

    // Variables
    $redir = new redirector();
    //

    // Redirecting
    $redir->out("login.php"); // sends the unlogged user trying to access this page to login without logging in.
    //
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">
    <link rel="stylesheet" href="css/style.min.css">
    <link rel="stylesheet" href="css/dashboard.css">
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TENSAI | Dashboard</title>
</head>

<body>
    <div class="container-fluid">
        <div class="row flex-nowrap">
            <!--Navigation-->
            <div class="col-auto col-xs-3 col-md-3 col-xl-2 px-sm-2 px-0 min-vw-20 position-fixed">
                <div class="d-flex flex-column align-items-center align-items-sm-start px-3 pt-2 m-3 rounded-2 min-vh-95"
                    style="background-color: #4C3575;">
                    <ul class="nav nav-pills flex-column mb-sm-auto mb-0 align-items-center align-items-sm-start">
                        <!--Links-->
                        <li class="nav-item m-2">
                            <a class="nav-link active" href="dashboard.php">Dashboard</a>
                        </li>
                        <li class="nav-item m-2">
                            <a class="nav-link" href="Accounts/manage.php">Accounts</a>
                        </li>
                        <?php

                            if ($_SESSION['uType'] == "Admin") {
                                echo '
                                <li class="nav-item m-2">
                                    <a class="nav-link" href="Schools/manage.php">School Management</a>
                                </li>
                                ';
                            }
                            if ($_SESSION['uType'] != "Admin") {
                                echo '
                                <li class="nav-item m-2">
                                    <a class="nav-link" href="Sections/manage.php">Section Management</a>
                                </li>
                                ';
                            }
                        ?>
                        <li class="nav-item m-2">
                            <a class="nav-link" href="Lessons/manage.php">Lessons Management</a>
                        </li>
                        <li class="nav-item m-2">
                            <a class="nav-link" href="Assessmenets/manage.php">Assessment Management</a>
                        </li>
                        <li class="nav-item m-2">
                            <a class="nav-link" href="Reports/manage.php">Generate Report</a>
                        </li>
                        <li class="nav-item m-2">
                            <a class="nav-link" href="functions/login/logout.php">Logout</a>
                        </li>
                    </ul>
                </div>
            </div>

            <!--Dashboard Container-->
            <div class="col-auto col-xs-9 offset-md-3 offset-xs-3">
                <div class="row">
                    <div class="col">
                        <div class="dashboard-head rounded-1 bg-palette1">
                            <div class="head-overlay d-flex justify-content-center align-items-center">
                                <h3>Welcome, <?php echo $_SESSION['fname'];?>!</h3>
                            </div>
                        </div>
                    </div>
                </div>

                <!--profile-->
                <div class="row">
                    <div class="col-auto mt-4">
                        <div class="profile-wrapper min-vh-60 rounded-2">
                            <div class="profile-header d-flex flex-row mt-4 ms-5">
                                <div class="m-3">
                                    <img class="profile-img" src="mat_icons/tensai_profile.png" alt="profile.png">
                                </div>
                                <div class="profile-info mt-4 ms-3">
                                    <h4><?php echo $_SESSION['fname'] . " " . $_SESSION['lname'] ?></h4>
                                    <h5><?php echo $_SESSION['uType']; ?></h5>
                                </div>
                            </div>
                            <div class="profile-body ms-5 mt-4">
                                <div class="other-info">
                                    <!-- <h5>School: <?php echo $_SESSION['schoolID']; ?></h5>
                                    <h5>Section: <?php echo $_SESSION['sectionID']; ?></h5> -->
                                    <!-- This needs to be converted to school and section names (not yet implemented by code) -->
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col mt-5 gap-2">
                        <!-- <div class="recent-activity min-vh-30 mt-3">
                            <h3>RECENT ACTIVITY</h3>
                        </div> -->

                        <?php

                            if ($_SESSION['uType'] == "Teacher") {
                                echo '
                                <div class="row mt-5 d-flex justify-content-center">
                                    <div class="col-auto d-flex flex-nowrap">
                                        <div class="create-wrapper d-flex flex-row gap-4">
                                            <button class="create" id="create-lesson">
                                                <a href="Lessons/manage.php">
                                                    <div class="button-name">CREATE LESSON</div>
                                                </a>
                                            </button>
                                            <button class="create" id="create-assessment">
                                                <a href="Assessments/manage.php">
                                                    <div class="button-name">CREATE ASSESSMENT</div>
                                                </a>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                                ';
                            }
                        
                        ?>
                        <script>
                            var lessonBtn = document.getElementById("create-lesson");
                            var assessBtn = document.getElementById("create-assessment");

                            if (!lessonBtn) {} else {
                                lessonBtn.addEventListener("click", function () {
                                    this.childNodes[1].click();
                                });
                            }

                            if (!assessBtn) {} else {
                                assessBtn.addEventListener("click", function () {
                                    this.childNodes[1].click();
                                });
                            }
                        </script>
                        
                    </div>
                </div>

                <!--Report Container-->
                <!-- <div class="row mt-5 mb-5">
                    <div class="col-auto">
                        <div class="report-wrapper">
                            Something graph here
                        </div>
                    </div>
                </div> -->
            </div>
        </div>
    </div>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-u1OknCvxWvY5kfmNBILK2hRnQC3Pr17a+RTT6rIHI7NnikvbZlHgTPOOmMi466C8" crossorigin="anonymous">
    </script>
</body>

</html>