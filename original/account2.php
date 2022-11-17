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
    <script src="../javascript/accounts.js"></script>
    <script src="AJAX/createAccount.js"></script> <!-- This script is used for creating accounts through an AJAX call -->
    <script src="AJAX/deleteAccount.js"></script> <!-- This script is used for deleting accounts through an AJAX call -->
</head>
<body id="body">
    <div class="container-fluid">
        <div class="row">
            <!--Navigation-->
            <div class="col-2 bg-palette1">
                <ul class="nav nav-pills flex-column vh-100" style="position:sticky; top:0">
                    <li class="nav-item mt-4 mb-4">
                        <a class="nav-link" href="../dashboard.php"><i class="bi bi-house-fill"></i> Dashboard</a>
                    </li>
                    <li class="nav-item mb-4">
                        <a class="nav-link active" aria-current="page" href="manage.php"><i class="bi bi-person-lines-fill"></i> Account Management</a>
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
                        <a class="nav-link" href="../functions/login/logout.php"><i class="bi bi-box-arrow-left"></i> Logout</a>
                    </li>
                </ul>
            </div>

            <!--Main Container-->
            <div class="col">
                <h2 class="mt-5 mb-5">ACCOUNTS</h2>
                <div class="row mt-4 mb-4">

                    <!--Search-->
                    <div class="col input-group mb-3">
                        <input name="in_search" type="text" class="form-control" placeholder="Search" aria-label="Search" aria-describedby="search">
                        <button class="btn btn-outline-palette4 btn-palette2" type="button" id="search"><i class="bi bi-search"></i></button>
                    </div>

                    <!--Sort-->
                    <div class="col"> <!-- We also need to customize this depending on the role of the user -->
                        <div class="dropdown">
                            <button class="btn btn-palette3 dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                Sort
                            </button>
                            <ul class="dropdown-menu p-2">
                                <li>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" value="" id="sortOptAdmin" checked>
                                        <label class="form-check-label" for="sortOptAdmin">Admin</label>
                                    </div>
                                </li>
                                <li>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" value="" id="sortOptPrincipal" checked>
                                            <label class="form-check-label" for="sortOptPrincipal">
                                            Principal
                                            </label>
                                    </div>
                                </li>
                                <li>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" value="" id="sortOptTeacher" checked>
                                        <label class="form-check-label" for="sortOptTeacher">
                                            Teacher
                                        </label>
                                    </div>
                                </li>
                                <li>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" value="" id="sortOptStudent" checked>
                                        <label class="form-check-label" for="sortOptStudent">
                                        Student
                                        </label>
                                    </div>
                                </li>
                            </ul>

                        </div>

                    </div>
                    <!-- /Sort -->

                    <!--Upload-->
                    <div class="col">
                        <button type="button" class="btn btn-outline-palette2" data-bs-toggle="modal" data-bs-target="#upLoad">Upload</button>
                    </div>
                </div>
                <div class="row">

                    <!--Overlay Adding Section-->
                    <div class="col">
                        <button type="button" class="btn btn-outline-palette2" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
                            Add Account
                        </button>
                    </div>
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
                            <th scope="col">User Type</th>
                            <th scope="col">Email</th>
                            <th scope="col">Date Created</th>
                            <th scope="col">Status</th>

                        </tr>
                    </thead>
                    <tbody id="cont_accounts">
                        <!--Added section will appear here-->
                        <!--Sample Data-->
                        <tr data-bs-toggle="modal" data-bs-target="#accountEdit">
                            <td>1</td>
                            <td>Takasaki</td>
                            <td>Yuu</td>
                            <td></td>
                            <td>Student</td>
                            <td>yuutakasaki@nijigasaki.jp</td>
                            <td>22 August 2022</td>
                            <td>Active</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

                    <!--MODALS//OVERLAY-->
    
<!--Overlay Form //Account-->
<!-- <div class="cont_modals row" id="cont_modals"> -->
    <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Add Account</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" onClick="regFormDefault();"></button> <!-- Close button on the account creation modal -->
                </div>
                <form action="" method="POST">
                    <div class="modal-body">
                        <p id="regError"></p>
                        <div class="form-floating">
                            <input name="regInEmail" type="email" class="form-control mb-3" id="regInEmail" placeholder="Email"> <!-- Email Input for Registration -->
                            <label for="regInEmail">Email</label>
                        </div>
                        <div class="form-floating mb-3">
                            <select name="regInRoles" class="form-select" id="regInRoles" aria-label="User Type"> <!-- We need to determine which kind of user type the user is -->
                                <option value="null" selected disabled>Select Type</option>
                                <?php // We should put this in a php file and use it as a simple command for this file.

                                    $manageSB->loadRoles();

                                ?>
                                
                                
                            </select>
                            <label for="regOptRole">User Type</label>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn" data-bs-dismiss="modal">CANCEL</button>
                        <button name="regInSubmit" type="button" class="btn btn-palette2" onClick="createAccount();">CREATE</button>
                    </div>
                </form>
            </div>
            </div>
        </div>


        <!--Onclick Row--> <!-- This modal is for the account editing functionality -->
        <div class="modal fade" id="accountEdit" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Edit Account</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="form-floating">
                        <input type="email" class="form-control mb-3" id="floatingInput" placeholder="Email" readonly>
                        <label for="floatingInput">Email</label>
                    </div>
                    <!-- I don't think this field is necessary because it'd be a hash anyway -->
                    <!-- <div class="form-floating"> 
                        <input type="text" class="form-control mb-3" id="floatingInput" placeholder="Password">
                        <label for="floatingInput">Password</label>
                    </div> -->
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

                    <!-- This input is to be used only by teacher accounts. Hide this -->
                    <!-- <div class="form-floating"> 
                        <input type="text" class="form-control mb-3" id="floatingInput" placeholder="Professional ID Number">
                        <label for="floatingInput">Professional ID Number</label>
                    </div> -->
                    

                </div>
                <!-- This part of the modal should only be displayed for Admin / Principal accounts -->
                <!-- <div class="modal-footer"> 
                    <button class="btn btn-redcolor">DELETE</button>
                    <button class="btn btn-palette2">SAVE</button>
                </div> -->
                <!-- This part of the modal should be edited dynamically -->
                <div class="modal-footer"> 
                    <button type="button" class="btn btn-redcolor">DELETE</button>
                    <button type="button" class="btn btn-palette2" data-bs-toggle="modal" data-bs-target="#accountEditNXT">NEXT</button> <!-- Next button to activate the next modal -->
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
                        <input type="date" class="inputBDate form-control mb-3" id="floatingInput" placeholder="Date of Birth">
                        <label for="floatingInput">Date of Birth</label>
                    </div>
                    <div class="form-floating">
                        <!-- <input type="text" class="form-control mb-3" id="floatingInput" placeholder="Sex"> -->
                        <select class="form-control mb-3" id="floatingInput">
                            <option value="Male">Male</option>
                            <option value="Female">Female</option>
                            <option value="Others">Others</option>
                        </select>
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
                    <button type="button" class="btn btn-redcolor">DELETE</button>
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
                    <input class="form-control" type="file" id="formFile" accept=".xls, .xlsx, .cts"> <!-- This is the upload file input -->
                </div>
                </div>
            <div class="modal-footer">
                <button type="button" class="btn">CANCEL</button>
                <button type="button" class="btn btn-palette2">UPLOAD</button>
            </div>
            </div>
        </div>
        </div>

    <!-- </div> cont_modal -->


    <script>
        document.querySelector("#cont_accounts").innerHTML = "";
        getAccounts();

        // Setting maximum date
        var maxDate = new Date();
        var yy = maxDate.getFullYear() - 6;
        // console.log(yy);
        var dd = maxDate.getDate() < 10 ? '0' + maxDate.getDate() : maxDate.getDate();
        var mm = maxDate.getMonth() < 10 ? '0' + maxDate.getMonth() : maxDate.getMonth();
        var maxBDay = mm + "/" + dd + "/" + yy;
        document.querySelector(".inputBDate").setAttribute("max", maxBDay);
        //
        
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous"></script>
</body>
</html>