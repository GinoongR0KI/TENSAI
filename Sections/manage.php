<?php

// Import PHP Scripts
require_once("../functions/dbConn.php");
require_once("../functions/security/redirector.php");
require_once("Classes/sectionSB.php");
require_once("../functions/school/schoolGetter.php");
//

// Variables
$redir = new redirector();

$sb = new sectionSB();
$schoolGetter = new schoolGetter($db);
//

// Redirecting
$redir->out("../login.php");
$redir->unAuth("Students", "../");
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
    <title>TENSAI - Sections</title>
    <script>
        const myModal = document.getElementById('myModal')
        const myInput = document.getElementById('myInput')

        myModal.addEventListener('shown.bs.modal', () => {
        myInput.focus()
})
    </script>

    <script src="AJAX/Principal/sections.js"></script>
    <script src="AJAX/Principal/getAvailableTeachers.js"></script>

    <script src="AJAX/Teacher/students.js"></script>

    <script src="AJAX/Teacher/lessons.js"></script>
    <script src="AJAX/Teacher/saveSelection.js"></script>

    <script src="AJAX/Principal/createSection.js"></script>
    <script src="AJAX/Principal/deleteSection.js"></script>
    <script src="AJAX/Principal/editSection.js"></script>

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
                            <a class="nav-link" aria-current="page" href="../dashboard.php"><i class="bi bi-house-fill"></i><span class="ms-1 d-none d-sm-inline"><?php echo $_SESSION['fname']; ?></span></a>
                        </li>
                        <li class="nav-item mb-3 px-0 align-middle">
                            <a class="nav-link" href="../Accounts/manage.php"><i class="bi bi-person-lines-fill"></i><span class="ms-1 d-none d-sm-inline">Account Management</span></a>
                        </li>
                        <?php
                            if (isset($_SESSION['uType']) && $_SESSION['uType'] == "Admin") {
                                echo "
                                    <li class=\"nav-item mb-3 px-0 align-middle\">
                                        <a class=\"nav-link\" href=\"../Schools/manage.php\"><i class=\"bi bi-bank2\"></i><span class=\"ms-1 d-none d-sm-inline\"> School Management</span></a>
                                    </li>
                                ";
                            }
                        ?>
                        <li class="nav-item mb-3 px-0 align-middle"> <!-- current page -->
                            <a class="nav-link active" href="manage.php"><i class="bi bi-list-ul"></i><span class="ms-1 d-none d-sm-inline">Section Management</span></a>
                        </li>
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
                <h2 class="mt-5 mb-5">SECTIONS</h2>

                <!--Nav Tables-->
                <nav>
                    <div class="nav nav-tabs mw-100 text-palette1" id="tab" role="tablist">
                        <?php
                            if (isset($_SESSION['uType'])) {
                                switch ($_SESSION['uType']) {
                                    case "Principal":
                                        $sb->navTabPrincipal();
                                    break;
                                    case "Teacher":
                                        $sb->navTabTeacher();
                                    break;
                                }
                            }
                        ?>
                    </div>
                </nav>
                <!--  -->

                <!--Tab Content-->
                <div class="tab-content mt-4" id="nav-Folder">
                    <?php
                        if (isset($_SESSION['uType'])) {
                            switch ($_SESSION['uType']) {
                                case "Principal":
                                    $sb->generateTabPrincipal();
                                break;
                                case "Teacher":
                                    $sb->generateTabTeacher();
                                break;
                            }
                        }
                    ?>

                    <!-- <div class="tab-pane fade" id="assessTab" role="tabpanel" aria-labelledby="section-tab" tabindex="0">
                        <div class="row mt-4 mb-4">
                            <!--Search
                            <div class="col">
                            <div class="col input-group mb-3">
                                <input type="text" class="form-control" placeholder="Search" aria-label="Search" aria-describedby="search">
                                <button class="btn btn-outline-palette4 btn-palette2" type="button" id="search"><i class="bi bi-search"></i></button>
                            </div>
                            </div>

                            <!--Sort
                            <div class="col-1">
                                <div class="dropdown">
                                    <button class="btn btn-palette3 dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                        Sort
                                    </button>
                                    <ul class="dropdown-menu p-2">
                                        <li>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" value="" id="flexCheckChecked" checked>
                                                <label class="form-check-label" for="flexCheckChecked">
                                                    School
                                                </label>
                                        </div>
                                        </li>
                                        <li>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" value="" id="flexCheckChecked" checked>
                                                <label class="form-check-label" for="flexCheckChecked">
                                                    Principal
                                                </label>
                                        </div>
                                        </li>
                                        <li>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" value="" id="flexCheckChecked" checked>
                                                <label class="form-check-label" for="flexCheckChecked">
                                                    Teacher
                                                </label>
                                        </div>
                                        </li>
                                        <li>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" value="" id="flexCheckChecked" checked>
                                                <label class="form-check-label" for="flexCheckChecked">
                                                    Student
                                                </label>
                                        </div>
                                        </li>
                                    </ul>
                                </div>
                            </div>

                            <!--Adding Section
                            <div class="col-2">
                                <button type="button" class="btn btn-outline-primary" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
                                    Add Assessment
                                </button>
                            </div>
                        </div>
                        <table class="table table-hover mt-4">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Assessment</th>
                                    <th scope="col"># of Items</th>
                                    <th scope="col">Selection</th>
                                </tr>
                            </thead>
                                <tbody id="cont_assessments">
                                    <!--Added assessment will appear here
                                    <!--Sample Data
                                    <tr>
                                        <td>1</td>
                                        <td>Assessment 1</td>
                                        <td>10</td>
                                        <td></td>
                                    </tr>
                                </tbody>
                            </table>
                    </div> -->
                </div>

        </div>

    </div>

    <!--MODALS//OVERLAY-->
    <div id="cont_modals"> <!-- This is where the created/generated modals will be made -->
        <div id="cont_modalsSection"> <!-- 1st Tab Modals -->
        </div>
        <div id="cont_modalsLesson"> <!-- 2nd Tab Modals -->
        </div>
        <div id="cont_modalsAssessment"> <!-- 3rd Tab Modals -->
        </div>
    </div>

    <!--Overlay Form //Section Adding-->
    <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        
        <div class="modal-dialog modal-dialog-centered">

            <div class="modal-content">

                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Add Section</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body">
                    <input class="form-control mb-3" id="regInSchoolID" type="text" placeholder="School" aria-label="School" value="<?php echo $_SESSION['schoolID']; ?>" disabled>

                    <div class="form-floating">
                        <input type="text" class="form-control mb-3" id="regInSectionName" placeholder="Section Name">
                        <label for="regInSectionName">Section Name</label>
                    </div>

                    <div class="form-floating mb-3">
                        <select class="form-select" id="regInTeacherID" aria-label="Teacher">
                            <option value="null" selected disabled>Select a Teacher</option>
                            <option value="1">Yuu Takasaki</option>
                            <option value="2">Chisato Nishikagi</option>
                            <option value="3">Kaoruko Mifune</option>
                        </select>
                        <label for="regInTeacherID">Teacher</label>
                    </div>

                </div>

                <div class="modal-footer">
                    <button type="button" class="btn" data-bs-dismiss="modal">CANCEL</button>
                    <button type="button" class="btn btn-palette2" onClick="createSection();">CREATE</button>
                </div>

            </div>

        </div>

    </div>
        <!--  -->
        
        <!-- Selected Students -->
    <div class="modal fade" id="modalSelStudents" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Selected Students</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body">
                    <table class="table table-hover mt-4">
                        <thead>
                            <th scope="col">#</th>
                            <th scope="col">Name</th>
                        </thead>
                        <tbody id="cont_selectedStudents">
                            <td>1</td>
                            <td>Name</td>
                        </tbody>
                    </table>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-palette2" data-bs-dismiss="modal">OK</button>
                </div>

            </div>
        </div>
    </div>
        <!--  -->

        <!-- Selected Lessons -->
    <div class="modal fade" id="modalSelLessons" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Selected Lessons</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body">
                    <table class="table table-hover mt-4">
                        <thead>
                            <th scope="col">#</th>
                            <th scope="col">Lesson Title</th>
                        </thead>
                        <tbody id="cont_selectedStudents">
                            <td>1</td>
                            <td>Name</td>
                        </tbody>
                    </table>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-palette2" data-bs-dismiss="modal">OK</button>
                </div>

            </div>
        </div>
    </div>
        <!--  -->

    <!--  -->

    <!--Edit Section Overlay-->
    <div class="modal fade" id="editSection" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        
        <div class="modal-dialog modal-dialog-centered">
            
            <div class="modal-content">

                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Edit Section</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body">
                    <input class="form-control mb-3" type="text" placeholder="School" aria-label="School" disabled>

                    <div class="form-floating">
                        <input type="text" class="form-control mb-3" id="floatingInput" placeholder="Section Name">
                        <label for="floatingInput">Section Name</label>
                    </div>

                    <div class="form-floating mb-3">
                        <select class="form-select" id="floatingSelect" aria-label="Teacher">
                        <option selected>Select a Teacher</option>
                        <option value="1">Yuu Takasaki</option>
                        <option value="2">Chisato Nishikagi</option>
                        <option value="3">Kaoruko Mifune</option>
                        </select>
                        <label for="floatingSelect">Teacher</label>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn" data-bs-dismiss="modal">CANCEL</button>
                    <button type="button" class="btn btn-palette2" onClick="">SAVE</button>
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
        uType = "<?php echo $_SESSION['uType']; ?>";

        schoolID = <?php echo $_SESSION['schoolID'] == null ? "null" : $_SESSION['schoolID']; ?>;

        if (uType == "Principal") {
            console.log("Principal");
            if (schoolID != null && schoolID != undefined) {
                document.querySelector("#cont_sections").innerHTML = "";
                getSections(<?php echo $_SESSION['schoolID']; ?>);

                getAvailableTeachersCreation(<?php echo isset($_SESSION['schoolID']) ? $_SESSION['schoolID'] : "null"; ?>, "regInTeacherID");
                
            } else {
                document.querySelector("#cont_sections").innerHTML = "No Sections Found";
            }
        } else { // The only other user type that can enter here is the Teacher
            console.log("Teacher");
            if (schoolID != null && schoolID != undefined) {
                
                // document.querySelector("#cont_students").innerHTML = "";
                getStudents();

                // document.querySelector("#cont_lessons").innerHTML = "";
                getLessons(<?php echo $_SESSION['id']; ?>);
            } else {
                generateToastPersist("schoolError", "Notification", "Error", "School ID Not Set: You cannot use this page.");
            }
        }
    </script>
    
</body>
</html>