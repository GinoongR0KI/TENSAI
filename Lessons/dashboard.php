<!DOCTYPE html>
<html lang="en">
<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">
    <link rel="stylesheet" href="../css/rina_style.css">
    <link rel="stylesheet" href="../css/student.min.css">
    <link rel="stylesheet" href="../css/student.css">

    <link rel="manifest" href="../manifest.json">
    
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TENSAI | Lessons</title>

    <script src="AJAX/Students/lessons.js"></script>

    <script src="../javascript/toaster.js"></script>
    <script src="../RINA/rinaJS.js"></script>

    <script src="https://kit.fontawesome.com/bbd1bd16d5.js" crossorigin="anonymous"></script>
</head>
<body>
    <!-- Toast -->
    <div aria-live="polite" aria-atomic="true" class="d-flex align-items-center">
        <div class="toast-container position-absolute" id="cont_toasts" style="position:fixed; bottom:1vh; right: 1vh">
            
        </div>
    </div>

    <!-- Toast -->

    <div class="container-fluid">

        <div class="back">
            <a id="btn_back" href="../student.php">
            <img src="../mat_icons/tensai_back_btn.png"></a>
        </div>

        <div class="row">
            <div class="col"> <!-- Lesson List -->
                <div class="lesson-list" id="cont_lessons">
                    <div class="lesson-card d-flex flex-row m-3">
                        <div class="lesson-thumbnail">
                            <img src="../mat_icons/lesson.png">
                        </div>
                        <div class="lesson-title">
                            <h4>-----</h4>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col"> <!-- Lesson Details -->
                <div class="d-flex justify-content-center">
                <div class="show-lesson position-absolute end-0">
                    <div class="lesson-thumbs">
                        <div class="lesson-img">
                            <img src="../mat_icons/lesson.png">
                        </div>
                        <div class="thumbs-title">
                            <h4 id="lesson_title">Select Lesson</h4>
                        </div>
                        <div class="thumbs-description" id="lesson_desc">
                            <p>Please select a lesson on the left side first.</p>
                        </div>
                        <div class="thumbs-footer">
                            <a href="student_lesson_viewer.php" id="lesson_url">
                                <button disabled>VIEW LESSON</button>
                            </a>
                        </div>
                    </div>
                </div>
                </div>
            </div>

            <!-- RINA -->
            <div class="d-flex justify-content-end">
                <div class="rina-container position-absolute bottom-0 end-0 p-4">
                    <!-- Wrapper for Rina UI -->
                    <div id="rina_bubble" class="rina_wrapper" style="display:none; right:16px; bottom:25vh">
                        <div class="head-text">
                            Talk with RINA!
                        </div>
                        <div class="chat-box">
                            <form action="#">
                                <div class="field">
                                    <p id="rina_reply"></p>
                                </div>
                            </form>
                        </div>
                        
                        <div class="chat-box">
                            <b>User Captions:</b> <p id="rina_speech">...</p>
                        </div>
                        <br>
                    </div>
                    
                    <button class="btn position-absolute bottom-0 end-0 p-4" id="rina_click" data-bs-toggle="modal" data-bs-target="#rina_modalCommands"><img src="../mat_icons/rina_base.png"></img></button>
                </div>
                
            </div>
        </div>
    </div>

    <!-- Modals -->
    <div class="modal fade" id="rina_modalConfirmLogout" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Logout</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Are you sure to logout?
                </div>
                <div class="modal-footer">
                    <a href="../functions/login/logout.php" id="btn_logout"><button type="button" class="btn btn-palette2" data-bs-dismiss="modal">LOGOUT</button></a>
                </div>
            </div>
        </div>
    </div>

    <!-- RINA COMMANDS MODAL -->
    <div class="modal fade" id="rina_modalCommands" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">RINA COMMANDS</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <table>
                        <thead>
                            <tr>
                                <th>Command</th>
                                <th>Description</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>Hello RINA</td>
                                <td>Toggle RINA on to listen to your commands.</td>
                            </tr>
                            <tr>
                                <td>Thanks RINA / Bye RINA</td>
                                <td>Toggle RINA off.</td>
                            </tr>

                            <tr>
                                <td>RINA log me out</td>
                                <td>Ask RINA to log you out of your account.</td>
                            </tr>
                            <tr>
                                <td>confirm logout</td>
                                <td>Allow RINA to log you out of your account.</td>
                            </tr>
                            <tr>
                                <td>cancel logout</td>
                                <td>Cancel your log out request from RINA.</td>
                            </tr>

                            <tr>
                                <td>click lessons</td>
                                <td>[Only works on the main dashboard] Clicks the Lessons dashboard button.</td>
                            </tr>
                            <tr>
                                <td>click assessments</td>
                                <td>[Only works on the main dashboard] Clicks the Assessments dashboard button.</td>
                            </tr>

                            <tr>
                                <td>go back</td>
                                <td>Goes back to previous page.</td>
                            </tr>

                            <tr>
                                <td>view [lesson name]</td>
                                <td>Select specified lesson in the Lessons dashboard.</td>
                            </tr>
                            <tr>
                                <td>go to lesson</td>
                                <td>Views selected lesson</td>
                            </tr>

                            <tr>
                                <td>turn page next</td>
                                <td>Turns page to the next page while viewing a lesson.</td>
                            </tr>
                            <tr>
                                <td>turn page back</td>
                                <td>Turns page to the previous page while viewing a lesson.</td>
                            </tr>
                            <tr>
                                <td>view lesson details</td>
                                <td>Opens up the lesson description while viewing a lesson.</td>
                            </tr>
                            <tr>
                                <td>close lesson details</td>
                                <td>Closes the lesson description window while viewing a lesson.</td>
                            </tr>

                            <tr>
                                <td>take [assessment name]</td>
                                <td>Selects the specified assessment title and allows you to take that assessment</td>
                            </tr>

                            <tr>
                                <td>my answer is [answer]</td>
                                <td>This allows you to input an answer. [Multiple Choices will only take "letter a-d", and True or False will only take "true/false"]</td>
                            </tr>
                            <tr>
                                <td>confirm answer</td>
                                <td>Allow RINA to enter the answer you have given.</td>
                            </tr>
                            <tr>
                                <td>cancel answer</td>
                                <td>Cancel the answer you have given to RINA.</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-palette2" data-bs-dismiss="modal">CANCEL</button>
                    <button type="button" class="btn btn-secondary" id="rina_openBtn" data-bs-dismiss="modal" onClick="manualToggleBubble()">OPEN RINA</button>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-u1OknCvxWvY5kfmNBILK2hRnQC3Pr17a+RTT6rIHI7NnikvbZlHgTPOOmMi466C8" crossorigin="anonymous"></script>
    <script src="https://code.responsivevoice.org/responsivevoice.js?key=QFJLgY5F"></script>
    <script>loadLessons();callRINA()</script>
</body>
</html>