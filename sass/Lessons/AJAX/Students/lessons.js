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

            try {
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
                    title = sepTitle[0];
                    console.log(title);

                    var sepDesc = desc.split("|sepData|");
                    desc = sepDesc[0];
                    //

                    // Cards
                    var card = createCard(title, desc, "viewer.php?lessonID="+lessonID);
                    
                    var cardImg = createCardImg();
                    

                    var cardTitle = createCardTitle(title);
                    

                        // Append
                    appendCard(card, cardImg, cardTitle);
                        //
                    //

                    cont_lessons.appendChild(card);
                }
            } catch(e) {
                // var txt = document.createTextNode("No Lessons Available");
                // cont_lessons.appendChild(txt);

                generateToast("loadError", "Notification", "Load", "Error: No Available Lessons");
            }
        }
    };

    request.send();
}

// Appenders
function appendCard(card, img, title) {
    card.appendChild(img);
    card.appendChild(title);
}
//

// Card Creation
function createCard(title, description, link) {
    var card = document.createElement("div");

    // Attribute
    card.setAttribute("class", "lesson-card d-flex flex-row m-3");
    //

    // Append
    card.addEventListener("click", function () {
        showDetails(title, description, link);
    });
    
    return card;
}

function createCardImg() {
    var div = document.createElement("div");
    var img = document.createElement("img");

    // Attribute
    div.setAttribute("class", "lesson-thumbnail");

    img.setAttribute("src", "../mat_icons/lesson.png");
    //

    // Append
    div.appendChild(img);

    return div;
}

function createCardTitle(title) {
    var div = document.createElement("div");
    var txt = document.createElement("h4");

    // Attribute
    div.setAttribute("class", "lesson-title");
    txt.innerText = title;
    //

    // Append
    div.appendChild(txt);

    return div;
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

function showDetails(title, description, link) {
    var ttl = document.querySelector("#lesson_title");
    var desc = document.querySelector("#lesson_desc");
    var btn = document.querySelector("#lesson_url");

    ttl.innerText = title;
    desc.innerText = !description ? "No Description Available" : description;
    btn.href = link;
    btn.childNodes[1].disabled = false;
    console.log(btn.childNodes);
}
//