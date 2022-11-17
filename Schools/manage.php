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
$redir->exclusive("Admin","../dashboard.php");
//

// Process

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
    <title>TENSAI - School</title>
    <script>
        const myModal = document.getElementById('myModal')
        const myInput = document.getElementById('myInput')

        myModal.addEventListener('shown.bs.modal', () => {
        myInput.focus()
})
    </script>

    <script src="AJAX/schools.js"></script>

    <script src="AJAX/getAvailablePrincipals.js"></script>

    <script src="AJAX/createSchool.js"></script>
    <script src="AJAX/deleteSchool.js"></script>
    <script src="AJAX/editSchool.js"></script>

    <script src="../javascript/modaler.js"></script> <!-- used for making Modals and Rows -->
    <script src="../javascript/toaster.js"></script> <!-- used for making Toasts -->
</head>
<body>
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
                        <a class="nav-link" aria-current="page" href="../dashboard.php"><i class="bi bi-house-fill"></i><span class="ms-1 d-none d-sm-inline"> <?php echo $_SESSION['fname']; ?></span></a>
                    </li>
                    <li class="nav-item mb-3 px-0 align-middle">
                        <a class="nav-link" href="../Accounts/manage.php"><i class="bi bi-person-lines-fill"></i><span class="ms-1 d-none d-sm-inline"> Account Management</span></a>
                    </li>
                    <li class="nav-item mb-3 px-0 align-middle"> <!-- This nav link will not be removed from this page as only those with access can go here. -->
                        <a class="nav-link active" href="manage.php"><i class="bi bi-bank2"></i><span class="ms-1 d-none d-sm-inline"> School Management</span></a>
                    </li>
                    <?php
                        if (isset($_SESSION['uType']) && $_SESSION['uType'] != "Admin" && isset($_SESSION['sectionID'])) {
                            echo "
                                <li class=\"nav-item mb-3 px-0 align-middle\">
                                <a class=\"nav-link\" href=\"../Sections/manage.php\"><i class=\"bi bi-list-ul\"></i><span class=\"ms-1 d-none d-sm-inline\"> Section Management</span></a>
                                </li>
                            ";
                        }
                    ?>
                    <li class="nav-item mb-3 px-0 align-middle">
                        <a class="nav-link" href="../Lessons/manage.php"><i class="bi bi-journal-text"></i><span class="ms-1 d-none d-sm-inline"> Lesson Management</span></a>
                    </li>
                    <li class="nav-item mb-3 px-0 align-middle">
                        <a class="nav-link" href="../Assessments/manage.php"><i class="bi bi-ui-checks"></i><span class="ms-1 d-none d-sm-inline"> Assessment Management</span></a>
                    </li>
                    <li class="nav-item mb-3 px-0 align-middle">
                        <a class="nav-link" href="../Reports/manage.php"><i class="bi bi-bar-chart-line"></i><span class="ms-1 d-none d-sm-inline"> Report Generation</span></a>
                    </li>
                    <li class="nav-item px-0 align-middle">
                        <a class="nav-link" href="../functions/login/logout.php"><i class="bi bi-box-arrow-left"></i><span class="ms-1 d-none d-sm-inline"> Logout</span></a>
                    </li>
                </ul>
            </div>
        </div>

            <!--Main Container-->
            <div class="col">
                <h2 class="mt-5 mb-5">SCHOOLS</h2>
                <div class="row mt-4 mb-4">

                    <!--Search-->
                    <div class="col">
                        <div class="col input-group mb-3">
                            <input type="text" class="form-control" id="searchText" placeholder="Search" aria-label="Search" aria-describedby="search">
                            <button class="btn btn-outline-palette4 btn-palette2" type="button" id="search"><i class="bi bi-search" onClick="getSchools()"></i></button>
                        </div>
                    </div>

                    <!-- Adding Section-->
                    <div class="col-2">
                        <button type="button" class="btn btn-outline-primary" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
                            Add School
                        </button>
                    </div>

                    <!--Upload-->
                    <!-- <div class="col-2">
                        <button type="button" class="btn btn-outline-primary" data-bs-toggle="modal" data-bs-target="#upLoad">Upload</button>
                    </div> -->
                </div>

                <!--Tables-->
                <p id="msgError"></p>
                <table class="table table-hover mt-4">
                    <thead>
                        <tr>
                            <th scope="col">School ID</th>
                            <th scope="col">School Name</th>
                            <th scope="col">Municipality</th>
                            <th scope="col">Assigned Principal</th>
                            <th scope="col">Teachers</th>
                            <th scope="col">Sections</th>
                            <th scope="col">Actions</th>

                        </tr>
                    </thead>
                    <tbody data-bs-toggle="modal" data-bs-target="#editSchool" id="cont_schools" style="position:relative">
                        <!--Added section will appear here-->
                        <!--Sample Data-->
                        <tr>
                            <td>123456</td>
                            <td>Nijigasaki High</td>
                            <td></td>
                            <td>Setsuna Yuuki</td>
                            <!-- <td></td>
                            <td></td> -->
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

                    <!--MODALS//OVERLAY-->

<!--Overlay Form //School-->

<div id="cont_modals">
</div>

<div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Add School</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p id="regError"></p>
                <div class="form-floating">
                    <input name="regInID" type="text" class="form-control mb-3" id="regInID" placeholder="School ID">
                    <label for="regInID">School ID</label>
                </div>
                <div class="form-floating mb-3">
                    <input name="regInName" type="text" class="form-control mb-3" id="regInName" placeholder="School Name">
                    <label for="regInName">School Name</label>
                </div>
                <div class="form-floating mb-3">
                    <!-- <input name="regInPrincipal" type="text" class="form-control mb-3" id="regInPrincipal" placeholder="Assigned Principal"> -->
                    <select name="regInPrincipal" type="text" class="form-control mb-3" id="regInPrincipal" placeholder="Assigned Principal">

                    </select>
                    <label for="regInPrincipal">Assigned Principal</label>
                </div>
                <div class="form-floating mb-3">
                <select name="regInMunicipality" class="form-select" id="regInMunicipality" aria-label="Municipality">
                    <option value="null" selected disabled>Select Municipality</option>
                    <option value="Abucay">Abucay</option>
                    <option value="Bagac">Bagac</option>
                    <option value="Balanga">Balanga</option>
                    <option value="Dinalupihan">Dinalupihan</option>
                    <option value="Hermosa">Hermosa</option>
                    <option value="Limay">Limay</option>
                    <option value="Mariveles">Mariveles</option>
                    <option value="Morong">Morong</option>
                    <option value="Orani">Orani</option>
                    <option value="Orion">Orion</option>
                    <option value="Pilar">Pilar</option>
                    <option value="Samal">Samal</option>
                    </select>
                    <label for="regInMunicipality">Municipality</label>
                </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn" data-bs-dismiss="modal">CANCEL</button>
                <button type="button" class="btn btn-palette2" onClick="createSchool()">CREATE</button>
            </div>
        </div>
    </div>
</div>

    <!--edit School Modal-->
    <div class="modal fade" id="editSchool" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Edit School</h5>
            </div>
            <div class="modal-body">
                <div class="form-floating">
                    <input name="" type="text" class="form-control mb-3" id="floatingInput" placeholder="School ID">
                    <label for="floatingInput">School ID</label>
                </div>
                <div class="form-floating mb-3">
                    <input type="text" class="form-control mb-3" id="floatingInput" placeholder="School Name">
                    <label for="floatingSelect">School Name</label>
                </div>
                <div class="form-floating mb-3">
                    <input type="text" class="form-control mb-3" id="floatingInput" placeholder="Assigned Principal">
                    <label for="floatingSelect">Assigned Principal</label>
                </div>
                <div class="form-floating mb-3">
                    <select class="form-select" id="floatingSelect" aria-label="Municipality">
                        <option value="1">Abucay</option>
                        <option value="2">Bagac</option>
                        <option value="3">Dinalupihan</option>
                    </select>
                    <label for="floatingSelect">Municipality</label>
                </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn" data-bs-dismiss="modal">CANCEL</button>
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
            <button type="button" class="btn btn">CANCEL</button>
            <button type="button" class="btn btn-palette2">UPLOAD</button>
        </div>
        </div>
    </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous"></script>
    <script>
        // document.querySelector("#cont_schools").innerHTML = "";
        // document.querySelector("#cont_modals").innerHTML = "";
        getSchools();

        getAvailablePrincipalsCreation("regInPrincipal");
    </script>
</body>
</html>