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
            <div class="col-2 bg-background">
                <ul class="nav nav-pills flex-column vh-100">
                    <li class="nav-item mt-4 mb-4">
                        <a class="nav-link active" aria-current="page" href="dashboard.php"><i class="bi bi-house-fill"></i> Dashboard</a>
                    </li>
                    <li class="nav-item mb-4">
                        <a class="nav-link" href="Accounts/manage.php"><i class="bi bi-person-lines-fill"></i> Account Management</a>
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
                        <form action="functions/login/logout.php" method="POST">
                            <button type="submit" class="nav-link"><i class="bi bi-box-arrow-left"></i> Logout</button>
                        </form>
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



                <!--Account Setup form-->
                    <form class="row g-3"> <!-- We can use an AJAX call here to make the update query -->
                        <div class="col-md-4">
                        <label for="inputFName" class="form-label">First Name</label>
                            <input type="text" class="form-control" id="inputFName">
                        </div>
                        <div class="col-md-4">
                            <label for="inputMName" class="form-label">Middle Name</label>
                            <input type="text" class="form-control" palceholder="Optional" id="inputMName">
                        </div>
                        <div class="col-md-4">
                            <label for="inputLName" class="form-label">Last Name</label>
                            <input type="text" class="form-control" id="inputLName">
                        </div>

                        <div class="col-md-5">
                            <label for="inputEmail4" class="form-label">Email</label>
                                <input type="email" class="form-control" id="inputEmail4">
                        </div>
                        <div class="col-md-5">
                            <label for="inputPassword4" class="form-label">Password</label>
                                <input type="password" class="form-control" id="inputPassword4">
                        </div>
                        <div class="col-md-6">
                            <label for="inputProfID" class="form-label">Professional ID</label>
                                <input type="password" class="form-control" id="inputProfID">
                        </div>
                        <div class="col-md-6">
                            <label for="inputSchool" class="form-label">School</label>
                                <input type="password" class="form-control" id="inputSchool">
                        </div>
                    </form>

                    <div class="vstack gap-2 col-md-2 mx-auto mt-5">
                        <button type="button" class="btn btn-btncolor">Save changes</button>
                        <button type="button" class="btn btn-outline-secondary">Cancel</button>
                    </div>
            </div>
    </div>
</div>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous"></script>
</body>
</html>