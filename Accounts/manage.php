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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">    <meta charset="UTF-8">
    <link rel="stylesheet" href="../css/custom.min.css">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TENSAI - Account</title>
    <script>
        const myModal = document.getElementById('myModal')
        const myInput = document.getElementById('myInput')

        myModal.addEventListener('shown.bs.modal', () => {
        myInput.focus()
})


    </script>
    <script src="AJAX/accounts.js"></script>

    <script src="AJAX/getAvailableSchools.js"></script>

    <script src="AJAX/createAccount.js"></script> <!-- This script is used for creating accounts through an AJAX call -->
    <script src="AJAX/editAccount.js"></script>
    <script src="AJAX/deleteAccount.js"></script> <!-- This script is used for deleting accounts through an AJAX call -->

    <script src="../javascript/modaler.js"></script>
    <script src="../javascript/toaster.js"></script>
</head>
<body id="body">
    <!-- Toast -->
    <div aria-live="polite" aria-atomic="true" class="d-flex align-items-center">
        <div class="toast-container position-absolute" id="cont_toasts" style="position:fixed; bottom:1vh; right: 1vh">
            
        </div>
    </div>

    <!-- Toast -->
    
    <div class="container-fluid">
        <div class="row flex-nowrap">
            <!--Navigation-->
            <div class="col-auto col-md-3 col-xl-2 px-sm-2 px-0 bg-palette1">
            <div class="d-flex flex-column align-items-center align-items-sm-start px-3 pt-2 text-white min-vh-100">
                <ul class="nav nav-pills flex-column mb-sm-auto mb-0 align-items-center align-items-sm-start" id="menu">
                <li class="nav-item mt-4 mb-3 align-middle px-0">
                        <a class="nav-link" aria-current="page" href="../dashboard.php"><i class="bi bi-house-fill"></i><span class="ms-1 d-none d-sm-inline"><?php echo $_SESSION['fname']; ?></span></a>
                    </li>
                    <li class="nav-item mb-3 px-0 align-middle">
                        <a class="nav-link active" href="manage.php"><i class="bi bi-person-lines-fill"></i><span class="ms-1 d-none d-sm-inline">Account Management</span></a>
                    </li>
                    <?php
                        if (isset($_SESSION['uType']) && $_SESSION['uType'] == "Admin") {
                            echo "
                                <li class=\"nav-item mb-3 px-0 align-middle\">
                                    <a class=\"nav-link\" href=\"../Schools/manage.php\"><i class=\"bi bi-bank2\"></i><span class=\"ms-1 d-none d-sm-inline\">School Management</span></a>
                                </li>
                            ";
                        }
                    ?>
                    <?php
                        if (isset($_SESSION['uType']) && $_SESSION['uType'] != "Admin") {
                            echo "
                                <li class=\"nav-item mb-3 px-0 align-middle\">
                                <a class=\"nav-link\" href=\"../Sections/manage.php\"><i class=\"bi bi-list-ul\"></i><span class=\"ms-1 d-none d-sm-inline\">Section Management</span></a>
                                </li>
                            ";
                        }
                    ?>
                    <li class="nav-item mb-3 px-0 align-middle">
                        <a class="nav-link" href="../Lessons/manage.php"><i class="bi bi-journal-text"></i><span class="ms-1 d-none d-sm-inline">Lesson Management</span></a>
                    </li>

                    <li class="nav-item mb-3 px-0 align-middle">
                        <a class="nav-link" href="../Assessments/manage.php"><i class="bi bi-ui-checks"></i><span class="ms-1 d-none d-sm-inline">Assessment Management</span></a>
                    </li>
                    <li class="nav-item mb-3 px-0 align-middle">
                        <a class="nav-link" href="../Reports/manage.php"><i class="bi bi-bar-chart-line"></i><span class="ms-1 d-none d-sm-inline">Report Generation</span></a>
                    </li>
                    <li class="nav-item px-0 align-middle">
                        <a class="nav-link" href="../functions/login/logout.php"><i class="bi bi-box-arrow-left"></i><span class="ms-1 d-none d-sm-inline">Logout</span></a>
                    </li>
                </ul>
            </div>
        </div>

            <!--Main Container-->
            <div class="col">
                <h2 class="mt-5 mb-5">ACCOUNTS</h2>
                <div class="row mt-4 mb-4">

                    <!--Search-->
                    <div class="col input-group mb-3">
                        <input type="text" class="form-control" id="searchText" placeholder="Search" aria-label="Search" aria-describedby="search">
                        <button class="btn btn-outline-palette4 btn-palette2" type="button" id="searchBtn" onClick="getAccounts();"><i class="bi bi-search"></i></button>
                    </div>

                    <!--Add Section-->
                    <div class="col-2">
                        <button type="button" class="btn btn-outline-palette2" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
                            Add Account
                        </button>
                    </div>

                    <!--Upload-->
                    <!-- <div class="col-2">
                        <button type="button" class="btn btn-outline-palette2" data-bs-toggle="modal" data-bs-target="#upLoad">Upload</button>
                    </div> -->
                </div>

                <!--Tables-->
                <p id="msgError"></p>
                <table class="table table-hover mt-4">
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
                            <th scope="col">Actions</th>

                        </tr>
                    </thead>
                    <tbody data-bs-toggle="modal" data-bs-target="#accountEdit" id="cont_accounts">
                        <!--Added section will appear here-->
                        <!--Sample Data-->
                        <tr>
                            <td>1</td>
                            <td>Takasaki</td>
                            <td>Yuu</td>
                            <td></td>
                            <td>Student</td>
                            <td>yuutakasaki@nijigasaki.jp</td>
                            <td></td>
                            <td>22 August 2022</td>
                            <td>Active</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

                    <!--MODALS//OVERLAY-->
<div id="cont_modals"></div>
<!--Overlay Form //Account-->

<div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Add Account</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p id="regErrorModal"></p>
                <div class="form-floating">
                    <input name="regInEmail" type="email" class="form-control mb-3" id="regInEmail" placeholder="Email">
                    <label for="regInEmail">Email</label>
                </div>

                <div class="form-floating mb-3">
                    <select name="regInRoles" class="form-select" id="regInRoles" aria-label="User Type">
                        <option value="null" selected disabled>Select Type</option>
                        <?php // We should put this in a php file and use it as a simple command for this file.

                            $manageSB->loadRoles();

                        ?>
                        
                    </select>
                    <label for="regInRoles">User Type</label>
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
                            echo "
                                <button name=\"regInSubmit\" type=\"button\" class=\"btn btn-palette2\" onClick=\"createAccount();\">CREATE</button>
                            ";
                        } else {
                            echo "
                                <button name=\"regInSubmit\" type=\"button\" class=\"btn btn-palette2\" onClick=\"createAccount();\" disabled>SCHOOL ID NEEDED</button>
                            ";
                        }
                    } else {
                        echo "
                            <button name=\"regInSubmit\" type=\"button\" class=\"btn btn-palette2\" onClick=\"createAccount();\">CREATE</button>
                        ";
                    }
                ?>
            </div>
        </div>
        </div>
    </div>


    <!--Onclick Row-->
    <div class="modal fade" id="accountEdit" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Edit Account</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
            <div class="form-floating">
                    <input type="text" class="form-control mb-3" id="floatingInput" placeholder="Email">
                    <label for="floatingInput">Email</label>
                </div>
                <div class="form-floating">
                    <input type="text" class="form-control mb-3" id="floatingInput" placeholder="First Name">
                    <label for="floatingInput">First Name</label>
                </div>
                <div class="form-floating">
                    <input type="text" class="form-control mb-3" id="floatingInput" placeholder="Middle Name">
                    <label for="floatingInput">Middle Name</label>
                </div>
                <div class="form-floating">
                    <input type="text" class="form-control mb-3" id="floatingInput" placeholder="Last Name">
                    <label for="floatingInput">Last Name</label>
                </div>

                <!--if utype==teacher-->
                <!-- <div class="form-floating">
                    <input type="text" class="form-control mb-3" id="floatingInput" placeholder="Professional ID Number">
                    <label for="floatingInput">Professional ID Number</label>
                </div> -->
                

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-redcolor">DELETE</button>
                <button type="button" class="btn btn-palette2" data-bs-toggle="modal" data-bs-target="#accountEditNXT">NEXT</button>
            </div>
        </div>
        </div>
    </div>

    <div class="modal fade" id="accountEditNXT" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Edit Account</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
            <div class="form-floating">
                    <input type="text" class="form-control mb-3" id="floatingInput" placeholder="Date of Birth">
                    <label for="floatingInput">Date of Birth</label>
                </div>
                <div class="form-floating">
                    <input type="text" class="form-control mb-3" id="floatingInput" placeholder="Sex">
                    <label for="floatingInput">Sex</label>
                </div>
                <!--If utype==student-->

                <div class="form-floating">
                    <input type="text" class="form-control mb-3" id="floatingInput" placeholder="Guardian's Name">
                    <label for="floatingInput">Guardian's Name</label>
                </div>
                <div class="form-floating">
                    <input type="text" class="form-control mb-3" id="floatingInput" placeholder="Guardian's Contact Number">
                    <label for="floatingInput">Guardian's Contact Number</label>
                </div>
                <div class="form-floating">
                    <input type="text" class="form-control mb-3" id="floatingInput" placeholder="Guardian's Email">
                    <label for="floatingInput">Guardian's Email</label>
                </div>
                

            </div>
            <div class="modal-footer">
                <button type="button" class="btn" data-bs-toggle="modal" data-bs-target="#accountEdit">BACK</button>
                <button type="button" class="btn btn-outline-redcolor">DELETE</button>
                <button type="button" class="btn btn-palette2">SAVE</button>
            </div>
        </div>
        </div>
    </div>

    <!--Upload Modal-->
    <div class="modal fade" id="upLoad" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Upload</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
            <div class="form-floating">
                <input class="form-control" type="file" id="formFile">
            </div>
            </div>
        <div class="modal-footer">
            <button type="button" class="btn">CANCEL</button>
            <button type="button" class="btn btn-palette2">UPLOAD</button>
        </div>
        </div>
    </div>
    </div>


    <script>
        document.querySelector("#cont_accounts").innerHTML = "";
        getAccounts();
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous"></script>
</body>
</html>