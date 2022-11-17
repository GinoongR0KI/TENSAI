<?php

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css"> 
    <link rel="stylesheet" href="../css/custom.min.css">
    <link rel="stylesheet" href="../css/style.css">
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TENSAI Lesson Creator</title>

    <script defer src="AJAX/draggableTabs.js"></script>
</head>
<body>
    <div class="container-fluid">
    <div class="row">

        <!--Slide Panel-->
        <div class="col-2 flex-column bg-palette1 vh-100" id="cont_pages">
            <div class="d-flex flex-column align-items-center align-items-sm-start px-3 pt-2 text-white">
                <ul class="nav nav-pills cont_draggables" id="myTab" role="tablist">
                    <li class="nav-item mt-4 mb-3 align-middle px-0 draggable" role="presentation" draggable="true">
                        <!-- <button class="nav-link active" id="page1-tab" data-bs-toggle="tab" data-bs-target="#page-1" type="button" role="tab" aria-controls="home" aria-selected="true"><i class="bi bi-card-text"></i></button> -->
                        <button class="nav-link active" id="page1-tab" data-bs-toggle="tab" data-bs-target="#page-1" type="button" role="tab" aria-controls="home" aria-selected="true">
                            <i class="bi bi-card-text">1</i>
                            <!-- <iframe frameborder="0" style="width:100%; height:64px;">
                                
                            </iframe> -->
                        </button>
                    </li>
                    <li class="nav-item mt-4 mb-3 align-middle px-0 draggable" role="presentation" draggable="true">
                        <button class="nav-link" id="page2-tab" data-bs-toggle="tab" data-bs-target="#page-2" role="tab" aria-controls="edit" aria-selected="true">2<i class="bi bi-card-text"></i></button>
                    </li>
                </ul>
            </div>
            <script defer src="AJAX/controlFunctions.js"></script>

            <button type="button" class="btn btn-outline-palette3 mt-4 ms-5"><i class="bi bi-plus-circle"></i> Add Slide</button> <!-- This will add new pages (through DOM?) -->
        </div>

        <!--Format Tab-->
        <div class="col mt-4">
            <nav>
                <div class="nav nav-tabs mw-100 text-palette1" id="textTabs" role="tablist">
                    <button class="nav-link active" id="nav-home-tab" data-bs-toggle="tab" data-bs-target="#editTab" type="button" role="tab" aria-controls="edit" aria-selected="true">Edit</button>
                    <button class="nav-link" id="nav-profile-tab" data-bs-toggle="tab" data-bs-target="#insertTab" type="button" role="tab" aria-controls="insert" aria-selected="false">Insert</button>
                    <button class="nav-link disabled" id="nav-contact-tab" data-bs-toggle="tab" data-bs-target="#rinaTab" type="button" role="tab" aria-controls="rina" aria-selected="false">RINA</button>
                </div>
            </nav>

            <!--Tab Content-->
            <div class="tab-content mt-4" id="nav-tabContent">
                <!--Edit Tab-->

                <div class="tab-pane fade show active" id="editTab" role="tabpanel" aria-labelledby="edit-tab" tabindex="0">
                    <div class="d-flex flex-row">    
                    <!--Font-->
                        <div class="btn-group p-2">
                            <select class="btn btn-outline-secondary dropdown-toggle" id="ctrlFnt" type="button" aria-expanded="false">
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
                                <!-- <ul class="dropdown-menu">
                                    
                                </ul> -->
                                <!-- <select class="dropdown-menu">
                                </select> -->
                            <!-- <button class="btn btn-outline-palette2" type="button" id="ctrlFntPlus"><i class="bi bi-type"></i><i class="bi bi-plus"></i></button>
                            <button class="btn btn-outline-palette2" type="button" id="ctrlFntMinus"><i class="bi bi-type"></i><i class="bi bi-dash"></i></button> -->
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
                            <button id="ctrlIndentLeft" type="button" class="btn btn-outline-palette1"><i class="bi bi-text-indent-left"></i></button>
                            <button id="ctrlIndentRight" type="button" class="btn btn-outline-palette1"><i class="bi bi-text-indent-right"></i></button>
                        </div>
                    </div>
                </div>

            

            <!--Insert Tab-->

            <div class="tab-pane fade d-flex flex-row" id="insertTab" role="tabpanel" aria-labelledby="insert-tab" tabindex="0">
                <div class="d-flex flex-row" style="display: block;">

                    <div class="accordion me-3" id="mediaTab">
                        <div class="accordion-item">
                            <div class="accordion-header" id="imgTab">
                                <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#img" aria-expanded="false" aria-controls="imageTab">
                                    <div class="text-center">
                                        <i class="bi bi-card-image"></i>
                                    </div>
                                </button>
                            </div>
                            <div id="img" class="accordion-collapse collapse" aria-labelledby="imgTab" data-bs-parent="#mediaTab">
                                <div class="accordion-body panel-body">
                                    <label for="imgFile" class="form-label mb-2">Upload image</label>

                                    <!-- <iframe>
                                        <form name="formImg" enctype="multipart/form-data" id="iform">
                                            <input class="form-control mb-2" type="file" id="imgFile">
                                        </form>
                                    </iframe> -->

                                    <input class="form-control mb-2" type="file" id="imgFile" name="imgFile">

                                    <button type="button" class="btn btn-outline-palette2" id="ctrlImg">INSERT</button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="accordion" id="mediaTab">
                        <div class="accordion-item">
                            <div class="accordion-header" id="vidTab">
                                <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#vid" aria-expanded="false" aria-controls="vidTab">
                                    <div class="text-center">
                                        <i class="bi bi-film"></i>
                                    </div>
                                </button>
                            </div>

                            <div id="vid" class="accordion-collapse collapse" aria-labelledby="vidTab" data-bs-parent="#mediaTab">
                                <div class="accordion-body">
                                <input class="col-form-label mb-2" id="ctrlInVid" type="text" placeholder="Embed video link">
                                <button type="button ms-2" class="btn btn-outline-palette2" id="ctrlVid">INSERT</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


            <!--RINA Tab-->
            <div class="tab-pane fade" id="rinaTab" role="tabpanel" aria-labelledby="rina-tab" tabindex="0">

            </div>
         </div>
        
        <!--Lesson Editor-->
        <div class="row m-4 tab-content">
            <!-- <div class="col" id="workspace" class="col d-flex" contenteditable="true" style="border: 0.1rem #053742 solid; min-height: 50vh;">
                Editable Workspace
            </div> -->
            <div class="tab-pane fade show active" id="page-1" role="tabpanel" aria-labelledby="page1-tab" contenteditable="true" style="border: 0.1rem #053742 solid; min-height: 50vh;">
                <!--Editable Workspace-->
            </div>
            <div class="tab-pane fade" id="page-2" role="tabpanel" aria-labelledby="page2-tab" tabindex="0" contenteditable="true" style="border: 0.1rem #053742 solid; min-height: 50vh;">
                <!--Editable Workspace-->
            </div>
        </div>
        
        </div>
    </div>
</div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous"></script>
</body>
</html>