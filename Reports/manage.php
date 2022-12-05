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
$redir->unAuth("Student", "../");
//

// Process

//

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
    <link rel="stylesheet" href="../css/style.min.css">
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TENSAI | Generate Report</title>

    <script src="AJAX/reports.js"></script>

    <script src="../javascript/toaster.js"></script>
    <script src="../javascript/carder.js"></script>
</head>

<body>
    <!-- Toast -->
    <div aria-live="polite" aria-atomic="true" class="d-flex align-items-center">
        <div class="toast-container position-fixed" id="cont_toasts" style="bottom:1vh; right: 1vh">
            
        </div>
    </div>

    <!-- Toast -->
    <div class="container-fluid">
        <div class="row flex-nowrap">
            <!--Navigation-->
            <div class="col-auto col-md-3 col-xl-2 px-sm-2 px-0 min-vw-20">
                <div class="d-flex flex-column align-items-center align-items-sm-start px-3 pt-2 m-3 rounded-2 min-vh-95 position-fixed" style="background-color: #4C3575;">
                    <ul class="nav nav-pills flex-column mb-sm-auto mb-0 align-items-center align-items-sm-start">
                        <!--Links-->
                        <li class="nav-item m-2">
                            <a class="nav-link" href="../dashboard.php">Dashboard</a>
                        </li>
                        <li class="nav-item m-2">
                            <a class="nav-link" href="../Accounts/manage.php">Accounts</a>
                        </li>
                        <?php

                            if ($_SESSION['uType'] == "Admin") {
                                echo '
                                <li class="nav-item m-2">
                                    <a class="nav-link" href="../Schools/manage.php">School Management</a>
                                </li>
                                ';
                            }

                            if ($_SESSION['uType'] != "Admin") {
                                echo '
                                <li class="nav-item m-2">
                                    <a class="nav-link" href="../Sections/manage.php">Section Management</a>
                                </li>
                                ';
                            }
                        ?>
                        
                        <li class="nav-item m-2">
                            <a class="nav-link" href="../Lessons/manage.php">Lessons Management</a>
                        </li>
                        <li class="nav-item m-2">
                            <a class="nav-link" href="../Assessments/manage.php">Assessment Management</a>
                        </li>
                        <li class="nav-item m-2">
                            <a class="nav-link active" href="manage.php">Generate Report</a>
                        </li>
                        <li class="nav-item m-2">
                            <a class="nav-link" href="../functions/login/logout.php">Logout</a>
                        </li>
                    </ul>
                </div>
            </div>

            <!--Account Container-->
            <div class="col mt-5">
                <div class="row">
                    <div class="col mb-2">
                        <h3>Reports Management</h3>
                    </div>
                </div>

                <div class="row mb-4 mt-4 me-5">
                    <div class="account-table d-flex flex-row position-relative shadow-sm p-3 mb-3 bg-body rounded">
                        <!--Search-->
                        <div class="col-5">
                            <div class="input-group mb-3 d-flex">
                                <input type="text" class="form-control" id="searchStudents" placeholder="Search . . ." aria-label="Search . . ." aria-describedby="searchBTN">
                                <button class="btn btn-button" type="button" id="searchBTN" onClick="getStudents()">Search</button>
                            </div>
                        </div>
                    </div>

                    <div class="table-container shadow-sm p-3 mb-5 bg-body rounded"> <!-- This is going to be the container of the report management page -->
                        <h4>Students:</h4>
                        <div id="cont_students"></div>

                        <!--Hidden-->
                        <input type="hidden" id="hiddenUserID" value="<?php echo $_SESSION['id']; ?>"> <!-- Used for some script -->
                        <input type="hidden" id="hiddenUserType" value="<?php echo $_SESSION['uType']; ?>"> <!-- Used for some script -->
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-u1OknCvxWvY5kfmNBILK2hRnQC3Pr17a+RTT6rIHI7NnikvbZlHgTPOOmMi466C8" crossorigin="anonymous"></script>
    <script>
        // Get all students
        getStudents();
    </script>

</body>

</html>