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
    <link rel="stylesheet" href="../css/style.css">
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TENSAI | Assessment Management</title>

    <script src="AJAX/Admin/assessments.js"></script>

    <script src="AJAX/Admin/getAvailableLessons.js"></script>

    <script src="AJAX/Admin/createAssessment.js"></script>
    <script src="AJAX/Admin/deleteAssessment.js"></script>

    <script src="../javascript/toaster.js"></script>
    <script src="../javascript/rower.js"></script>
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
                            <a class="nav-link active" href="manage.php">Assessment Management</a>
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
                        <h3>Assessment Management</h3>
                    </div>
                </div>

                <div class="row mb-4 mt-4 me-5">

                    <div class="account-table d-flex flex-row position-relative shadow-sm p-3 mb-3 bg-body rounded">
                        <!--Search-->
                        <div class="col-5">
                            <div class="input-group mb-3 d-flex">
                                <input type="text" class="form-control" id="searchAssessment" placeholder="Search . . ." aria-label="Search . . ." aria-describedby="searchBTN">
                                <button class="btn btn-button" type="button" id="searchBTN" onClick="getAssessments()">Search</button>
                            </div>
                        </div>

                        <div class="account-button position-absolute end-0 d-flex flex-row">
                            <!--Sort-->
                            <!-- <div class="col-auto me-4">
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
                                <!--Add Assessment-->
                                <?php
                                    if ($_SESSION['uType'] == "Teacher") {
                                        echo '<button type="button" class="btn btn-outline-button" data-bs-toggle="modal" data-bs-target="#addAssessment">Add Assessment</button>';
                                    }
                                ?>
                            </div>

                        </div>
                    </div>

                    <div class="table-container shadow-sm p-3 mb-5 bg-body rounded">
                        <table class="table table-hover table-responsive-sm">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Assessment</th>
                                    <th scope="col">Lesson Reference</th>
                                    <th scope="col"># of Items</th>
                                    <th scope="col"># of Questions</th>
                                    <th scope="col">Date Created</th>
                                    <th scope="col">Date Updated</th>
                                    <th scope="col">Status</th>
                                    <th scope="col gap-3">Actions</th>
                                </tr>
                            </thead>
                            <tbody id="cont_assessments">
                                <!--Sample Data-->
                                <tr>
                                    <td>Lesson Sample</td>
                                    <td>Insert description here...</td>
                                    <td></td>
                                    <td></td>
                                    <td>Rainbow</td>
                                    <td>
                                        <div class="hover-button">
                                            <button type="button" class="btn btn-sm btn-button" data-bs-toggle="modal"
                                                data-bs-target="#editSchool"><i
                                                    class="bi bi-pencil-square"></i></button>
                                            <button type="button" class="btn btn-sm btn-button" data-bs-toggle="modal"
                                                data-bs-target="#deleteAssessment"><i class="bi bi-trash3"></i></button>
                                        </div>
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
    <!--Add Lesson-->
    <div class="modal fade" id="addAssessment" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="addAssessmentLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addAssessmentLabel">Add Assessment</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="form-floating">
                        <input type="text" class="form-control mb-3" id="regInTitle" placeholder="Assessment Title">
                        <label for="regInTitle">Assessment Title</label>
                    </div>
                    <div class="form-floating">
                        <select class="form-control mb-3" id="regInLessonID" placeholder="Lesson">
                            <option value="null" selected disabled>Select a Lesson</option>
                        </select>
                        <label for="regInLessonID">Target Lesson</label>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn" data-bs-dismiss="modal">CANCEL</button>
                    <?php
                        if (isset($_SESSION['id'])) {
                            echo "<button type=\"button\" class=\"btn btn-button\" onClick=\"createAssessment()\">CREATE</button>";
                        } else {
                            echo "<button type=\"button\" class=\"btn btn-button\" onClick=\"createAssessment()\" disabled>ID REQUIRED</button>";
                        }
                    ?>
                </div>
            </div>
        </div>
    </div>

    <!--Delete Lesson-->
    <div class="modal fade" id="deleteAssessment" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="deleteAssessmentLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteAssessmentLabel">Delete Account</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <h5 class="fs-5">Are you sure you want to delete '<b id="delTxt"></b>'?</h5>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn" data-bs-dismiss="modal">CANCEL</button>
                    <button type="button" class="btn btn-button" id="delBtn" data-bs-dismiss="modal">DELETE</button>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-u1OknCvxWvY5kfmNBILK2hRnQC3Pr17a+RTT6rIHI7NnikvbZlHgTPOOmMi466C8" crossorigin="anonymous"></script>
    <input type="hidden" id="hidVal_uType" value="<?php echo $_SESSION['uType']; ?>" />
    <script>
        var uType = document.querySelector("#hidVal_uType").value;

        if (uType == "Teacher") {
            getAvailableLessons();
        }
        getAssessments();
    </script>
</body>

</html>