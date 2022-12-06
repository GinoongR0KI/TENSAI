<!DOCTYPE html>
<html lang="en">
<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">
    <link rel="stylesheet" href="../css/rina_style.css">
    <link rel="stylesheet" href="../css/student.min.css">
    <link rel="stylesheet" href="../css/student.css">
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TENSAI | Lesson Name</title>
    <script>
        const myModal = document.getElementById('myModal')
        const myInput = document.getElementById('myInput')

        myModal.addEventListener('shown.bs.modal', () => {
        myInput.focus()
        })
    </script>

    <script src="AJAX/Students/lesson.js"></script>

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
        <div class="row">
            <div class="col">
                <div class="back">
                    <a href="#" id="btn_back" onClick="history.go(-1)"><img src="../mat_icons/tensai_back_btn.png"></a> <!-- Back Button -->
                </div>
                <div>
                    <a class="btn d-flex align-items-center" data-bs-toggle="offcanvas" href="#slideMenu" role="button" aria-controls="slideMenu"> <!-- Slides -->
                        <i class="bi bi-menu-button-wide-fill fs-3"></i>
                    </a>
                </div>
            </div>
            <div class="col">
                <div class="lesson-info float-end">
                    <button data-bs-toggle="modal" data-bs-target="#lessonInfo" id="btn_info">Lesson Info</button>
                </div>
            </div>
        </div>

        <div class="slide-container position-relative">
            <div class="slide-button-left float-start position-absolute top-50 start-0">
                <button id="prevBTN" onclick="nextPrev(-1)"><img src="../mat_icons/tensai_left_btn.png"></button>
            </div>
            
            <div class="lesson-container d-flex justify-content-center align-content-center">
                <div class="lesson-output" id="cont_slides">
                <!--Class name should be /slide/-->
                <!--Test Slides-->
                <div class="slide">
                    Test Slide 1
                </div>
                <div class="slide">
                    Test Slide 2
                </div>
                <div class="slide">
                    Test Slide 3
                </div>
                <div class="slide">
                    Test Slide 4
                </div>
                <div class="slide">
                    Test Slide 5
                </div>
                </div>
            </div>

            <div class="slide-button-right float-end position-absolute top-50 end-0">
                <button id="nextBTN" onclick="nextPrev(1)"><img src="../mat_icons/tensai_right_btn.png"></button>
            </div>
        </div>

        <!-- RINA -->
        <div class="d-flex justify-content-end">
            <div class="rina-container position-absolute bottom-0 end-0 p-4">
                <!-- Wrapper for Rina UI -->
                <div id="rina_bubble" class="rina_wrapper" style="display:none;">
                    <div class="head-text">
                        Talk with RINA!
                    </div>
                    <div class="chat-box">
                        <form action="#">
                        <div class="field">
                            <p id="rina_reply"></p>
                        </div>
                        <hr>
                        <div>
                            <p id="rina_speech">...</p>
                        </div>
                        </form>
                    </div>
                </div>
                <button class="btn" id="rina_click" onClick="manualToggleBubble()"><img src="../mat_icons/rina_base.png"></img></button>
            </div>
        </div>
    </div>

    <!--Offcanvas Slide Menu-->
    <div class="offcanvas offcanvas-start" tab-index="-1" id="slideMenu" aria-labelledby="slideMenu">
        <div class="offcanvas-header">
            <h5 class="offcanvas=title" id="lessonTitle">Lesson Title</h5>
            <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <div class="offcanvas=body">
            <nav class="navbar bg-palette3 justify-content-center "> <!-- Slides Container -->
                <div class="container-fluid">
                    <ul class="navbar-nav" id="cont_nav" role="tablist" style="width:100%">
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
        </div>
    </div>

    <!--Lesson Info Modal-->
    <div class="modal fade" id="lessonInfo" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="txt_lessonTitle">Lesson Name</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body" id="txt_lessonDesc">
                    Lesson information here....
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" id="btn_infoClose" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
    <script>
        var currentSlide = 0;
        showSlide(currentSlide);

        function showSlide(n){
            console.log("shown");
            currentSlide = n;
            var slide = document.querySelectorAll(".slide");

            slide.forEach(element => {
                element.style.display = "none";
            });

            if (slide.length > 0) {
                slide[n].style.display = "block";

                if(n == 0){
                document.getElementById("prevBTN").style.display = "none";
                }
                else {
                    document.getElementById("prevBTN").style.display = "inline";
                }
                if(n == (slide.length - 1)){
                    document.getElementById("nextBTN").style.display = "none";
                }
                else{
                    document.getElementById("nextBTN").style.display = "inline"
                }
            } else {
                document.getElementById("prevBTN").style.display = "none";
                document.getElementById("nextBTN").style.display = "none";
            }
            
        }

        function nextPrev(n){
            var slide = document.querySelectorAll(".slide");
            if (n < 0) {
                if (currentSlide + n >= 0) {
                    slide[currentSlide].style.display = "none";
                    currentSlide = currentSlide + n;
                    showSlide(currentSlide);
                } else {
                    rinaReply.innerText = "Sorry, you are already in the first page";
                    textToSpeech(rinaReply.innerText);
                }
            } else if (n > 0) {
                if (currentSlide + n < slide.length) {
                    slide[currentSlide].style.display = "none";
                    currentSlide = currentSlide + n;
                    showSlide(currentSlide);
                } else {
                    rinaReply.innerText = "Sorry, you are already in the last page";
                    textToSpeech(rinaReply.innerText);
                    // speechBubble.innerText = "You are in the last page";
                }
            }
        }

        loadLesson();
        callRINA();
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-u1OknCvxWvY5kfmNBILK2hRnQC3Pr17a+RTT6rIHI7NnikvbZlHgTPOOmMi466C8" crossorigin="anonymous"></script>
    <script src="https://code.responsivevoice.org/responsivevoice.js?key=QFJLgY5F"></script>
</body>
