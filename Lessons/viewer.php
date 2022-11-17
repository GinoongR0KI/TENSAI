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
    <title>TENSAI - Lesson Viewer</title>

    <script src="AJAX/Students/lesson.js"></script>
    <script src="../RINA/rinaJS.js"></script>

    <script src="../javascript/toaster.js"></script>
</head>
<body style="background-image: url('../src/s1.jpg'); background-attachment: fixed; background-repeat: no-repeat; background-position: center; background-size: cover;">
    <!-- Toast -->
    <div aria-live="polite" aria-atomic="true" class="d-flex align-items-center">
        <div class="toast-container position-absolute" id="cont_toasts" style="position:fixed; bottom:1vh; right: 1vh">
            
        </div>
    </div>

    <!-- Toast -->

    <!--Background-->
    <div class="tensai-body">
        <div class="color-overlay">
            <div class="tensai-head d-flex">
                <a class="btn d-flex align-items-center" data-bs-toggle="offcanvas" href="#slideMenu" role="button" aria-controls="slideMenu" style="color:white;"> <!-- Slides -->
                    <i class="bi bi-menu-button-wide-fill fs-3"></i>
                </a>
                <div class="mb-2 p-3 justify-content-start align-items-start">
                    
                    <h1 id="txt_lessonTitle">LESSON NAME</h1>
                </div>

                <div class="mb-2 p-4 ms-auto">
                    <a href="#" class="form-control" id="btn_back" onClick="history.go(-1)"><i class="bi bi-arrow-return-left"></i> GO BACK</a>
                </div>
            </div>

                            <!--Lesson Viewer-->
                <div class="container-fluid">
                    <div style="position:fixed; bottom:10px;left:10px;z-index: 10">
                        <p id="rina_speech"></p>
                        <button id='btnTalk' onclick="logger()" onclick="audioCall()">Give Command!</button>
                    </div>
                <div class="row row-cols-5 row-cols-md-2 mt-3 ms-5">
                    <div class="col d-flex align-content-center">
                        <div class="d-flex justify-content-center align-items-center ms-5 position-relative">
                            <div class="lesson-container d-flex justify-content-center align-items-center" style="border: 5px solid #fff; min-height: 70vh; min-width: 80vw; background-color: rgb(162, 219, 250, 0.5)">
                                <div class="lesson-output" id="cont_slides">
                                    <!--Return output from Lesson Creator-->
                                    <!--Slides-->

                                    <!--Test Slides-->
                                    <div class="slide" style="display:none;">
                                        Test 1
                                    </div>
                                    <div class="slide" style="display:none;">
                                        Test 2
                                    </div>
                                    <div class="slide" style="display:none;">
                                        Test 3
                                    </div>
                                    <div class="slide" style="display:none;">
                                        Test 4
                                    </div>
                                    <div class="slide" style="display:none;">
                                        Test 5
                                    </div>
                                    <!--Test Slides-->

                                </div>
                            </div>
                <!--BUTTONS-->
                <button type="button" class="btn btn-palette4 position-absolute start-0" id="prevBTN" onclick="nextPrev(-1)"><i class="bi bi-arrow-bar-left"></i>PREVIOUS</button>
                <button type="button" class="btn btn-palette4 position-absolute end-0" id="nextBTN" onclick="nextPrev(1)">NEXT<i class="bi bi-arrow-bar-right"></i></button>
                        </div>
                        </div>
 
                </div>
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

    <!-- modals -->

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
                    speechBubble.innerText = "You are in the first page";
                }
            } else if (n > 0) {
                if (currentSlide + n < slide.length) {
                    slide[currentSlide].style.display = "none";
                    currentSlide = currentSlide + n;
                    showSlide(currentSlide);
                } else {
                    speechBubble.innerText = "You are in the last page";
                }
            }
        }
     
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous"></script>
    <script>
        loadLesson();
    </script>
</body>
</html>