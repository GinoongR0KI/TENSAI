function loadLesson() {
    // Get Data
    window.$_GET = new URLSearchParams(location.search);
    var lessonID = $_GET.get("lessonID");
    //

    var request = new XMLHttpRequest();

    request.open("POST", "AJAX/Students/getLesson.php");
    request.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

    request.onreadystatechange = function () {
        if (this.readyState === 4 && this.status === 200) {
            var result = this.response;
            console.log(result);

            // Containers
            var cont_nav = document.querySelector("#cont_nav");
            var cont_slides = document.querySelector("#cont_slides");

            cont_nav.innerHTML = "";
            cont_slides.innerHTML = "";
            //

            if (result != "" && result != "[]" && result != null) {
                var lessonData = JSON.parse(result);

                var uniqueID = Date.now() - 1000;
                
                // Display Lesson Title
                var sepTitle = lessonData[0]['title'].split("|sepData|");
                var title = sepTitle[0];
                document.querySelector("#txt_lessonTitle").innerText = title;
                //

                // Slides
                var sepContent = lessonData[0]['content'].split("|sepData|");
                var sepPages = sepContent[0].split("|sepPage|");
                console.log(sepPages.length);
                //
                
                for (i = 0; i < sepPages.length-1; i++) {
                    var page = sepPages[i];

                    var nav = createNavSlide(uniqueID+i, i+1);
                    var slide = createSlide(page);

                    // Append
                    cont_nav.appendChild(nav);
                    cont_slides.appendChild(slide);
                    //
                }
                //

                showSlide(0);
                // generateToast("loadError", "Notification", "Load", result);
            } else {
                generateToast("loadError", "Notification", "Load", "Error: Can't load lesson");
            }
        }
    };

    request.send("lessonID="+lessonID);
}

// Slides Creation
function createSlide(content) {
    var div = document.createElement("div");

    // Attribute
    div.setAttribute("class", "slide");
    div.setAttribute("style", "display:none;");
    div.innerHTML = content;

    //

    return div;
}

function createNavSlide(uniqueID, pageNum) {
    var li = document.createElement("li");
    var btn = document.createElement("button");

    // Attribute
    li.setAttribute("class", "nav-item");

    btn.setAttribute("class", "nav-link");
    btn.setAttribute("id", "btn-"+uniqueID);
    btn.setAttribute("type", "button");
    btn.setAttribute("role", "tab");
    btn.setAttribute("aria-controls", "home");
    btn.setAttribute("aria-selected", "true");
    btn.setAttribute("onClick", "showSlide("+(pageNum-1)+")");
    btn.setAttribute("style", "width:100%");
    btn.innerHTML = '<i class="bi bi-card-text test1"> Page '+pageNum+'</script></i>';
    //

    // Appending
    li.appendChild(btn);
    //

    return li;
}
//