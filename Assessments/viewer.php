<!DOCTYPE html>
<html lang="en">
<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
    <link rel="stylesheet" href="../css/custom.min.css">
    <link rel="stylesheet" href="../css/student.css">
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TENSAI - Take Assessment</title>

    <script src="AJAX/Students/quizer.js"></script>
    <script src="../Reports/AJAX/addReport.js"></script>
    <script src="../RINA/rinaJS.js"></script>

    <script src="../javascript/toaster.js"></script>
</head>

<body>
    <!-- Toast -->
    <div aria-live="polite" aria-atomic="true" class="d-flex align-items-center">
        <div class="toast-container position-absolute" id="cont_toasts" style="position:fixed; bottom:1vh; right: 1vh">
            
        </div>
    </div>

    <!-- Toast -->

    <!--Background-->
    <div class="tensai-body" style="background-image: url('../src/s1.jpg');">
        <a id="btn_logout" href="../functions/login/logout.php" style="display:none;"></a>

        <div class="color-overlay">
        <div class="tensai-head d-flex">
                <div class="mb-2 p-3 justify-content-start align-items-start d-flex flex-row">
                <h3 class="me-3">ASSESSMENT</h3>
                </div>

                <div class="mb-2 p-4 ms-auto">
                    <a href="#" class="form-control" id="btn_back" onClick="history.go(-1)"><i class="bi bi-arrow-return-left"></i> GO BACK</a>
                </div>
            </div>

            <div class="assessment-body d-flex justify-content-center">
                <div style="position:fixed; bottom:10px;left:10px;">
                    <p id="rina_speech"></p>
                    <button id='btnTalk' onclick="logger()" onclick="audioCall()">Give Command!</button>
                </div>
                <div class="assessment-container" id="assessment">
                    <!--SAMPLE-->
                    <div class="assessment">
                        <div class="assessment-header">
                            <h2 id="cont_question">QUESTION 1</h2>
                         </div>

                         <!--Multiple Choice Template-->
                        <div class="choices-container d-flex flex-row justify-content-center">
                            <div class="choice m-5">
                                <button class="btn btn-outline-palette3 p-5" id="mc-opt1" onClick="checkAnswer('#mc-opt1')">OPTION 1</button>
                            </div>
                            <div class="choice m-5">
                                <button class="btn btn-outline-palette3 p-5" id="mc-opt2" onClick="checkAnswer('#mc-opt2')">OPTION 2</button>
                            </div>
                            <div class="choice m-5">
                                <button class="btn btn-outline-palette3 p-5" id="mc-opt3" onClick="checkAnswer('#mc-opt3')">OPTION 3</button>
                            </div>
                            <div class="choice m-5">
                                <button class="btn btn-outline-palette3 p-5" id="mc-opt4" onClick="checkAnswer('#mc-opt4')">OPTION 4</button>
                            </div>
                        </div>

                        <!--Fill in the Blanks Template-->
                        <div class="fillblank-container d-flex justify-content-center">
                            <input type="text" class="fill-blank p-3" id="ident-ans" placeholder="Answer">
                        </div>
                        <div class="submit-btn d-flex position-relative">
                                <button type="button" class="btn btn-palette2 position-absolute end-0 p-3 me-5" id="ident-submit" onClick="checkAnswer('#ident-ans')">SUBMIT</button>
                            </div>
                    </div>
                </div>
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
                    <button type="button" class="btn btn-palette2" id="btn_rinaConfirm" data-bs-dismiss="modal">Yes</button> <!-- onClick is supposed to call a function that will record the student's score to the database -->
                </div>

            </div>

        </div>

    </div>

        <!-- Logout Confirmation -->
    <div class="modal fade" id="rina_modalConfirmLogout" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Confirm Action</h5>
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
    <!--  -->

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous"></script>

    <script>
        var rina_modalConfirm = new bootstrap.Modal("#rina_modalConfirm");

        var rina_confirm = document.querySelector("#rina_modalConfirm");
        rina_confirm.addEventListener("shown.bs.modal", function() {
            logger();
        });

        var rina_finish = document.querySelector("#finishModal");
        rina_finish.addEventListener("shown.bs.modal", function() {
            logger();
        });

        recognition.addEventListener("result", (e) => {
            const text = Array.from(e.results)
            .map((result) => result[0])
            .map((result) => result.transcript)
            .join("");

            if (e.results[0].isFinal) {
                // Multiple Choice
                if (text.toLowerCase().includes("my answer is")) {
                    var answer = text.split("my answer is ")[1];

                    try {
                        var modal = new bootstrap.Modal(document.querySelector("#rina_modalConfirm"));

                        document.querySelector("#cont_answerRina").innerText = answer;
                        switch (questionTypes[currentQuestion]) {
                            case "Identification":
                                var textIn = document.querySelector("#ident-ans");
                                textIn.value = answer;
                                modal.show();
                            break;
                            case "Multiple Choice":
                                var choices = document.querySelectorAll(".choice");
                                // console.log(choices);
                                modal.show();
                            break;
                        }
                        
                    } catch (e) {
                        speechBubble.innerText = "Option can't be found 1";
                    }
                }

                // Prompt
                if (text.toLowerCase().includes("confirm answer")) {
                    var modal = document.querySelector("#rina_modalConfirm");
                    // console.log(modal.childNodes[1].childNodes[1].childNodes[5].childNodes[1]);
                    try {
                        var choices = document.querySelectorAll(".choice");

                        var ansTxt = document.querySelector("#cont_answerRina").innerText;

                        switch (questionTypes[currentQuestion]) {
                            case "Identification":
                                modal.childNodes[1].childNodes[1].childNodes[5].childNodes[1].click();
                                document.querySelector("#ident-submit").click();
                            break;
                            case "Multiple Choice":
                                if (ansTxt.toLowerCase().includes("option number one") || ansTxt.toLowerCase().includes("option number 1")) {
                                    modal.childNodes[1].childNodes[1].childNodes[5].childNodes[1].click();
                                    choices[0].childNodes[1].click();
                                } else if (ansTxt.toLowerCase().includes("option number two") || ansTxt.toLowerCase().includes("option number 2")) {
                                    modal.childNodes[1].childNodes[1].childNodes[5].childNodes[1].click();
                                    choices[1].childNodes[1].click();
                                } else if (ansTxt.toLowerCase().includes("option number three") || ansTxt.toLowerCase().includes("option number 3")) {
                                    modal.childNodes[1].childNodes[1].childNodes[5].childNodes[1].click();
                                    choices[2].childNodes[1].click();
                                } else if (ansTxt.toLowerCase().includes("option number four") || ansTxt.toLowerCase().includes("option number 4")) {
                                    modal.childNodes[1].childNodes[1].childNodes[5].childNodes[1].click();
                                    choices[3].childNodes[1].click();
                                }
                            break;
                        }
                    } catch (e) {
                        speechBubble.innerText = "Option can't be found 2";
                    }
                }

                if (text.toLowerCase().includes("cancel answer")) {
                    var modal = document.querySelector("#rina_modalConfirm");
                    modal.childNodes[1].childNodes[1].childNodes[1].childNodes[3].click()

                }

                if (text.toLowerCase().includes("finish assessment")) {
                    var modal = document.querySelector("#finishModal");
                    // console.log(modal.childNodes[1].childNodes[1].childNodes[5].childNodes[1]);
                    modal.childNodes[1].childNodes[1].childNodes[5].childNodes[1].click();
                }

            }
            
        });
    </script>
    <script>
        loadQuestions();
        // displayQuestion();
        // document.querySelector("#finishModal").style.display = "block";
    </script>
</body>
</html>