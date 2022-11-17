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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">    <meta charset="UTF-8">
    <link rel="stylesheet" href="../css/custom.min.css">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TENSAI - Lesson</title>

    <script src="AJAX/lessons.js"></script>

    <script src="AJAX/createLesson.js"></script>
    <script src="AJAX/deleteLesson.js"></script>

    <script src="../javascript/modaler.js"></script>
    <script src="../javascript/toaster.js"></script>
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
            <div class="col-auto col-md-3 col-xl-2 px-sm-2 px-0 bg-palette1"> <!-- Nav Bar -->
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

                        <li class="nav-item mb-3 px-0 align-middle"> <!-- Current Page -->
                            <a class="nav-link active" href="manage.php"><i class="bi bi-journal-text"></i><span class="ms-1 d-none d-sm-inline">Lesson Management</span></a>
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

            <div class="col"> <!-- Right Main Content -->
                <h2 class="mt-5 mb-5">LESSONS</h2>
                <div class="row mt-4 mb-4"> <!-- Header -->

                    <!--Search-->
                    <div class="col">
                        <div class="col input-group mb-3">
                            <input type="text" class="form-control" id="searchText" placeholder="Search" aria-label="Search" aria-describedby="search">
                            <button class="btn btn-outline-palette4 btn-palette2" type="button" id="searchBtn" onClick="getLessons()"><i class="bi bi-search"></i></button>
                        </div>
                    </div>

                    <!--Add Lesson-->
                        <!-- Only teachers will be able to see this button -->
                    <?php // Adds a button to add lessons if the user type/role is as a Teacher.
                        if ($_SESSION['uType'] == "Teacher") {
                            echo "
                            <div class=\"col-2\">
                                <button type=\"button\" class=\"btn btn-outline-primary\" data-bs-toggle=\"modal\" data-bs-target=\"#addLesson\">
                                    Add Lesson
                                </button>
    
                            </div>
                            ";
                        }
                    ?>
                    <!--  -->

                </div>

                <!--Tables-->
                <input type="hidden" id="hiddenUserID" value="<?php echo $_SESSION['id']; ?>"> <!-- Used for some script -->
                <input type="hidden" id="hiddenUserType" value="<?php echo $_SESSION['uType']; ?>"> <!-- Used for some script -->
                <table class="table table-hover mt-4"> <!-- Results -->
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Lesson Title</th>
                            <th scope="col">Description</th>
                            <th scope="col">Date Created</th>
                            <th scope="col">Date Updated</th>
                            <th scope="col">Status</th>
                            <th scope="col">Actions</th>

                        </tr>
                    </thead>
                    <tbody id="cont_lessons">
                        <!--Added section will appear here-->
                        <!--Sample Data-->
                        <tr>
                            <td>1</td>
                            <td>Sample Lesson</td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td>Draft</td>
                            <td><button class="btn btn-palette3"><i class="bi bi-eye"></i></button></td>

                        </tr>

                        <tr>
                            <td>1</td>
                            <td>Sample Lesson</td>
                            <td style="max-width: 128px; max-height: 10px; overflow-x: auto;">
                                Lorem ipsum dolor sit amet, consectetuer adipiscing elit.

                                Aenean commodo ligula eget dolor. Aenean massa.

                                Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec quam felis, ultricies nec, pellentesque eu, pretium quis,

                            </td>
                            <td></td>
                            <td></td>
                            <td>Draft</td>
                            <td>
                                <button class="btn btn-palette3"><i class="bi bi-trash"></i></button>
                                <button class="btn btn-palette3"><i class="bi bi-pencil"></i></button>
                                <button class="btn btn-palette3"><i class="bi bi-eye"></i></button>
                                <button class="btn btn-palette3"><i class="bi bi-send"></i></button>
                            </td>

                        </tr>
                        <tr>
                            <td>1</td>
                            <td>Sample Lesson</td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td>Draft</td>
                            <td>
                                <button class="btn btn-palette3"><i class="bi bi-trash"></i></button>
                                <button class="btn btn-palette3"><i class="bi bi-pencil"></i></button>
                                <button class="btn btn-palette3"><i class="bi bi-eye"></i></button>
                            </td>

                        </tr>
                    </tbody>
                </table>


            </div>
        </div>

    </div>


<!-- Modals -->

<div id="cont_modals"></div>

<!-- Modal for Lesson Creations -->
<div class="modal fade" id="addLesson" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Add Lesson</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <div class="modal-body">

                <div class="form-floating mb-3">
                    <input name="regInTitle" type="text" class="form-control mb-3" id="regInTitle" placeholder="School Name">
                    <label for="regInTitle">Lesson Title</label>
                </div>

                <div class="form-floating mb-3">
                    <textarea name="regInDesc" type="text" class="form-control mb-3" id="regInDesc" placeholder="School Name" maxlength="255"></textarea>
                    <label for="regInDesc">Lesson Description</label>
                </div>

                <input type="hidden" id="regInProfID" value="<?php echo $_SESSION['id'] ?>">

            </div>

            <div class="modal-footer">
                <button type="button" class="btn" data-bs-dismiss="modal">CANCEL</button>
                <?php
                    if (isset($_SESSION['id'])) {
                        echo "<button type=\"button\" class=\"btn btn-palette2\" onClick=\"createLesson()\">CREATE</button>";
                    } else {
                        echo "<button type=\"button\" class=\"btn btn-palette2\" onClick=\"createLesson()\" disabled>ID REQUIRED</button>";
                    }
                ?>
            </div>

        </div>

    </div>

</div>
    
    <script>
        document.querySelector("#cont_lessons").innerHTML = "";
        document.querySelector("#cont_modals").innerHTML = "";
        getLessons();
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous"></script>
</body>
</html>