function loadGenInfo() {
    // Get Vars from URL
    window.$_GET = new URLSearchParams(location.search);
    var assessID = $_GET.get('assessID');
    //

    var request = new XMLHttpRequest();

    request.open("POST", "AJAX/Admin/getAssessmentGeneralInfo.php");
    request.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

    request.onreadystatechange = function () {
        if (this.readyState === 4 && this.status === 200) {
            var result = this.response;
            console.log(result);

            if (result != null && result != "" && result != "[]") {
                var assessment = JSON.parse(result);

                // Containers
                var inTitle = document.querySelector("#assessmentInTitle");
                var inItem = document.querySelector("#assessmentInItems");
                //
                
                // Process Data
                var sepTitle = assessment[0]['title'].split("|sepData|");
                var title = sepTitle[1] != "" ? sepTitle[1] : sepTitle[0];
                var sepItem = assessment[0]['questions'].split("|sepData|");
                var item = sepItem[1] != "" ? sepItem[1] : sepItem[0];
                //

                // Assign
                inTitle.value = title;
                inItem.value = item;
                //
            }
        }
    };

    request.send("assessID="+assessID);
}

function loadQuestions() {
    // Get Vars from URL
    window.$_GET = new URLSearchParams(location.search);
    var assessID = $_GET.get('assessID');
    
    var uniqueID = Date.now() - 1000;
    //

    var request = new XMLHttpRequest();

    request.open("POST", "AJAX/Admin/getQuestions.php");
    request.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

    request.onreadystatechange = function () {
        if (this.readyState === 4 && this.status === 200) {
            var result = this.response;
            console.log(result);

            // Containers
            var cont_draggables = document.querySelector(".cont_draggables");
            var cont_questions = document.querySelector("#cont_questions");

                // Reset
            cont_draggables.innerHTML = "";
            cont_questions.innerHTML = "";
                //
            //

            if (result != null && result != "" && result != "[]") {
                var assessment = JSON.parse(result);
                console.log(assessment);

                var raw_questions = assessment[0]['question'];
                var drafts = raw_questions.split("|sepData|");
                drafts = drafts[1] != "" ? drafts[1] : drafts[0];

                var questions = drafts.split("|sepQuestion|");

                if (questions.length == 1) {
                    var curPageID = (uniqueID);

                    // Slides
                    var slide = createNewSlide();
                    slide.classList.add("active");
                    var slideBtn = createSlideButton("question-"+curPageID, curPageID);
                    slideBtn.classList.add("active");

                        // Append
                    slide.appendChild(slideBtn);
                        //
                    //

                    // Pages
                    var question = createQuestion(curPageID);
                    question.classList.add("show"); question.classList.add("active");
                    question.childNodes[1].firstChild.innerHTML = questions[0];
                    //

                    cont_draggables.appendChild(slide);
                    cont_questions.appendChild(question);

                    toggleType("#qType-"+curPageID, "#mc-"+curPageID, "#ident-"+curPageID, "#tof-"+curPageID);
                } else {
                    for (i = 0; i < questions.length-1; i++) {
                        var curPageID = (uniqueID + i);

                        // Slides
                        var slide = createNewSlide();
                        if (i == 0) {slide.classList.add("active");}
                        var slideBtn = createSlideButton("question-"+curPageID, curPageID);
                        if (i == 0) {slideBtn.classList.add("active");}

                            // Append
                        slide.appendChild(slideBtn);
                            //
                        //

                        // Questions
                        var question = createQuestion(curPageID);
                        if (i == 0) {question.classList.add("show");question.classList.add("active");}
                            // Assign Values
                                // Question Type
                        var questionTypes = assessment[0]['types'].split("|sepData|")[1] != "" ? assessment[0]['types'].split("|sepData|")[1] : assessment[0]['types'].split("|sepData|")[0];
                        var questionType = questionTypes.split("|sepQuestion|")[i];
                        question.childNodes[0].firstChild.childNodes[1].value = questionType;
                                //

                                // Questions
                        question.childNodes[1].firstChild.innerHTML = questions[i];
                                //

                                // Options
                        if (questionType == "Multiple Choice") {
                            var optionNodes = question.childNodes[2].firstChild.firstChild.childNodes;

                            var options = assessment[0]['options'].split("|sepData|")[1] != "" ? assessment[0]['options'].split("|sepData|")[1] : assessment[0]['options'].split("|sepData|")[0];
                            var option = options.split("|sepQuestion|")[i];

                            var answers = assessment[0]['answer'].split("|sepData|")[1] != "" ? assessment[0]['answer'].split("|sepData|")[1] : assessment[0]['answer'].split("|sepData|")[0];
                            var answer = answers.split("|sepQuestion|")[i];

                            for (o = 0; o < optionNodes.length; o++) {
                                var optionNode = optionNodes[o].childNodes[1];
                                var radioNode = optionNodes[o].childNodes[0];

                                optionNode.value = option.split("|sepOption|")[o];
                                if (optionNode.value == answer) {console.log("true check");radioNode.checked = true;}
                            }
                        } else if (questionType == "Identification") {
                            var identNode = question.childNodes[2].childNodes[1].firstChild.firstChild;

                            var answers = assessment[0]['answer'].split("|sepData|")[1] != "" ? assessment[0]['answer'].split("|sepData|")[1] : assessment[0]['answer'].split("|sepData|")[0];
                            var answer = answers.split("|sepQuestion|")[i];

                            identNode.value = answer;
                            console.log(identNode);
                        } else {
                            console.log(question.childNodes[2].childNodes[2].firstChild.childNodes);
                            var tofNodes = question.childNodes[2].childNodes[2].firstChild.childNodes;

                            var answers = assessment[0]['answer'].split("|sepData|")[1] != "" ? assessment[0]['answer'].split("|sepData|")[1] : assessment[0]['answer'].split("|sepData|")[0];
                            var answer = answers.split("|sepQuestion|")[i];

                            for (o = 0; o < tofNodes.length; o++) {
                                var optionNode = tofNodes[o].childNodes[1];
                                console.log(optionNode);
                                var radioNode = tofNodes[o].childNodes[0];
                                console.log(radioNode);

                                // optionNode.value = option.split("|sepOption|")[o];
                                optionNode.value = optionNode;
                                if (optionNode.textContent == answer) {radioNode.checked = true;}
                            }
                        }
                                //


                            //
                        //

                        cont_draggables.appendChild(slide);
                        cont_questions.appendChild(question);

                        toggleType("#qType-"+curPageID, "#mc-"+curPageID, "#ident-"+curPageID, "#tof-"+curPageID);
                    }
                }

                getQuestionsCount();
                getDraggables();
            } else {
                generateToast("testError", "Notification", "Display", "Error: No Questions Found");
            }
        }
    };

    request.send("assessID="+assessID);
}

// Create New Slides
function addQuestion() {
    // Containers
    var cont_draggables = document.querySelector(".cont_draggables");
    var cont_questions = document.querySelector("#cont_questions");
    //

    // Vars
    var uniqueID = Date.now();
    //

    var slide = createNewSlide();
    var slideBtn = createSlideButton("question-"+uniqueID, uniqueID);

    var page = createQuestion(uniqueID);

    // Append
    slide.appendChild(slideBtn);

    cont_draggables.appendChild(slide);
    cont_questions.appendChild(page);
    //

    toggleType("#qType-"+uniqueID, "#mc-"+uniqueID, "#ident-"+uniqueID, "#tof-"+uniqueID);

    getQuestionsCount();
    getDraggables();
}
//

// Sliders
function createNewSlide() {
    var slide = document.createElement("li");

    // Attributes

    slide.setAttribute("class", "nav-item draggable");
    slide.draggable = true;
    //

    return slide;
}

function createSlideButton(targetPage, pageID) {
    var btn = document.createElement("button");

    // Attributes

    btn.setAttribute("class", "nav-link slideBtn btn");
    btn.setAttribute("id", "page"+pageID+"-tab");
    btn.setAttribute("data-bs-toggle", "tab");
    btn.setAttribute("data-bs-target", "#"+targetPage);
    btn.setAttribute("type", "button");
    btn.setAttribute("role", "tab");
    btn.setAttribute("aria-controls", "home");
    btn.setAttribute("aria-selected", "true");
    btn.setAttribute("style", "width:100%");
    btn.innerHTML = '<i class="bi bi-card-text test1">'+pageID+'</i>';

    //

    return btn;
}

function createQuestion(curPageID) {
    console.log("correct question");
    var div = document.createElement("div");

    var header = createQuestionHeader(curPageID);
    var workspace = createQuestionWorkspace(curPageID);
    var answers = createQuestionAnswers(curPageID);

    // Attribute
    div.setAttribute("class","tab-pane fade");
    div.setAttribute("id","question-"+curPageID);
    div.setAttribute("role","tabpanel");
    div.setAttribute("aria-labelledby","question"+curPageID+"-tab");
    //

    // Appending
    div.appendChild(header);
    div.appendChild(workspace);
    div.appendChild(answers);
    //

    return div;
}

function createQuestionHeader(currentID) {
    var div = document.createElement("div");

    var assessHead = document.createElement("div");
    var txtQ = document.createTextNode("Question Type:");
    var select = document.createElement("select");
    var optNull = document.createElement("option")
    var optMC = document.createElement("option")
    var optIdent = document.createElement("option")
    var optToF = document.createElement("option");

    var controlDiv = document.createElement("div");
    var btnUndo = document.createElement("button");
    var btnRedo = document.createElement("button");
    var btnDel = document.createElement("button");

    // Attribute

    div.setAttribute("class", "row col mb-4 p-4");

    assessHead.setAttribute("class", "assessment-head d-flex flex-row");
    select.setAttribute("id", "qType-"+currentID);
    select.setAttribute("onChange", "toggleType('#"+select.id+"', '#mc-"+currentID+"', '#ident-"+currentID+"', '#tof-"+currentID+"')"); // Perform a script here that toggles the canvas depending on which question type is selected
        // Options
    optNull.setAttribute("value","null");
    optNull.disabled = true;
    optNull.innerText = "Select Question Type";

    optMC.setAttribute("value","Multiple Choice");
    optMC.selected = true;
    optMC.innerText = "Multiple Choice";

    optIdent.setAttribute("value","Identification");
    optIdent.innerText = "Identification";

    optToF.setAttribute("value", "True / False");
    optToF.innerText = "True or False";
        //

    controlDiv.setAttribute("class", "undo-redo d-flex flex-row position-absolute end-0 me-3");

    btnUndo.setAttribute("type","button");
    btnUndo.setAttribute("class","btn");
    btnUndo.setAttribute("id","ctrlUndo");
    btnUndo.innerHTML = "<i class=\"bi bi-arrow-counterclockwise\"></i>";

    btnRedo.setAttribute("type","button");
    btnRedo.setAttribute("class","btn");
    btnRedo.setAttribute("id","ctrlRedo");
    btnRedo.innerHTML = "<i class=\"bi bi-arrow-clockwise\"></i>";

    btnDel.setAttribute("type","button");
    btnDel.setAttribute("class","btn");
    btnDel.setAttribute("id","ctrlDelQuestion");
    btnDel.setAttribute("onClick", "deleteQuestion()");
    btnDel.innerHTML = "<i class=\"bi bi-trash\"></i>";

    //

    // Appending
    select.appendChild(optNull);
    select.appendChild(optMC);
    select.appendChild(optIdent);
    select.appendChild(optToF);

    // controlDiv.appendChild(btnUndo);
    // controlDiv.appendChild(btnRedo);
    controlDiv.appendChild(btnDel);

    assessHead.appendChild(txtQ);
    assessHead.appendChild(select);
    assessHead.appendChild(controlDiv);

    div.appendChild(assessHead);
    //

    return div;
}

function createQuestionWorkspace(currentID) {
    var div = document.createElement("div");
    var canvas = document.createElement("div");

    // Attribute
    div.setAttribute("class", "row m-3");

    canvas.setAttribute("class", "col d-flex justify-content-center");
    canvas.setAttribute("id", "workspace-"+currentID);
    canvas.setAttribute("style", "border: 0.1rem #053742 solid; min-height: 40vh;");
    canvas.setAttribute("contenteditable","true");
    canvas.addEventListener("paste", function (e) {
        e.preventDefault();

        var txt = (e.originalEvent || e).clipboardData.getData('text/plain');

        document.execCommand("insertHTML", false, txt);
    });
    //

    // Append
    div.appendChild(canvas);
    //

    return div;
}

function createQuestionAnswers(currentID) {
    var div = document.createElement("div");

    // Multiple Choice
    var mcDiv = document.createElement("div");
    var mcInner = document.createElement("div");
        // Opt 1
    var opt1Div = document.createElement("div");
    var rad1 = document.createElement("input");
    var txtIn1 = document.createElement("input");
        //

        // Opt 2
    var opt2Div = document.createElement("div");
    var rad2 = document.createElement("input");
    var txtIn2 = document.createElement("input");
        //

        // Opt 3
    var opt3Div = document.createElement("div");
    var rad3 = document.createElement("input");
    var txtIn3 = document.createElement("input");
        //

        // Opt 4
    var opt4Div = document.createElement("div");
    var rad4 = document.createElement("input");
    var txtIn4 = document.createElement("input");
        //

    //

    // Identification
    var identDiv = document.createElement("div");
    var identInner = document.createElement("div");

    var txtInIdent = document.createElement("input");

    //

    // True or False
    var tofDiv = document.createElement("div");
    var tofInner = document.createElement("div");
        // Choices
    var trueDiv = document.createElement("div");
    var trueRad = document.createElement("input");

    var falseDiv = document.createElement("div");
    var falseRad = document.createElement("input");
    //


    // Attribute
    div.setAttribute("class","row");
    div.setAttribute("id","cont_answers-"+currentID);

        // Multiple Choice
    mcDiv.setAttribute("id", "mc-"+currentID);

    mcInner.setAttribute("class", "d-flex flex-row justify-content-center");

            // Opt 1
    opt1Div.setAttribute("class", "btn btn-outline-palette3 m-2 p-4");
    
    rad1.setAttribute("type", "radio");
    rad1.setAttribute("name", "question"+currentID+"-option");

    txtIn1.setAttribute("type", "text");
    txtIn1.setAttribute("placeholder", "Option 1");
    txtIn1.setAttribute("style", "border:none; border-radius:16px");
            //

            // Opt 2
    opt2Div.setAttribute("class", "btn btn-outline-palette3 m-2 p-4");
    
    rad2.setAttribute("type", "radio");
    rad2.setAttribute("name", "question"+currentID+"-option");

    txtIn2.setAttribute("type", "text");
    txtIn2.setAttribute("placeholder", "Option 2");
    txtIn2.setAttribute("style", "border:none; border-radius:16px");
            //

            // Opt 3
    opt3Div.setAttribute("class", "btn btn-outline-palette3 m-2 p-4");
    
    rad3.setAttribute("type", "radio");
    rad3.setAttribute("name", "question"+currentID+"-option");

    txtIn3.setAttribute("type", "text");
    txtIn3.setAttribute("placeholder", "Option 3");
    txtIn3.setAttribute("style", "border:none; border-radius:16px");
            //

            // Opt 4
    opt4Div.setAttribute("class", "btn btn-outline-palette3 m-2 p-4");
    
    rad4.setAttribute("type", "radio");
    rad4.setAttribute("name", "question"+currentID+"-option");

    txtIn4.setAttribute("type", "text");
    txtIn4.setAttribute("placeholder", "Option 4");
    txtIn4.setAttribute("style", "border:none; border-radius:16px");
            //

            // Appending
    opt1Div.appendChild(rad1);
    opt1Div.appendChild(txtIn1);

    opt2Div.appendChild(rad2);
    opt2Div.appendChild(txtIn2);

    opt3Div.appendChild(rad3);
    opt3Div.appendChild(txtIn3);

    opt4Div.appendChild(rad4);
    opt4Div.appendChild(txtIn4);

    mcInner.appendChild(opt1Div);
    mcInner.appendChild(opt2Div);
    mcInner.appendChild(opt3Div);
    mcInner.appendChild(opt4Div);

    mcDiv.appendChild(mcInner);
            //

        //

        // Identification
    identDiv.setAttribute("class", "row");
    identDiv.setAttribute("id", "ident-"+currentID);
    identDiv.setAttribute("style", "margin-left:0");

    identInner.setAttribute("class", "row d-flex flex-row justify-content-center");

    txtInIdent.setAttribute("type", "text");
    txtInIdent.setAttribute("class", "fill-blank p-3");
    txtInIdent.setAttribute("placeholder", "Correct Answer");

            // Append
    identInner.appendChild(txtInIdent);

    identDiv.appendChild(identInner);
            //
        //

        // True or False
    tofDiv.setAttribute("id", "tof-"+currentID);

    tofInner.setAttribute("class", "choice row d-flex flex-row justify-content-center");

    trueDiv.setAttribute("class", "btn btn-palette1 m-2 p-4");
    trueRad.setAttribute("type", "radio");
    trueRad.setAttribute("name", "question"+currentID+"-option");

    falseDiv.setAttribute("class", "btn btn-palette1 m-2 p-4");
    falseRad.setAttribute("type", "radio");
    falseRad.setAttribute("name", "question"+currentID+"-option");

            // Appending
    trueDiv.appendChild(trueRad);
    trueDiv.appendChild(document.createTextNode("TRUE"));

    falseDiv.appendChild(falseRad);
    falseDiv.appendChild(document.createTextNode("FALSE"));

    tofInner.appendChild(trueDiv);
    tofInner.appendChild(falseDiv);

    tofDiv.appendChild(tofInner);
            //


        //

    //

    // Appending

    div.appendChild(mcDiv);
    div.appendChild(identDiv);
    div.appendChild(tofDiv);
    //

    return div;
}
//

// Controls
function deleteQuestion() {

    // Targets
    var slide = document.querySelector(".nav-link.slideBtn.active");
    var question = document.querySelector(slide.getAttribute("data-bs-target"));
    //

    // Containers
    var cont_draggables = document.querySelector(".cont_draggables");
    var cont_questions = document.querySelector("#cont_questions");
    //

    // Removal
    cont_draggables.removeChild(slide.parentElement);
    cont_questions.removeChild(question);
    //

    // Assign New Active
    if (cont_draggables.firstChild != undefined) {
        var newSlideActive = cont_draggables.firstChild;
        newSlideActive.classList.add("active");

        var newSlideBtnActive = cont_draggables.firstChild.firstChild;
        newSlideBtnActive.classList.add("active");

        var newQuestionActive = newSlideActive.firstChild.getAttribute("data-bs-target");
        newQuestionActive = document.querySelector(newQuestionActive);
        newQuestionActive.classList.add("show"); newQuestionActive.classList.add("active");
    } else {
        // Create a new one
        var uniqueID = Date.now();

        var slide = createNewSlide();
        var slideBtn = createSlideButton("question-"+uniqueID, uniqueID);

        var question = createQuestion(uniqueID);

        // Append
        slide.appendChild(slideBtn);

        cont_draggables.appendChild(slide);
        cont_questions.appendChild(question);
        //

        slideBtn.classList.add("active");
        question.classList.add("show"); question.classList.add("active");

        toggleType("#qType-"+uniqueID, "#mc-"+uniqueID, "#ident-"+uniqueID, "#tof-"+uniqueID);

    }
    //

    getQuestionsCount();
    getDraggables();
}

function toggleType(selectEl, mcEl, identEl, tofEl) {
    selectEl = document.querySelector(selectEl);
    mcEl = document.querySelector(mcEl);
    identEl = document.querySelector(identEl);
    tofEl = document.querySelector(tofEl);

    mcEl.style.display = selectEl.value == "Multiple Choice" ? "block" : "none";
    identEl.style.display = selectEl.value == "Identification" ? "block" : "none";
    tofEl.style.display = selectEl.value == "True / False" ? "block" : "none";

    console.log(mcEl.style.display);
    console.log(identEl.style.display);
    console.log(tofEl.style.display);
}

function getQuestionsCount() {
    var questions = document.querySelectorAll(".draggable");

    document.querySelector("#assessmentInItems").max = questions.length;
}
//