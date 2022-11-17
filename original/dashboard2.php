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
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TENSAI - Dashboard</title>
</head>
<body>
    <div class="container-fluid">
        <div class="row">
            <!--Navigation-->
            <div class="col-2 bg-palette1">
                <ul class="nav nav-pills flex-column vh-100">
                    <li class="nav-item mt-4 mb-4">
                        <a class="nav-link active" aria-current="page" href="dashboard.php"><i class="bi bi-house-fill"></i> Dashboard</a>
                    </li>
                    <li class="nav-item mb-4">
                        <a class="nav-link" href="Accounts/manage.php"><i class="bi bi-person-lines-fill"></i> Account Management</a>
                    </li>
                    <?php
                        if (isset($_SESSION['uType']) && $_SESSION['uType'] != "Teacher") {
                            echo "
                                <li class=\"nav-item mb-4\">
                                    <a class=\"nav-link\" href=\"school.php\"><i class=\"bi bi-bank2\"></i> School Management</a>
                                </li>
                            ";
                        }
                    ?>
                    <li class="nav-item mb-4">
                        <a class="nav-link" href="section.php"><i class="bi bi-list-ul"></i> Section Management</a>
                    </li>
                    <li class="nav-item mb-4">
                        <a class="nav-link" href="lesson.php"><i class="bi bi-journal-text"></i> Lesson Management</a>
                    </li>
                    <li class="nav-item mb-4">
                        <a class="nav-link" href="assessment.php"><i class="bi bi-ui-checks"></i> Assessment Management</a>
                    </li>
                    <li class="nav-item mb-4">
                        <a class="nav-link" href="report.php"><i class="bi bi-bar-chart-line"></i> Report Generation</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="functions/login/logout.php"><i class="bi bi-box-arrow-left"></i> Logout</a>
                    </li>
                </ul>
            </div>


            <div class="col">
                <div class="row">
                    <!--Header-->
                    <h3 class="mt-5 left-6">Welcome, <?php echo $_SESSION['fname']; ?>!</h3>
                </div>

                <div class="row mb-5">
                    <div class="col bg-info clearfix">
                        <button type="button" class="btn btn-secondary float-start">My Account</button>
                        <button type="button" class="btn btn-secondary float-end">My Class</button>
                    </div>
                </div>
            </div>
    </div>
</div>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous"></script>
</body>
</html>