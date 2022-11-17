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
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">    <meta charset="UTF-8">
        <link rel="stylesheet" href="css/custom.min.css">
        <link rel="stylesheet" href="css/style.css">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>TENSAI - Dashboard</title>
    </head>

    <body>
        <div class="container-fluid">
            <div class="row flex-nowrap">
                <!-- Navigation -->
                <div class="col-auto col-md-3 col-xl-2 px-sm-2 px-0 bg-palette1">
                    <div class="d-flex flex-column align-items-center align-items-sm-start px-3 pt-2 text-white min-vh-100">
                        <ul class="nav nav-pills flex-column mb-sm-auto mb-0 align-items-center align-items-sm-start" id="menu">

                            <li class="nav-item mt-4 mb-3 align-middle px-0"> <!-- Dashboard Page -->
                                <a class="nav-link active" aria-current="page" href="dashboard.php"><i class="bi bi-house-fill"></i><span class="ms-1 d-none d-sm-inline"><?php echo $_SESSION['fname']; ?></span></a>
                            </li>

                            <li class="nav-item mb-3 px-0 align-middle"> <!-- Account Management Page -->
                                <a class="nav-link" href="Accounts/manage.php"><i class="bi bi-person-lines-fill"></i><span class="ms-1 d-none d-sm-inline">Account Management</span></a>
                            </li>

                            <?php // School Management Page
                                if (isset($_SESSION['uType']) && $_SESSION['uType'] == "Admin") {
                                    echo "
                                        <li class=\"nav-item mb-3 px-0 align-middle\">
                                            <a class=\"nav-link\" href=\"Schools/manage.php\"><i class=\"bi bi-bank2\"></i><span class=\"ms-1 d-none d-sm-inline\">School Management</span></a>
                                        </li>
                                    ";
                                }
                            ?>

                            <?php // Section Management Page
                                if (isset($_SESSION['uType']) && $_SESSION['uType'] != "Admin") {
                                    echo "
                                        <li class=\"nav-item mb-3 px-0 align-middle\">
                                        <a class=\"nav-link\" href=\"Sections/manage.php\"><i class=\"bi bi-list-ul\"></i><span class=\"ms-1 d-none d-sm-inline\">Section Management</span></a>
                                        </li>
                                    ";
                                }
                            ?>

                            <li class="nav-item mb-3 px-0 align-middle"> <!-- Lesson Management Page -->
                                <a class="nav-link" href="Lessons/manage.php"><i class="bi bi-journal-text"></i><span class="ms-1 d-none d-sm-inline">Lesson Management</span></a>
                            </li>

                            <li class="nav-item mb-3 px-0 align-middle"> <!-- Assessment Page -->
                                <a class="nav-link" href="Assessments/manage.php"><i class="bi bi-ui-checks"></i><span class="ms-1 d-none d-sm-inline">Assessment Management</span></a>
                            </li>

                            <li class="nav-item mb-3 px-0 align-middle"> <!-- Report Generation Page -->
                                <a class="nav-link" href="Reports/manage.php"><i class="bi bi-bar-chart-line"></i><span class="ms-1 d-none d-sm-inline">Report Generation</span></a>
                            </li>

                            <li class="nav-item px-0 align-middle"> <!-- Logout Button -->
                                <a class="nav-link" href="functions/login/logout.php"><i class="bi bi-box-arrow-left"></i><span class="ms-1 d-none d-sm-inline">Logout</span></a>
                            </li>
                        </ul>
                    </div>
                </div>

                <!-- Main Container -->
                <div class="col">
                    <!--Dashboard Header-->
                    <div class="dashboard-head" style="background-image: url('src/bg1.jpg')">
                        <div class="head-overlay d-flex justify-content-center align-items-center">
                            <h3>Welcome, <?php echo $_SESSION['fname']; ?>!</h3>
                        </div>
                        <?php
                            echo "<h5>" . $_SESSION['uType'] . "</h5>";
                        ?>
                    </div>
                </div>

            </div>
            
        </div>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous"></script>
    </body>
</html>