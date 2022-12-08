<!DOCTYPE html>
<html lang="en">
<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
    <link rel="stylesheet" href="../css/style.min.css">
    <link rel="stylesheet" href="../css/style.css">
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TENSAI Assessment Creator</title>

    <style>.dragging{opacity: 0.5;}</style>

    <script src="../javascript/questioner.js"></script>
    <script src="AJAX/Admin/saveAssessment.js"></script>
    <script src="AJAX/Admin/publishAssessment.js"></script>

    <script src="AJAX/Admin/draggableTabs.js"></script>

    <script src="../javascript/toaster.js"></script>

    <!-- <script src="AJAX/test.js"></script> -->
</head>
<body>
    <!-- Toast -->
    <div aria-live="polite" aria-atomic="true" class="d-flex align-items-center">
        <div class="toast-container position-absolute" id="cont_toasts" style="position:fixed; bottom:1vh; right: 1vh">
            
        </div>
    </div>

    <!-- Toast -->

    <!-- Top most container -->
    <div class="assessment-content d-flex flex-row bg-secondary p-2 position-relative">
        <div class="assessment-title d-flex flex-row">
            <h3 class="fs-3 ms-3 me-4" id="assessmentTitle">Assessment Creator</h3>
            <button type="button" class="btn btn-palette1" data-bs-toggle="modal" data-bs-target="#assessmentEditor"><i class="bi bi-pencil-square"></i></button> <!-- Used to toggle the lesson general info modal -->
        </div>

        <div class="button-container d-flex flex-row position-absolute end-0">
            <button type="button" class="btn btn-button me-2" data-bs-toggle="modal" data-bs-target="#confirmDraft"><i class="bi bi-paperclip"></i>Draft</button> <!-- Save the whole document -->
            <button type="button" class="btn btn-button me-2" data-bs-toggle="modal" data-bs-target="#confirmPublish"><i class="bi bi-box-arrow-up"></i>Publish</button> <!-- Save & Publish -->
        </div>
    </div>

    <!-- Main Panel -->
    <div class="container-fluid">
        <div class="row">
            <!--Slide Panel-->
            <div class="col-auto col-md-3 col-xl-2 px-sm-2 px-0 min-vw-20">
                <div class="d-flex flex-column align-items-center align-items-sm-start px-3 pt-2 m-3 rounded-2 position-fixed" style="background-color: #4C3575; height: 85vh">
                    <div class="back-btn"> <!-- Go back to lesson Page -->
                        <a href="manage.php">
                            <button type="button" class="btn btn-outline-palette3 p-1 mt-3"><i class="bi bi-box-arrow-in-left"></i>BACK</button>
                        </a>
                    </div>

                    <hr>

                    <nav class="navbar bg-palette3 justify-content-center "> <!-- Slides Container -->
                        <div class="container-fluid rounded-1 bg-secondary" style="height:60vh; overflow:auto">
                            <ul class="navbar-nav cont_draggables" role="tablist" style="width:100%;">
                                <li class="nav-item draggable" draggable="true">
                                    <button class="nav-link slideBtn active btn" id="page1-tab" data-bs-toggle="tab" data-bs-target="#page-1" type="button" role="tab" aria-controls="home" aria-selected="true" style="width:100%">
                                        <i class="bi bi-card-text test1"><script>document.querySelector(".test1").innerText = Date.now()</script></i>
                                    </button>
                                </li>
                                <li class="nav-item draggable" draggable="true">
                                    <button class="nav-link slideBtn btn" id="page2-tab" data-bs-toggle="tab" data-bs-target="#page-2" type="button" role="tab" aria-controls="home" aria-selected="true" style="width:100%">
                                        <i class="bi bi-card-text test2"><script>document.querySelector(".test2").innerText = Date.now()</script></i>
                                    </button>
                                </li>
                            </ul>

                        </div>

                    </nav>

                    <button type="button" class="btn btn-outline-palette3 position-absolute bottom-0 ms-1 mb-3 mt-4" onClick="addQuestion()"><i class="bi bi-plus-circle"></i> Add Question</button>
                </div>
                
            </div>

            <!-- Assessment Creator Workspace -->
            <div class="col">
                <div class="tab-content" id="cont_questions">
                    <div class="tab-pane fade show active" id="question-1" role="tabpanel" aria-labelledby="question1-tab">
                        <div class="row col mb-4 p-4">
                            <div class="assessment-head d-flex flex-row">
                                <!--Dropdown == Multiple Choice / Identification-->
                                Question Type:&nbsp;
                                <select id="assessMode" onchange="getSelectedValue()">
                                    <option value="null" selected disabled>Select Question Type</option>
                                    <option value="mlc">Multiple Choice</option>
                                    <option value="idf">Identification</option>
                                    <option value="tof">True / False</option>
                                </select>

                                <!-- Undo and Redo Buttons -->
                                <div class="undo-redo d-flex flex-row position-absolute end-0 me-3">
                                    <button type="button" class="btn" id="ctrlUndo"><i class="bi bi-arrow-counterclockwise"></i></button>
                                    <button type="button" class="btn" id="ctrlRedo"><i class="bi bi-arrow-clockwise"></i></button>
                                    <button type="button" class="btn" id="ctrlDelPage"><i class="bi bi-trash"></i></button>
                                </div>
                            </div>
                        </div>

                        <!--Question Container-->
                        <div class="row m-3">
                            <div class="col d-flex" id="workspace" contenteditable="true" style="border: 0.1rem #053742 solid; min-height: 40vh;"></div>
                        </div>

                        <!--Answer Container-->
                        <div class="row" id="answerContainer">
                            <!-- Multiple Choice -->
                            <div class="choice d-flex flex-row justify-content-center" id="multipleChoice">
                                <!-- <div class="d-flex flex-row justify-content-center"> -->
                                    <div class="btn btn-outline-palette3 m-2 p-4">
                                        <input type="radio" name="question1-option">
                                        <input type="text" placeholder="Option 1" style="border:none;">
                                    </div>

                                    <div class="btn btn-outline-palette3 m-2 p-4">
                                        <input type="radio" name="question1-option">
                                        <input type="text" placeholder="Option 2" style="border:none;">
                                    </div>

                                    <div class="btn btn-outline-palette3 m-2 p-4">
                                        <input type="radio" name="question1-option">
                                        <input type="text" placeholder="Option 3" style="border:none;">
                                    </div>

                                    <div class="btn btn-outline-palette3 m-2 p-4">
                                        <input type="radio" name="question1-option">
                                        <input type="text" placeholder="Option 4" style="border:none;">
                                    </div>

                                <!-- </div> -->
                            </div>

                            <!-- Identification -->
                            <div class="choice row d-flex flex-row justify-content-center" id="identification" style="margin-left:0">
                                <!-- <div class="d-flex flex-row justify-content-center"> -->
                                <input type="text" class="fill-blank p-3" placeholder="Correct Answer">
                                <!-- </div> -->
                            </div>

                            <!-- True or False -->
                            <div class="choice row d-flex flex-row justify-content-center" id="trueorfalse">
                                <div class="btn btn-outline-palette3 m-2 p-4">
                                    <input type="radio" name="question1-option">
                                    TRUE
                                </div>

                                <div class="btn btn-outline-palette3 m-2 p-4">
                                    <input type="radio" name="question1-option">
                                    FALSE
                                </div>
                            </div>

                        </div>
                    </div>
                </div>


            </div>

        </div>
    </div>

    <!-- Modals -->
    <!-- General Information Modal -->
    <div class="modal fade" id="assessmentEditor" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true"> <!-- This is the Lesson's General Information -->
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Assessment</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body">
                    <div class="form-floating">
                        <input type="text" class="form-control mb-3" id="assessmentInTitle" placeholder="Lesson Title">
                        <label for="assessmentInTitle">Assessment Title</label>
                    </div>

                    <div class="form-floating">
                        <input type="number" class="form-control mb-3" id="assessmentInItems" min="1" max="100" value="1" onInput="correctItems()" onChange="correctItemsChanges()">
                        <label for="assessmentInItems"># of Items</label>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn" data-bs-dismiss="modal">CANCEL</button>
                    <button type="button" class="btn btn-button" data-bs-dismiss="modal">OK</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Draft Saving Confirmation Modal -->
    <div class="modal fade" id="confirmDraft" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true"> <!-- Draft Button Modal -->
        <div class="modal-dialog modal-dialog-centered"> <!-- This modal is used for saving the document -->
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Draft</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body">
                    <p>Are you sure you want to save changes?</p>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-button" data-bs-dismiss="modal" onClick="saveAssessment()">YES</button>
                    <button type="button" class="btn" data-bs-dismiss="modal">NO</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Publishing Confirmation Modal -->
    <div class="modal fade" id="confirmPublish" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true"> <!-- This is the modal for saving and publishing the document -->
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Publish</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body">
                    <p>Are you sure you want to publish?</p>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-button" data-bs-dismiss="modal" onClick="publishAssessment()">YES</button>
                    <button type="button" class="btn" data-bs-dismiss="modal">NO</button>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous"></script>

    <script> // Remove this and transfer to a file

        //Dropdown Choice
        function getSelectedValue(){
            var select = document.getElementById("assessMode").value;
            var mlc = document.getElementById("multipleChoice");
            var idf = document.getElementById("identification");

            if(select === "mlc"){
                mlc.style.display = "block"
            }
            else{
                mlc.style.display = "none"
            }

            if(select === "idf"){
                idf.style.display = "block";
            }
            else{
                idf.style.display = "none";
            }
        }

        //
        function correctItems() {
            console.log("selected");
            var numInItems = document.querySelector("#assessmentInItems");

            if (parseInt(numInItems.value) > numInItems.max) {
                numInItems.value = numInItems.max;
            }

            if (parseInt(numInItems.value) < 1) {
                numInItems.value = 1;
            }
        }

        function correctItemsChanges() {
            var numInItems = document.querySelector("#assessmentInItems");

            if (numInItems.value == "") {
                numInItems.value = 1;
            }
        }
        //

    </script>

    <script>
        loadGenInfo();
        loadQuestions();
        // createQuestion();
    </script>

</body>
</html>