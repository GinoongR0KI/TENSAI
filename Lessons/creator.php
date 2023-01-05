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
    <title>TENSAI | Create Lesson</title>

    <!-- <style>.dragging{opacity: 0.5;}</style> -->

    <script src="../javascript/pager.js"></script>

    <script defer src="AJAX/Admin/draggableTabs.js"></script>
    <script defer src="AJAX/Admin/controlFunctions.js"></script>

    <script src="AJAX/Admin/saveLesson.js"></script>
    <script src="AJAX/Admin/publishLesson.js"></script>

    <script src="../javascript/toaster.js"></script>
</head>
<body>
    <!-- Toast -->
    <div aria-live="polite" aria-atomic="true" class="d-flex align-items-center">
        <div class="toast-container position-fixed" id="cont_toasts" style="bottom:1vh; right: 1vh">
            
        </div>
    </div>

    <!-- Toast -->

    <!--Lesson Nav Editor-->
    <!-- Top most container -->
    <div class="lesson-content d-flex flex-row bg-secondary p-2 position-relative">
        <div class="lesson-title d-flex flex-row">
            <h3 class="fs-3 ms-3 me-4" id="lessonTitle">Lesson Creator</h3>
            <button type="button" class="btn btn-palette1" data-bs-toggle="modal" data-bs-target="#lessonEditor"><i class="bi bi-pencil-square"></i></button> <!-- Used to toggle the lesson general info modal -->
        </div>

        <div class="button-container d-flex flex-row position-absolute end-0">
            <button type="button" class="btn btn-button me-2" data-bs-toggle="modal" data-bs-target="#confirmDraft"><i class="bi bi-paperclip"></i>Draft</button> <!-- Save the whole document -->
            <button type="button" class="btn btn-button me-2" data-bs-toggle="modal" data-bs-target="#confirmPublish"><i class="bi bi-box-arrow-up"></i>Publish</button> <!-- Save & Publish -->
        </div>
    </div>

    <!-- Main Panels -->
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

                    <button type="button" class="btn btn-outline-palette3 position-absolute bottom-0 ms-3 mb-3" onClick="addPage()"><i class="bi bi-plus-circle"></i> Add Slide</button>
                </div>
                
            </div>

            <!-- Editor Panel -->
            <div class="col mt-4"> <!-- Editor Tools -->
                <nav> <!-- Editor Tab List -->
                    <div class="nav nav-tabs mw-100 text-palette1" id="tab" role="tablist">
                        <button class="nav-link active" id="nav-home-tab" data-bs-toggle="tab" data-bs-target="#editTab" type="button" role="tab" aria-controls="edit" aria-selected="true">Edit</button>
                        <button class="nav-link" id="nav-profile-tab" data-bs-toggle="tab" data-bs-target="#insertTab" type="button" role="tab" aria-controls="insert" aria-selected="false">Insert</button>
                        <button class="nav-link disabled" id="nav-contact-tab" data-bs-toggle="tab" data-bs-target="#rinaTab" type="button" role="tab" aria-controls="rina" aria-selected="false">RINA</button>

                        <div class="undo-redo d-flex flex-row position-absolute end-0 me-3"> <!-- Undo and Redo Buttons -->
                            <button type="button" class="btn" id="ctrlUndo"><i class="bi bi-arrow-counterclockwise"></i></button>
                            <button type="button" class="btn" id="ctrlRedo"><i class="bi bi-arrow-clockwise"></i></button>
                            <button type="button" class="btn" id="ctrlDelPage"><i class="bi bi-trash"></i></button>
                        </div>

                    </div>

                </nav>

                <!--Tab Content-->
                <div class="tab-content mt-4" id="nav-tabContent"> <!-- List of Tab Containers -->
                    <!--Edit Tab-->
                    <div class="tab-pane fade show active" id="editTab" role="tabpanel" aria-labelledby="" tabindex="0"> <!-- Edit Tab Content -->
                        <div class="d-flex flex-row"> <!-- Panel -->

                            <!--Font-->
                            <div class="btn-group p-2">
                                <select class="btn btn-outline-secondary dropdown-toggle" id="ctrlFnt" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    <option value="Arial" selected>Arial</option>
                                    <option value="Verdana">Verdana</option>
                                    <option value="Tahoma">Tahoma</option>
                                    <option value="Trebuchet MS">Trebuchet MS</option>
                                    <option value="Times New Roman">Times New Roman</option>
                                    <option value="Georgia">Georgia</option>
                                    <option value="Garamond">Garamond</option>
                                    <option value="Courier New">Courier New</option>
                                    <option value="Brush Script MT">Brush Script MT</option>

                                </select>
                            </div>
                    
                            <!--Text Style-->
                            <div class="btn-group p-2" role="group" aria-label="Text Style">
                                <button id="ctrlBold" type="button" class="btn btn-outline-palette1"><i class="bi bi-type-bold"></i></button>
                                <button id="ctrlItalic" type="button" class="btn btn-outline-palette1"><i class="bi bi-type-italic"></i></button>
                                <button id="ctrlUnderline" type="button" class="btn btn-outline-palette1"><i class="bi bi-type-underline"></i></button>
                                <button id="ctrlStrikethrough" type="button" class="btn btn-outline-palette1"><i class="bi bi-type-strikethrough"></i></button>
                            </div>

                            <!--Alignment-->
                            <div class="btn-group p-2" role="group" aria-label="Alignment">
                                <button id="ctrlLeft" type="button" class="btn btn-outline-palette1"><i class="bi bi-text-left"></i></button>
                                <button id="ctrlCenter" type="button" class="btn btn-outline-palette1"><i class="bi bi-text-center"></i></button>
                                <button id="ctrlRight" type="button" class="btn btn-outline-palette1"><i class="bi bi-text-right"></i></button>
                                <button id="ctrlJustify" type="button" class="btn btn-outline-palette1"><i class="bi bi-justify"></i></button>
                            </div>

                            <!--List Type-->
                            <div class="btn-group p-2" role="group" aria-label="List Type">
                                <button id="ctrlOrderList" type="button" class="btn btn-outline-palette1"><i class="bi bi-list-ol"></i></button>
                                <button id="ctrlUnorderList" type="button" class="btn btn-outline-palette1"><i class="bi bi-list-ul"></i></button>
                            </div>

                            <!--Text Indent-->
                            <div class="btn-group p-2" role="group" aria-label="Text Indent">
                                <button id="ctrlIndent" type="button" class="btn btn-outline-palette1"><i class="bi bi-text-indent-left"></i></button>
                                <button id="ctrlOutdent" type="button" class="btn btn-outline-palette1"><i class="bi bi-text-indent-right"></i></button>
                            </div>

                        </div>

                    </div>

                

                    <!--Insert Tab-->
                    <div class="tab-pane fade d-flex flex-row" id="insertTab" role="tabpanel" aria-labelledby="" tabindex="0"> <!-- Insert Tab Content -->
                        <div class="d-flex flex-row">

                            <div class="accordion me-3" id="mediaImgTab"> <!-- Image -->

                                <div class="accordion-item">

                                    <div class="accordion-header" id="imgTab"> <!-- Button for Image Accordion -->
                                        <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#img" aria-expanded="false" aria-controls="imageTab">
                                            <div class="text-center">
                                                <i class="bi bi-card-image"></i>
                                            </div>
                                        </button>

                                    </div>

                                    <div id="img" class="accordion-collapse collapse" aria-labelledby="imgTab" data-bs-parent="#mediaTab"> <!-- Accordion Content -->
                                        <div class="accordion-body panel-body">
                                            <label for="imgFile" class="form-label mb-2">Upload image</label>
                                            <input class="form-control mb-2" type="file" id="imgFile" accept="image/*">
                                            <button type="button" class="btn btn-outline-palette2" id="ctrlImg">INSERT</button>
                                        </div>

                                    </div>

                                </div>

                            </div>

                            <div class="accordion" id="mediaVidTab"> <!-- Video -->

                                <div class="accordion-item">

                                    <div class="accordion-header" id="vidTab"> <!-- Video Button Accordion -->
                                        <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#vid" aria-expanded="false" aria-controls="vidTab">
                                            <div class="text-center">
                                                <i class="bi bi-film"></i>
                                            </div>

                                        </button>

                                    </div>

                                    <div id="vid" class="accordion-collapse collapse" aria-labelledby="vidTab" data-bs-parent="#mediaTab"> <!-- Accordion Content -->
                                        <div class="accordion-body">
                                            <input class="col-form-label mb-2" id="ctrlInVid" type="text" placeholder="Embed video link">
                                            <button type="button ms-2" class="btn btn-outline-palette2" id="ctrlVid">INSERT</button>
                                        </div>

                                    </div>

                                </div>

                            </div>
                            
                        

                        </div>


                        <!--RINA Tab-->
                        <div class="tab-pane fade" id="rinaTab" role="tabpanel" aria-labelledby="rina-tab" tabindex="0"></div>

                    </div>

                </div>
            
                <!--Lesson Editor-->
                <div class="row m-4 tab-content" id="cont_pageContents"> <!-- Convert this into a tab content div -->
                    <div class="tab-pane fade show active" id="page-1" role="tabpanel" aria-labelledby="page1-tab" contenteditable="true" style="border: 0.1rem #053742 solid; min-height: 50vh;"></div>
                    <div class="tab-pane fade" id="page-2" role="tabpanel" aria-labelledby="page2-tab" contenteditable="true" style="border: 0.1rem #053742 solid; min-height: 50vh;"></div>
                </div>
        
            </div>
            
        </div>

    </div>



    <!--Modal Area-->

    <!-- General Information Modal -->
    <div class="modal fade" id="lessonEditor" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true"> <!-- This is the Lesson's General Information -->
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Lesson</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body">
                    <div class="form-floating">
                        <input type="text" class="form-control mb-3" id="lessonInTitle" placeholder="Lesson Title">
                        <label for="floatingInput">Lesson Title</label>
                    </div>

                    <div class="form-floating">
                        <textarea type="text" class="form-control mb-3" id="lessonInDescription" placeholder="Description" maxlength="255"></textarea>
                        <label for="floatingInput">Description</label>
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
                    <button type="button" class="btn btn-button" data-bs-dismiss="modal" onClick="saveLesson('<?php echo $_GET['lessonID']; ?>')">YES</button>
                    <button type="button" class="btn" data-bs-dismiss="modal">NO</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Publishing Confirmation modal -->
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
                    <button type="button" class="btn btn-button" data-bs-dismiss="modal" onClick="publishLesson('<?php echo $_GET['lessonID']; ?>')">YES</button>
                    <button type="button" class="btn" data-bs-dismiss="modal">NO</button>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-u1OknCvxWvY5kfmNBILK2hRnQC3Pr17a+RTT6rIHI7NnikvbZlHgTPOOmMi466C8" crossorigin="anonymous"></script>
    <script>
        loadGenInfo();
        loadPages();
    </script>
</body>
</html>