function loadLessons() {
    // Get Data
    window.$_GET = new URLSearchParams(location.search);
    var lessonID = $_GET.get("lessonID");
    //

    var request = new XMLHttpRequest();

    request.open("POST", "AJAX/Students/getLessons.php");
    request.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

    request.onreadystatechange = function () {
        if (this.readyState === 4 && this.status === 200) {
            var result = this.response;
            console.log(result);

            // Containers
            var cont_lessons = document.querySelector("#cont_lessons");

            cont_lessons.innerHTML = "";
            //


            if (result != null && result != "" && result != "[]") {
                var lesson = JSON.parse(result);

                for (i = 0; i < lesson.length; i++) {
                    // Interpret the lesson data before putting it in display

                    // Vars
                    var lessonID = lesson[i]['id'];
                    var title = lesson[i]['title'];
                    var desc = lesson[i]['description'];
                    //
                    
                    // Process Data
                    var sepTitle = title.split("|sepData|");
                    console.log(sepTitle);
                    title = sepTitle[0];
                    console.log(title);

                    var sepDesc = desc.split("|sepData|");
                    desc = sepDesc[0];
                    //

                    // Cards
                    var card = createCard();
                    
                    var cardImg = createCardImg();
                    var cardBody = createCardBody();

                    var cardTitle = createCardTitle(title);
                    var cardDesc = createCardDesc(desc);
                    var cardBtn = createCardView(lessonID);

                        // Append
                    appendCard(card, cardImg, cardBody, cardTitle, cardDesc, cardBtn);
                        //
                    //

                    cont_lessons.appendChild(card);
                }

            } else {
                generateToast("loadError", "Notification", "Load", "Error: No Available Lessons");
            }
        }
    };

    request.send();
}

// Appenders
function appendCard(card, img, body, title, desc, btn) {
    body.appendChild(title);
    body.appendChild(desc);
    body.appendChild(btn);

    card.appendChild(img);
    card.appendChild(body);
}
//

// Card Creation
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
    img.setAttribute("src", "../src/s2.jpg");
    img.setAttribute("class", "card-img-top");
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
    txt.innerText = desc;
    //

    return txt;
}

function createCardView(lessonID) {
    var btn = document.createElement("a");

    // Attribute
    btn.setAttribute("class","btn btn-palette3");
    btn.setAttribute("href","viewer.php?lessonID="+lessonID);
    btn.innerText = "VIEW LESSON";
    //

    return btn;
}
//