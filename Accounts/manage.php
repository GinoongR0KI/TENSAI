<?php
    // Import PHP scripts here
    require_once("../functions/dbConn.php"); // db connection
    require_once("../functions/security/redirector.php"); // used for creating sessions

    require_once("Classes/manageSB.php"); // used to customize this webpage.
    //

    // Variables
    $error = null; // used for notifications

    $redir = new redirector();

    $manageSB = new manageSB();
    //

    // Redirecting
    $redir->out("login.php"); // sends the unlogged user trying to access this page to login without logging in.
    //

    // Processing
        // Account Deletion
    if (isset($_GET['notif'])) {
        $error = $_GET['notif'];
    }
        //

    if (isset($error)) {echo $error;}

    //
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
    <link rel="stylesheet" href="../css/style.min.css">
    <link rel="stylesheet" href="../css/style.css">
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TENSAI | Accounts</title>
    <script>
    const myModal = document.getElementById('myModal')
    const myInput = document.getElementById('myInput')

    myModal.addEventListener('shown.bs.modal', () => {
        myInput.focus()
    })
    </script>

    <script src="AJAX/accounts.js"></script>
    <script src="AJAX/getAvailableSchools.js"></script>
    <script src="AJAX/createAccount.js"></script>

    <script src="../javascript/rower.js"></script>
    <script src="../javascript/modaler.js"></script>
    <script src="../javascript/toaster.js"></script>
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
            <div class="col-auto col-xs-3 col-md-3 col-xl-2 px-sm-2 px-0 min-vw-20">
                <div class="d-flex flex-column align-items-center align-items-sm-start px-3 pt-2 m-3 rounded-2 min-vh-95 position-fixed" style="background-color: #4C3575;">
                    <ul class="nav nav-pills flex-column mb-sm-auto mb-0 align-items-center align-items-sm-start">
                        <!--Links-->
                        <li class="nav-item m-2">
                            <a class="nav-link" href="../dashboard.php">Dashboard</a>
                        </li>
                        <li class="nav-item m-2">
                            <a class="nav-link active" href="manage.php">Accounts</a>
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
                            <a class="nav-link" href="../Reports/manage.php">Generate Report</a>
                        </li>
                        <li class="nav-item m-2">
                            <a class="nav-link" href="../functions/login/logout.php">Logout</a>
                        </li>
                    </ul>
                </div>
            </div>

            <!--Main Container-->
            <div class="col mt-5">
                <div class="row">
                    <div class="col mb-2">
                        <h3>Accounts Management</h3>
                    </div>
                </div>

                <div class="row mb-4 mt-4 me-5">
                    <div class="account-table d-flex flex-row position-relative shadow-sm p-3 mb-3 bg-body rounded">
                        <!--Search-->
                        <div class="col-5">
                            <div class="input-group mb-3 d-flex">
                                <input type="text" class="form-control" id="searchText" placeholder="Search . . ."
                                    aria-label="Search . . ." aria-describedby="searchBTN">
                                <button class="btn btn-button" type="button" id="searchBTN" onClick="getAccounts()">Search</button>
                            </div>
                        </div>
                        <div class="account-button position-absolute end-0 d-flex flex-row">
                            <!--Sort--><!-- <div class="col-auto me-4">

                                
                                <div class="dropdown">
                                    <button class="btn btn-button dropdown-toggle" type="button"
                                        data-bs-toggle="dropdown" aria-expanded="false">
                                        Sort
                                    </button>
                                    <ul class="dropdown-menu p-2">
                                        <li>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" value=""
                                                    id="flexCheckChecked" checked>
                                                <label class="form-check-label" for="flexCheckChecked">
                                                    School
                                                </label>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" value=""
                                                    id="flexCheckChecked" checked>
                                                <label class="form-check-label" for="flexCheckChecked">
                                                    Principal
                                                </label>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" value=""
                                                    id="flexCheckChecked" checked>
                                                <label class="form-check-label" for="flexCheckChecked">
                                                    Teacher
                                                </label>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" value=""
                                                    id="flexCheckChecked" checked>
                                                <label class="form-check-label" for="flexCheckChecked">
                                                    Student
                                                </label>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                            </div> -->
                            <div class="col pe-3">
                                <!--Add Account-->
                                <button type="button" class="btn btn-outline-button" data-bs-toggle="modal"
                                    data-bs-target="#addAccount">Add Account
                                </button>
                            </div>
                        </div>
                    </div>
                    <div class="table-container shadow-sm p-3 mb-5 bg-body rounded">
                        <table class="table table-hover table-responsive-sm">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">First Name</th>
                                    <th scope="col">Middle Name</th>
                                    <th scope="col">Last Name</th>
                                    <th scope="col">Email</th>
                                    <th scope="col">User Type</th>
                                    <th scope="col">Date Created</th>
                                    <th scope="col">Status</th>
                                    <th scope="col gap-3">Actions</th>
                                </tr>
                            </thead>
                            <tbody id="cont_accounts">
                                <!--Sample Data-->
                                <tr>
                                    <td>1</td>
                                    <td>First</td>
                                    <td>Middle</td>
                                    <td>Last</td>
                                    <td>sample@email.com</td>
                                    <td>type</td>
                                    <td>22 August 2022</td>
                                    <td>Active</td>
                                    <td>
                                        <div class="hover-button">
                                            <button type="button" class="btn btn-sm btn-button" data-bs-toggle="modal"
                                                data-bs-target="#editAccount"><i
                                                    class="bi bi-pencil-square"></i></button>
                                            <button type="button" class="btn btn-sm btn-button" data-bs-toggle="modal"
                                                data-bs-target="#deleteAccount"><i class="bi bi-trash3"></i></button>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>2</td>
                                    <td>First</td>
                                    <td>Middle</td>
                                    <td>Last</td>
                                    <td>sample@email.com</td>
                                    <td>type</td>
                                    <td>22 August 2022</td>
                                    <td>Active</td>
                                    <td>
                                        <div class="hover-button">N/A</div>
                                        
                                    </td>
                                </tr>
                                
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!--Modals-->
    <div id="cont_modals"></div>
    <!--Add Acount-->
    <div class="modal fade" id="addAccount" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="addAccountLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addAccountLabel">Add Account</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p id="regErrorModal"></p>
                    <div class="form-floating">
                        <input type="text" class="form-control mb-3" id="regInEmail" name="regInEmail" placeholder="Email">
                        <label for="emailInput">Email</label>
                    </div>

                    <?php
                        if ($_SESSION['uType'] == "Admin") {
                            echo "
                            <div class=\"form-floating mb-3\">
                                <select name=\"regInSchool\" class=\"form-select\" id=\"regInSchool\" aria-label=\"User Type\">
                                    <option value=\"null\" selected disabled>Select School</option>
                                    
                                </select>
                                <label for=\"regInSchool\">School ID</label>
                            </div>
                            ";

                            echo "<script>getAvailableSchools();</script>"; // This will retrieve the available schools and display to the generated selection
                        } else {
                            $uSchoolID = $_SESSION['schoolID'];
                            echo "<input type='hidden' id='regInSchool' value='$uSchoolID' readonly>";
                        }
                    ?>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn" data-bs-dismiss="modal">CANCEL</button>
                    <?php 
                        if ($_SESSION['uType'] != "Admin") {
                            if ($_SESSION['schoolID'] != null) {
                                echo '<button type="button" class="btn btn-button" id="confirmBox" name="nameInRegSubmit" onClick="createAccount()">CREATE</button>';
                            } else {
                                echo '<button type="button" class="btn btn-button" id="confirmBox" name="nameInRegSubmit" onClick="createAccount()" disabled>SCHOOL ID NEEDED</button>';
                            }
                        } else {
                            echo '<button type="button" class="btn btn-button" id="confirmBox" name="nameInRegSubmit" onClick="createAccount()">CREATE</button>';
                        }

                    ?>
                </div>
            </div>
        </div>
    </div>

    <!--Edit Account-->
    <div class="modal fade" id="editAccount" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="editAccountLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editAccountLabel">Edit Account</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="form-floating">
                        <input type="text" class="form-control mb-3" id="emailInput" placeholder="Email">
                        <label for="emailInput">Email</label>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn" data-bs-dismiss="modal">CANCEL</button>
                    <button type="button" class="btn btn-button" id="confirmBox">SAVE CHANGES</button>
                </div>
            </div>
        </div>
    </div>

    <!--Delete Account-->
    <div class="modal fade" id="deleteAccount" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="deleteAccountLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteAccountLabel">Delete Account</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p class="fs-5">Are you sure you want to deactive this account?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn" data-bs-dismiss="modal">CANCEL</button>
                    <button type="button" class="btn btn-button" id="btn_deactivate" data-bs-dismiss="modal">DEACTIVATE</button>
                </div>
            </div>
        </div>
    </div>


    <script>getAccounts();</script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-u1OknCvxWvY5kfmNBILK2hRnQC3Pr17a+RTT6rIHI7NnikvbZlHgTPOOmMi466C8" crossorigin="anonymous">
    </script>

    

</body>

</html>