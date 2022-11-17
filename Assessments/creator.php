<!DOCTYPE html>
<html lang="en">
<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css"> 
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../css/custom.min.css">
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TENSAI Assessment Creator</title>

    <style>.dragging{opacity: 0.5;}</style>

    <script src="../javascript/questioner.js"></script>
    <script src="AJAX/saveAssessment.js"></script>
    <script src="AJAX/publishAssessment.js"></script>

    <script src="AJAX/draggableTabs.js"></script>

    <script src="../javascript/toaster.js"></script>

    <script src="AJAX/test.js"></script>
</head>
<body>

    <!-- Toast -->
    <div aria-live="polite" aria-atomic="true" class="d-flex align-items-center">
        <div class="toast-container position-absolute" id="cont_toasts" style="position:fixed; bottom:1vh; right: 1vh">
            
        </div>
    </div>

    <!-- Toast -->

    <!--Lesson Nav Editor-->
    <div class="assessment-content d-flex flex-row bg-palette3 p-2 position-relative"> <!-- Top most container -->
        <div class="assessment-title d-flex flex-row">
            <h3 class="fs-3 ms-3 me-4" id="assessmentTitle">Assessment Creator</h3>
            <button type="button" class="btn btn-palette2" data-bs-toggle="modal" data-bs-target="#assessmentEditor"><i class="bi bi-pencil-square"></i></button> <!-- Used to toggle the lesson general info modal -->
        </div>

        <div class="button-container d-flex flex-row position-absolute end-0">
            <button type="button" class="btn btn-palette2 me-2" data-bs-toggle="modal" data-bs-target="#confirmDraft"><i class="bi bi-paperclip"></i>Draft</button> <!-- Save the whole document -->
            <button type="button" class="btn btn-palette2 me-2" data-bs-toggle="modal" data-bs-target="#confirmPublish"><i class="bi bi-box-arrow-up"></i>Publish</button> <!-- Save & Publish -->
        </div>
    </div>

    <div class="container-fluid">
        <div class="row d-flex">

            <!--Questions Panel-->
            <div class="col-2 d-flex flex-column justify-content-start align-content-start bg-palette1 vh-100">
                <div class="back-btn">
                    <a href="manage.php">
                        <button type="button" class="btn btn-outline-palette3 p-1 mt-3"><i class="bi bi-box-arrow-in-left"></i>BACK</button>
                    </a>
                </div>

                <hr />

                <nav class="navbar bg-palette3 justify-content-center "> <!-- Slides Container -->
                    <div class="container-fluid">
                        <ul class="navbar-nav cont_draggables" role="tablist" style="width:100%">
                            <li class="nav-item draggable" draggable="true">
                                <button class="nav-link slideBtn active" id="question1-tab" data-bs-toggle="tab" data-bs-target="#question-1" type="button" role="tab" aria-controls="home" aria-selected="true" style="width:100%">
                                    <i class="bi bi-card-text test1"><script>document.querySelector(".test1").innerText = Date.now()</script></i>
                                </button>
                            </li>

                            <li class="nav-item draggable" draggable="true">
                                <button class="nav-link slideBtn" id="question2-tab" data-bs-toggle="tab" data-bs-target="#question-2" type="button" role="tab" aria-controls="home" aria-selected="true" style="width:100%">
                                    <i class="bi bi-card-text test2"><script>document.querySelector(".test2").innerText = Date.now()</script></i>
                                </button>
                            </li>
                        </ul>

                    </div>

                </nav>

                <button type="button" class="btn btn-outline-palette3 mt-4"  onclick="addQuestion()"><i class="bi bi-plus-circle"></i> Add Question</button>
                <div class="item-container" id="itemContainer">
                    <!--Add items here onclick-->
                </div>
            
            </div>

            <!--Assessment Creator Workspace-->
            <div class="col">

                <div class="tab-content" id="cont_questions">
                    <div class="tab-pane fade show active" id="question-1" role="tabpanel" aria-labelledby="question1-tab">
                        <div class="row col mb-4 p-4">
                            <!-- <div class="col"> -->
                            <div class="assessment-head d-flex flex-row">
                                <!--Dropdown == Multiple Choice / Identification-->
                                <!-- <div class="assessment-dropdown"> -->
                                    <!-- <div class="dropdown"> -->
                                Question Type:&nbsp;
                                <select id="assessMode" onchange="getSelectedValue()">
                                    <option value="null" selected disabled>Select Question Type</option>
                                    <option value="mlc">Multiple Choice</option>
                                    <option value="idf">Identification</option>
                                </select>
                                    <!-- </div> -->
                                <!-- </div> -->

                                <div class="undo-redo d-flex flex-row position-absolute end-0 me-3"> <!-- Undo and Redo Buttons -->
                                    <button type="button" class="btn" id="ctrlUndo"><i class="bi bi-arrow-counterclockwise"></i></button>
                                    <button type="button" class="btn" id="ctrlRedo"><i class="bi bi-arrow-clockwise"></i></button>
                                    <button type="button" class="btn" id="ctrlDelPage"><i class="bi bi-trash"></i></button>
                                </div>

                                    
                                    <!--Insert img/Embed link-->
                                    <!--
                                        <div class="assessment-insert d-flex flex-row">
                                            <div class="img-btn p-3">
                                                <i class="bi bi-card-image"></i>
                                            </div>
                                            <div class="link-btn p-3">
                                                <i class="bi bi-film"></i>
                                            </div>
                                        </div>
                                        <div class="assessment-btn d-flex flex-row">
                                            <div class="redo-btn p-3">
                                                <i class="bi bi-arrow-counterclockwise"></i>
                                            </div>
                                            <div class="undo-btn p-3">
                                                <i class="bi bi-arrow-clockwise"></i>
                                            </div>
                                            <div class="save-btn p-3">
                                                <i class="bi bi-save2"></i>
                                            </div>
                                        </div>
                                    -->
                                <!-- </div> -->
                            </div>
                        </div>
                        
                        <!--Question Container-->
                        <div class="row m-3">
                            <div class="col d-flex" id="workspace" contenteditable="true" style="border: 0.1rem #053742 solid; min-height: 40vh;"></div>
                        </div>

                        <!--Answer Container-->
                        <div class="row" id="answerContainer">
                            <div class="choice d-flex flex-row justify-content-center" id="multipleChoice">
                                <!-- <div class="d-flex flex-row justify-content-center"> -->
                                    <div class="btn btn-outline-palette3 m-2 p-4">
                                        <input type="radio" name="question1-option">
                                        <input type="text" placeholder="Option 1" style="border:none; border-radius:16px">
                                    </div>

                                    <div class="btn btn-outline-palette3 m-2 p-4">
                                        <input type="radio" name="question1-option">
                                        <input type="text" placeholder="Option 2" style="border:none; border-radius:16px">
                                    </div>

                                    <div class="btn btn-outline-palette3 m-2 p-4">
                                        <input type="radio" name="question1-option">
                                        <input type="text" placeholder="Option 3" style="border:none; border-radius:16px">
                                    </div>

                                    <div class="btn btn-outline-palette3 m-2 p-4">
                                        <input type="radio" name="question1-option">
                                        <input type="text" placeholder="Option 4" style="border:none; border-radius:16px">
                                    </div>

                                <!-- </div> -->
                            </div>

                            <div class="choice row d-flex flex-row justify-content-center" id="identification" style="margin-left:0">
                                <!-- <div class="d-flex flex-row justify-content-center"> -->
                                    <input type="text" class="fill-blank p-3" placeholder="Correct Answer">
                                <!-- </div> -->
                            </div>

                        </div>

                    </div> <!-- Sample Content -->

                    <div class="tab-pane fade" id="question-2" role="tabpanel" aria-labelledby="question2-tab">
                        <div class="row mb-4 p-4">
                            <div class="col position-fixed">
                                <div class="assessment-head d-flex flex-row">
                                    <!--Dropdown == Multiple Choice / Identification-->
                                    <div class="assessment-dropdown">
                                        <div class="dropdown">
                                            <select id="assessMode" onchange="getSelectedValue()">
                                                <option value="null" selected disabled>Select Mode</option>
                                                <option value="mlc">Multiple Choice</option>
                                                <option value="idf">Identification</option>
                                            </select>
                                        </div>
                                    </div>
                                    <!--Insert img/Embed link-->
                                    <!--
                                        <div class="assessment-insert d-flex flex-row">
                                            <div class="img-btn p-3">
                                                <i class="bi bi-card-image"></i>
                                            </div>
                                            <div class="link-btn p-3">
                                                <i class="bi bi-film"></i>
                                            </div>
                                        </div>
                                        <div class="assessment-btn d-flex flex-row">
                                            <div class="redo-btn p-3">
                                                <i class="bi bi-arrow-counterclockwise"></i>
                                            </div>
                                            <div class="undo-btn p-3">
                                                <i class="bi bi-arrow-clockwise"></i>
                                            </div>
                                            <div class="save-btn p-3">
                                                <i class="bi bi-save2"></i>
                                            </div>
                                        </div>
                                    -->
                                </div>
                            </div>
                        </div>
                        
                        <!--Question Container-->
                        <div class="row m-3">
                            <div class="col" id="workspace" class="col d-flex" contenteditable="true" style="border: 0.1rem #053742 solid; min-height: 40vh;"></div>
                        </div>

                        <!--Answer Container-->
                        <div class="row" id="answerContainer">
                            <div class="choice" id="multipleChoice">
                                <div class="d-flex flex-row justify-content-center">
                                    <div class="btn btn-outline-palette3 m-2 p-4">
                                        <input type="radio" name="question1-option">
                                        <input type="text" placeholder="Option 1" style="border:none; border-radius:16px">
                                    </div>

                                    <div class="btn btn-outline-palette3 m-2 p-4">
                                        <input type="radio" name="question1-option">
                                        <input type="text" placeholder="Option 2" style="border:none; border-radius:16px">
                                    </div>

                                    <div class="btn btn-outline-palette3 m-2 p-4">
                                        <input type="radio" name="question1-option">
                                        <input type="text" placeholder="Option 3" style="border:none; border-radius:16px">
                                    </div>

                                    <div class="btn btn-outline-palette3 m-2 p-4">
                                        <input type="radio" name="question1-option">
                                        <input type="text" placeholder="Option 4" style="border:none; border-radius:16px">
                                    </div>

                                </div>
                            </div>
                            <div class="choice" id="identification">
                                <div class="d-flex flex-row justify-content-center">
                                    <input type="text" class="fill-blank p-3" placeholder="Correct Answer">
                                </div>
                            </div>

                        </div>

                    </div> <!-- Sample Content -->

                </div>
                

            </div>
        </div>
    </div>

    <!-- Modals -->
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
                        <!-- <input type="range" class="form-control mb-3" id="assessmentInItems" min="1" max="100"> -->
                        <input type="number" class="form-control mb-3" id="assessmentInItems" min="1" max="100" value="1" onInput="correctItems()" onChange="correctItemsChanges()">
                        <label for="assessmentInItems"># of Items</label>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn" data-bs-dismiss="modal">CANCEL</button>
                    <button type="button" class="btn btn-palette2" data-bs-dismiss="modal">OK</button>
                </div>
            </div>
        </div>
    </div>

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
                    <button type="button" class="btn btn-palette2" data-bs-dismiss="modal" onClick="saveAssessment()">YES</button>
                    <button type="button" class="btn" data-bs-dismiss="modal">NO</button>
                </div>
            </div>
        </div>
    </div>

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
                    <button type="button" class="btn btn-palette2" data-bs-dismiss="modal" onClick="publishAssessment()">YES</button>
                    <button type="button" class="btn" data-bs-dismiss="modal">NO</button>
                </div>
            </div>
        </div>
    </div>

    <!--  -->

    <script> // Remove this and transfer to a file
        // function addItem(){
        //     var addItem = document.getElementById("itemContainer");
        //     var item = document.createElement("BUTTON");
        //     item.setAttribute("id", "newItem");
        //     addItem.appendChild(item);

        //     var itemLink = document.createElement("A");
        //     var testText = document.createTextNode("Test Slide")
        //     itemLink.appendChild(testText);
        //     document.getElementById("newItem").appendChild(itemLink);
        // }

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

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous"></script>

    <script>
        loadGenInfo();
        loadQuestions();
        test();
        // createQuestion();
    </script>
</body>
</html>