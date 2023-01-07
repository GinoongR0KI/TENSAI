<!DOCTYPE html>
<html lang="en">
<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
    <link rel="stylesheet" href="../css/rina_style.css">
    <link rel="stylesheet" href="../css/student.min.css">
    <link rel="stylesheet" href="../css/student.css">

    <link rel="manifest" href="../manifest.json">

    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TENSAI | Assessment Name</title>

    <script src="AJAX/Students/quizer.js"></script>
    <script src="../Reports/AJAX/addReport.js"></script>
    <script src="../RINA/rinaJS.js"></script>

    <script src="../javascript/toaster.js"></script>

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

        <!-- Back Button -->
        <div class="row">
            <div class="col">
                <div class="back">
                    <a id="btn_back" href="dashboard.php">
                        <img src="../mat_icons/tensai_back_btn.png"></a>
                </div>
            </div>
        </div>

        <!-- Questions Container -->
        <div class="assessment-body d-flex justify-content-center">

            <div class="assessment-container" id="assessment">
                <!--SAMPLE-->
                <div class="assessment">
                    <div class="assessment-header d-flex flex-row justify-content-center">
                        <h2 id="cont_question">LOADING QUESTIONS...</h2>
                    </div>

                    <div class="assessment-answers">
                        <!--Multiple Choice Template-->
                        <div class="choices-container d-flex flex-row justify-content-center">
                            <div class="choice m-5">
                                <button class="btn btn-outline-secondary p-5" id="mc-opt1" onClick="checkAnswer('#mc-opt1')" style="display:none;">OPTION 1</button>
                            </div>
                            <div class="choice m-5">
                                <button class="btn btn-outline-secondary p-5" id="mc-opt2" onClick="checkAnswer('#mc-opt2')" style="display:none;">OPTION 2</button>
                            </div>
                            <div class="choice m-5">
                                <button class="btn btn-outline-secondary p-5" id="mc-opt3" onClick="checkAnswer('#mc-opt3')" style="display:none;">OPTION 3</button>
                            </div>
                            <div class="choice m-5">
                                <button class="btn btn-outline-secondary p-5" id="mc-opt4" onClick="checkAnswer('#mc-opt4')" style="display:none;">OPTION 4</button>
                            </div>
                        </div>

                        <!--Fill in the Blanks Template-->
                        <div class="fillblank-container d-flex justify-content-center">
                            <input type="text" class="fill-blank p-3" id="ident-ans" placeholder="Answer" style="display:none;">
                        </div>
                        <div class="submit-btn d-flex position-relative end-0 p-3 me-5">
                            <button type="button" class="btn btn-outline-secondary position-absolute end-0 p-3 me-5" id="ident-submit" onClick="checkAnswer('#ident-ans')" style="display:none;">SUBMIT</button>
                        </div>

                        <!-- True or false -->
                        <div class="tof-container d-flex flex-row justify-content-center">
                            <div class="choice m-5">
                                <button class="btn btn-outline-secondary p-5" id="tof-true" onClick="checkAnswer('#tof-true')" style="display:none;">TRUE</button>
                            </div>
                            <div class="choice m-5">
                                <button class="btn btn-outline-secondary p-5" id="tof-false" onClick="checkAnswer('#tof-false')" style="display:none;">FALSE</button>
                            </div>
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
                
                <button class="btn position-absolute bottom-0 end-0 p-4" id="rina_click" onClick="manualToggleBubble()"><img src="../mat_icons/rina_base.png"></img></button>
            </div>
            
        </div>
    </div>

    <!-- Modals -->
    <div class="modal fade" id="finishModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Assessment Done</h5>
                    <!-- <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button> -->
                </div>

                <div class="modal-body">

                    <h4>Your Score Is:</h4>
                    <h2 id="cont_score"></h2>

                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-palette2" id="btn_finish" onClick="addReport()">FINISH</button> <!-- onClick is supposed to call a function that will record the student's score to the database -->
                    <!-- <a href="assessment_result.php">Finish</a> -->
                </div>

            </div>

        </div>

    </div>

    <!-- This modal is for RINA confirmation for actions -->
        <!-- Answer Confirmation -->
    <div class="modal fade" id="rina_modalConfirm" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Confirm Action</h5>
                    <button type="button" class="btn-close" id="btn_rinaCancel" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body">
                    <h4>Are you sure you are going to answer: <i id="cont_answerRina"></i></h4>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-button" id="btn_rinaConfirm" data-bs-dismiss="modal">Yes</button> <!-- onClick is supposed to call a function that will record the student's score to the database -->
                </div>

            </div>

        </div>

    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-u1OknCvxWvY5kfmNBILK2hRnQC3Pr17a+RTT6rIHI7NnikvbZlHgTPOOmMi466C8" crossorigin="anonymous"></script>
    <script src="https://code.responsivevoice.org/responsivevoice.js?key=QFJLgY5F"></script>
    <script>
        loadQuestions();
        callRINA();

        history.pushState(null, document.title, location.href);
        window.addEventListener("popstate", function() {
            var leavePage = confirm("You will lose all your progress in this session. Want to leave this page?");
            if (leavePage) {
                history.back();
            } else {
                history.pushState(null, document.title, location.href);
            }
        });
    </script>
</body>
</html>