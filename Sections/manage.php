<?php

// Import PHP Scripts
require_once("../functions/dbConn.php");
require_once("../functions/security/redirector.php");
require_once("Classes/sectionSB.php");
require_once("Classes/schoolGetter.php");
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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
    <link rel="stylesheet" href="../css/style.min.css">
    <link rel="stylesheet" href="../css/style.css">
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TENSAI | Section Management</title>

    <!-- Sections Tab -->
    <script src="AJAX/Principal/sections.js"></script>
    
    <script src="AJAX/Principal/getAvailableTeachers.js"></script>

    <script src="AJAX/Principal/createSection.js"></script>
    <script src="AJAX/Principal/editSection.js"></script>
    <script src="AJAX/Principal/deleteSection.js"></script>
    <!--  -->

    <!-- Students Tab -->
    <script src="AJAX/Teacher/students.js"></script>
    <script src="AJAX/Teacher/saveSelection.js"></script>
    <!--  -->

    <!-- Lessons Tab -->
    <script src="AJAX/Teacher/lessons.js"></script>
    <!--  -->

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
                                    <a class="nav-link" href="../Schools/manage.php">School Management</a>
                                </li>
                                ';
                            }
                            if ($_SESSION['uType'] != "Admin") {
                                echo '
                                <li class="nav-item m-2">
                                    <a class="nav-link active" href="../Sections/manage.php">Section Management</a>
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
                        <h3>Section Management</h3>
                    </div>
                </div>

                <div class="row mb-4 mt-4 me-5">
                    <div class="table-container shadow-sm p-3 mb-5 bg-body rounded">
                        <!-- Navigation Bars / Tabs -->
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
                                    
                        <!-- Tab Contents -->
                        <div class="tab-content" id="sectionTabContent">
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
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!--Modal-->
    <!--Add Section-->
    <div class="modal fade" id="addSection" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="addAccountLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addAccountLabel">Add Account</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="form-floating">
                        <input class="form-control mb-3" id="regInSchoolID" type="text" placeholder="School" aria-label="School" disabled="">
                        <label for="regInSchoolID">School ID</label>
                    </div>

                    <div class="form-floating">
                        <input type="text" class="form-control mb-3" id="regInSectionName" placeholder="Section Name">
                        <label for="regInSectionName">Section Name</label>
                    </div>

                    <div class="form-floating mb-3">
                        <select class="form-select" id="regInTeacherID" aria-label="Teacher">
                        </select>
                        <label for="regInTeacherID">Teacher</label>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn" data-bs-dismiss="modal">CANCEL</button>
                    <button type="button" class="btn btn-button" id="confirmBox" onClick="createSection();">CREATE</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Edit Modal -->
    <div id="editSectionModal" class="modal fade" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-modal="true" role="dialog">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content"><div class="modal-header">
                <h5 id="staticBackdropLabel" class="modal-title">Edit Section</h5>
                <button class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <input type="hidden" id="inEditSectionID">
                <div class="form-floating">
                    <input type="text" name="inEditSchoolID" id="inEditSchoolID" class="form-control mb-3" placeholder="000000" readonly="">
                    <label for="inEditSchoolID">School ID</label>
                </div>
                <div class="form-floating">
                    <input type="text" name="inEditSectionName" id="inEditSectionName" class="form-control mb-3" placeholder="Section Name">
                    <label for="inEditSectionName">Section Name</label>
                </div>
                <div class="form-floating">
                    <select name="inEditAdvisorID" id="inEditAdvisorID" class="form-select mb-3" aria-label="Municipality">
                    </select>
                    <label for="inEditAdvisorID">Advisor</label>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn" data-bs-dismiss="modal">CANCEL</button>
                <button id="editBtn" class="btn btn-button" data-bs-dismiss="modal">SAVE</button>
            </div>
            </div>
        </div>
    </div>

    <!-- Delete Modal -->
    <div class="modal fade" id="deleteSectionModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="deleteSchoolLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteSchoolLabel">Delete Account</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <h5 class="fs-5">Are you sure you want to delete '<b id="delSectionTxt">Sample Section</b>' section?</h5>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn" data-bs-dismiss="modal">CANCEL</button>
                    <button type="button" class="btn btn-button" id="delBtn" data-bs-dismiss="modal" onclick="deleteSection('269420', '14')">DELETE</button>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-u1OknCvxWvY5kfmNBILK2hRnQC3Pr17a+RTT6rIHI7NnikvbZlHgTPOOmMi466C8" crossorigin="anonymous"></script>
    <script>
        uType = "<?php echo $_SESSION['uType']; ?>";

        schoolID = <?php echo $_SESSION['schoolID'] == null ? "null" : $_SESSION['schoolID']; ?>;

        if (uType == "Principal") {
            console.log("Principal");
            if (schoolID != "null") {
                document.querySelector("#cont_sections").innerHTML = "";
                getSections(<?php echo $_SESSION['schoolID']; ?>);

                getAvailableTeachersCreation(<?php echo isset($_SESSION['schoolID']) ? $_SESSION['schoolID'] : "null"; ?>, "regInTeacherID");
                
            } else {
                document.querySelector("#cont_sections").innerHTML = "No Sections Found";
            }
        } else { // The only other user type that can enter here is the Teacher
            console.log("Teacher");
            if (schoolID != null && schoolID != undefined) {
                getStudents();
                getLessons(<?php echo $_SESSION['id']; ?>);
            } else {
                generateToastPersist("schoolError", "Notification", "Error", "School ID Not Set: You cannot use this page.");
            }
        }
    </script>
</body>
</html>