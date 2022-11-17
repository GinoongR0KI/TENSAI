<!DOCTYPE html>
<html lang="en">
<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">    <meta charset="UTF-8">
    <link rel="stylesheet" href="../css/custom.min.css">
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TENSAI Assessment Creator</title>
</head>
<body>
    <div class="container-fluid">
    <div class="row d-flex">

        <!--Questions Panel-->
            <div class="col-2 d-flex flex-column justify-content-start align-content-start bg-palette1 vh-100">
                <div class="back-btn">
                    <a href="manage.php">
                        <button type="button" class="btn btn-outline-palette3 p-1 mt-3"><i class="bi bi-box-arrow-in-left"></i>BACK</button>
                    </a>
                </div>
                <button type="button" class="btn btn-outline-palette3 mt-4"  onclick="addItem()"><i class="bi bi-plus-circle"></i> Add Question</button>
                <div class="item-container" id="itemContainer">
                    <!--Add items here onclick-->
                </div>
            
            </div>

        <!--Assessment Creator Workspace-->
        <div class="col">
            <div class="row mb-4 p-4">
                <div class="col position-fixed">
                    <div class="assessment-head d-flex flex-row">
                        <!--Dropdown == Multiple Choice / Identification-->
                            <div class="assessment-dropdown">
                                <div class="dropdown">
                                    <button class="btn btn-outline-palette2 dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                        Choose
                                    </button>
                                    <ul class="dropdown-menu" onchange="assessMode(this)">
                                        <li><a class="dropdown-item">Multiple Choice</a></li>
                                        <li><a class="dropdown-item">Identification</a></li>
                                    </ul>

                                </div>
                            </div>
                        <!--Insert img/Embed link-->
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
                    </div>
                </div>
            </div>
            
            <!--Question Container-->
            <div class="row m-3">
                <div class="col" id="workspace" class="col d-flex" contenteditable="true"
                style="border: 0.1rem #053742 solid; min-height: 40vh;">
                <!--Editable Workspace-->
                </div>
            </div>

            <!--Answer Container-->
            <div class="row" id="answerContainer">
                <div class="choice" id="multipleChoice" style="display:hidden;">
                    This is multiple choice
                </div>
                <div class="choice" id="identification" style="display:hidden;">
                    This is identification
                </div>

            </div>

        </div>
    </div>
</div>

<script>
    function addItem(){
        var addItem = document.getElementById("itemContainer");
        var item = document.createElement("BUTTON");
        item.setAttribute("id", "newItem");
        addItem.appendChild(item);

        var itemLink = document.createElement("A");
        var testText = document.createTextNode("Test Slide")
        itemLink.appendChild(testText);
        document.getElementById("newItem").appendChild(itemLink);
    }

    function assessMode(mode){
        if(mode.selectedIndex == 0){
            for(var i = 0; i<div.length; i++){
                div[i].style.display = 'none';
            }
            document.getElementById(mode.value).style.display = 'block';
        }
    }

    window.onload=function(){
        div = document.getElementById("answerContainer").getElementsByClassName('choice');
    };
</script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous"></script>
</body>
</html>