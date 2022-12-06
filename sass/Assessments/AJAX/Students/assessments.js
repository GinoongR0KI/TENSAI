function loadAssessments() {
    var request = new XMLHttpRequest();

    request.open("POST", "AJAX/Students/getAssessments.php");
    request.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

    request.onreadystatechange = function () {
        if (this.readyState === 4 && this.status === 200) {
            var result = this.response;
            console.log(result);

            // Containers
            var cont_assessments = document.querySelector("#cont_assessments");

            cont_assessments.innerHTML = "";
            //

            if (result != null && result != "" && result != "[]") {

                // Generate content here
                var content = JSON.parse(result);

                for (i = 0; i < content.length; i++) {
                    // Vars
                    var assessmentID = content[i]['id'];
                    var title = content[i]['title'];
                    var numQuestions = content[i]['questions'];

                        // Process
                    var sepTitle = title.split("|sepData|");
                    title = sepTitle[0];

                    var sepNumQuestions = numQuestions.split("|sepData|");
                    numQuestions = sepNumQuestions[0];
                        //
                    //

                    // Cards
                    var card = createCard();

                    var cardImg = createCardImg();

                    var cardBody = createCardBody();
                    var cardFooter = createCardFooter();

                    var cardTitle = createCardTitle(title);
                    var cardDesc = createCardDesc(numQuestions);
                    var cardView = createCardView(assessmentID);

                        // Append
                    appendCard(card, cardImg, cardBody, cardTitle, cardDesc, cardFooter, cardView);
                        //
                    //

                    cont_assessments.appendChild(card);
                }

            } else {
                generateToast("error", "Notification", "Display", "There are no Assessments found");
            }
        }
    };

    request.send();
}

// Appending
function appendCard(card, img, body, title, desc, footer, view) {
    footer.appendChild(view);

    body.appendChild(title);
    body.appendChild(desc);

    card.appendChild(img);
    card.appendChild(body);
    card.appendChild(footer);
}
//

// Card Creator

function createCard() {
    var card = document.createElement("div");

    // Attribute
    card.setAttribute("class", "assessment-card m-3");
    //

    return card;
}

function createCardImg() {
    var div = document.createElement("div");
    var img = document.createElement("img");

    // Attribute
    div.setAttribute("class","assess-thumbnail d-flex justify-content-center");
    img.setAttribute("src", "../mat_icons/assess.png");
    //

    // Append
    div.appendChild(img);

    return div;
}

function createCardBody() {
    var div = document.createElement("div");

    // Attribute
    div.setAttribute("class", "assess-body");
    //

    return div;
}

function createCardTitle(title) {
    var div = document.createElement("div");
    var txt = document.createElement("h4");

    // Attribute
    div.setAttribute("class", "assess-title");
    txt.innerText = title;
    //

    return txt;
}

function createCardDesc(desc) {
    var txt = document.createElement("p");

    // Attribute
    txt.setAttribute("class", "card-text");
    txt.innerText = "Number of Items: " + desc;
    //

    return txt;
}

function createCardFooter() {
    var div = document.createElement("div");

    // Set Attributes
    div.setAttribute("class", "assess-footer d-flex flex-row");
    // Append
    
    // Return
    return div;
}

function createCardButton() {
    
}

function createCardView(assessID) {
    var btn = document.createElement("a");
    var btnInner = document.createElement("button");

    var btnCont = document.createElement("div");

    var studID = document.querySelector("#cont_studID");
    console.log(studID);

    // Attribute
    btnCont.setAttribute("class","assess-button");
    btn.setAttribute("href","quiz.php?assessID="+assessID+"&studentID="+studID.value);
    // btn.setAttribute("onClick", "console.log('Test')");
    btnInner.innerText = "TAKE ASSESSMENT";
    //

    // Append
    btn.appendChild(btnInner);
    btnCont.appendChild(btn);
    //

    return btnCont;
}
//