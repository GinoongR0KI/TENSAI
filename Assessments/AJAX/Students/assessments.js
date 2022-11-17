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

                    var cardTitle = createCardTitle(title);
                    var cardDesc = createCardDesc(numQuestions);
                    var cardView = createCardView(assessmentID);

                        // Append
                    appendCard(card, cardImg, cardBody, cardTitle, cardDesc, cardView);
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
function appendCard(card, img, body, title, desc, view) {
    body.appendChild(title);
    body.appendChild(desc);
    body.appendChild(view);

    card.appendChild(img);
    card.appendChild(body);
}
//

// Card Creator

function createCard() {
    var card = document.createElement("div");

    // Attribute
    card.setAttribute("class", "card border-palette3 bg-transparent");
    card.setAttribute("style", "width: 15rem;");
    //

    return card;
}

function createCardImg() {
    var img = document.createElement("img");

    // Attribute
    img.setAttribute("class", "card-img-top");
    img.setAttribute("src", "../src/s2.jpg");
    //

    return img;
}

function createCardBody() {
    var div = document.createElement("div");

    // Attribute
    div.setAttribute("class", "card-body");
    div.setAttribute("style", "background-color:RGBA(5, 55, 66, 0.8)");
    //

    return div;
}

function createCardTitle(title) {
    var txt = document.createElement("h5");

    // Attribute
    txt.setAttribute("class", "card-title");
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

function createCardView(assessID) {
    var btn = document.createElement("a");
    var studID = document.querySelector("#cont_studID");
    console.log(studID);

    // Attribute
    btn.setAttribute("class","btn btn-palette3");
    btn.setAttribute("href","viewer.php?assessID="+assessID+"&studentID="+studID.value);
    btn.setAttribute("onClick", "console.log('Test')");
    btn.innerText = "TAKE ASSESSMENT";
    //

    return btn;
}
//