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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
    <link rel="stylesheet" href="../css/style.min.css">
    <link rel="stylesheet" href="../css/style.css">

    <link rel="manifest" href="../manifest.json">
    
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TENSAI | School Management</title>
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
    <script src="../javascript/rower.js"></script>
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
                <div class="d-flex flex-column align-items-center align-items-sm-start px-3 pt-2 m-3 rounded-2 min-vh-95" style="background-color: #4C3575;">
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
                                    <a class="nav-link active" href="../Schools/manage.php">School Management</a>
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
                        <h3>School Management</h3>
                    </div>
                </div>

                <div class="row mb-4 mt-4 me-5">
                    <div class="account-table d-flex flex-row position-relative shadow-sm p-3 mb-3 bg-body rounded">
                        <!--Search-->
                        <div class="col-5">
                            <div class="input-group mb-3 d-flex">
                                <input type="text" class="form-control" id="searchText" placeholder="Search . . ." aria-label="Search . . ." aria-describedby="searchBTN">
                                    <button class="btn btn-button" type="button" id="searchBTN" onClick="getSchools()">Search</button>
                            </div>
                        </div>
                        <div class="account-button position-absolute end-0 d-flex flex-row">
                            <div class="col pe-3">
                                <!--Add Account-->
                                <button type ="button" class="btn btn-outline-button" data-bs-toggle="modal" data-bs-target="#addSchool">Add School</button>
                            </div>
                        </div>
                    </div>
                    <div class="table-container shadow-sm p-3 mb-5 bg-body rounded">
                        <table class="table table-hover table-responsive-sm">
                            <thead>
                                <tr>
                                    <th scope="col">School ID</th>
                                    <th scope="col">School Name</th>
                                    <th scope="col">Municipality</th>
                                    <th scope="col">Assigned Principal</th>
                                    <th scope="col"># of Science Teachers</th>
                                    <th scope="col"># of Sections</th>
                                    <th scope="col gap-3">Actions</th>
                                </tr>
                            </thead>
                            <tbody id="cont_schools">
                                <!--Sample Data-->
                                <tr>
                                    <td>-----</td>
                                    <td>-----</td>
                                    <td>-----</td>
                                    <td>-----</td>
                                    <td>-----</td>
                                    <td>-----</td>
                                    <td>-----</td>
                                </tr>
                                
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

               <!--Modals-->
<!--Add Acount-->
    <div class="modal fade" id="addSchool" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="addSchoolLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addSchoolLabel">Add School</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
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
                            <!-- <option selected disabled>Select Principal</option> -->
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
                    <button type="button" class="btn btn-button" id="confirmBox" data-bs-dismiss="modal" onClick="createSchool()">CREATE</button>
                </div>
            </div>
        </div>
    </div>

<!--Edit Account-->
    <div class="modal fade" id="editSchool" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="editSchoolLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editSchoolLabel">Edit School</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <input name="inOrigID" type="hidden" id="inOrigID">
                    <div class="form-floating">
                        <input name="inEditSchoolID" type="text" class="form-control mb-3" id="inEditSchoolID" placeholder="School ID">
                        <label for="inEditSchoolID">School ID</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input name="inEditSchoolName" type="text" class="form-control mb-3" id="inEditSchoolName" placeholder="School Name">
                        <label for="inEditSchoolName">School Name</label>
                    </div>
                    <div class="form-floating mb-3">
                        <!-- <input name="regInPrincipal" type="text" class="form-control mb-3" id="regInPrincipal" placeholder="Assigned Principal"> -->
                        <select name="inEditPrincipal" type="text" class="form-control mb-3" id="inEditPrincipal" placeholder="Assigned Principal">

                        </select>
                        <label for="inEditPrincipal">Assigned Principal</label>
                    </div>
                    <div class="form-floating mb-3">
                    <select name="inEditMunicipality" class="form-select" id="inEditMunicipality" aria-label="Municipality">
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
                        <label for="inEditMunicipality">Municipality</label>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn" data-bs-dismiss="modal">CANCEL</button>
                    <button type="button" class="btn btn-button" id="confirmBox" data-bs-dismiss="modal" onClick="editSchool()">SAVE</button>
                </div>
            </div>
        </div>
    </div>

    <!--Delete Account-->
    <div class="modal fade" id="deleteSchool" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="deleteSchoolLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteSchoolLabel">Delete Account</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <h5 class="fs-5">Are you sure you want to delete school?</h5>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn" data-bs-dismiss="modal">CANCEL</button>
                    <button type="button" class="btn btn-button" id="delBtn" data-bs-dismiss="modal" onClick="deleteSchool()">DELETE</button>
                </div>
            </div>
        </div>
    </div>

    <script>
        getSchools();

        getAvailablePrincipalsCreation("regInPrincipal");
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-u1OknCvxWvY5kfmNBILK2hRnQC3Pr17a+RTT6rIHI7NnikvbZlHgTPOOmMi466C8" crossorigin="anonymous"></script>

    
</body>
</html>