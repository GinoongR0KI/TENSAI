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

                // Lesson Information
                var sepTitle = lessonData[0]['title'].split("|sepData|");
                var sepDesc = lessonData[0]['description'].split("|sepData|");
                var sepContent = lessonData[0]['content'].split("|sepData|");
                
                if ((lessonData[0]['state'] == "Pending" || lessonData[0]['state'] == "Published/Pending") && document.getElementById("utype").value == "Principal") { // Needs a condition to check which user type is used
                    // Use Drafted Data if it's in Pending state to allow Principal to view the requested lesson to be able to decide to allow the publication
                    var title = sepTitle[1];
                    var desc = sepDesc[1];

                    document.querySelector("#txt_lessonTitle").innerText = title;
                    document.querySelector("#txt_lessonDesc").innerText = !desc ? "No Description Available." : desc;
                    //

                    // Slides
                    var sepPages = sepContent[1].split("|sepPage|");
                    console.log(sepPages.length);
                    //
                } else {
                    // Use Published Data if it's not in Pending state
                    var title = sepTitle[0];
                    var desc = sepDesc[0];

                    document.querySelector("#txt_lessonTitle").innerText = title;
                    document.querySelector("#txt_lessonDesc").innerText = !desc ? "No Description Available." : desc;
                    //

                    // Slides
                    var sepPages = sepContent[0].split("|sepPage|");
                    console.log(sepPages.length);
                    //
                }
                
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