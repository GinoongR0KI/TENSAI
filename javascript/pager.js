function loadGenInfo() {
    // Vars
    window.$_GET = new URLSearchParams(location.search);
    var lessonID = $_GET.get('lessonID');
    //

    var request = new XMLHttpRequest();

    request.open("POST", "AJAX/Admin/getLessonGeneralInfo.php");
    request.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

    request.onreadystatechange = function () {
        if (this.readyState === 4 && this.status === 200) {
            var result = this.response;
            console.log(result);

            if (result != "" && result != null && result != "[]") {
                var lesson = JSON.parse(result);

                // Container
                var inTitle = document.querySelector("#lessonInTitle");
                var inDesc = document.querySelector("#lessonInDescription");
                //

                // Process Data
                var sepTitle = lesson[0]['title'].split("|sepData|");
                var title = sepTitle[1] != "" ? sepTitle[1] : sepTitle[0];
                var sepDesc = lesson[0]['description'].split("|sepData|");
                var desc = sepDesc[1] != "" ? sepDesc[1] : sepDesc[0];
                //


                // Assign
                inTitle.value = title;
                inDesc.value = desc;

                // document.querySelector("#lessonTitle").innerText = inTitle.value;
                //
            }
        }
    };

    request.send("lessonID="+lessonID);
}

function loadPages() {

    // Vars
    window.$_GET = new URLSearchParams(location.search);
    var lessonID = $_GET.get('lessonID');
    var uniqueID = Date.now() - 1000; // gets the current millisecond
        // containers
    var cont_slides = document.querySelector(".cont_draggables");
    var cont_pages = document.querySelector("#cont_pageContents");
        //
    //

    var request = new XMLHttpRequest();

    request.open("POST", "AJAX/Admin/getPages.php");
    request.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

    request.onreadystatechange = function () {
        if (this.readyState === 4 && this.status === 200) {
            var result = this.response;
            console.log(result);

            // Reset
            cont_slides.innerHTML = "";
            cont_pages.innerHTML = "";
            //

            if (result != null && result != "" && result != "[]") {
                var lesson = JSON.parse(result);

                var raw_pages = lesson[0]['content'];
                var drafts = raw_pages.split("|sepData|");
                drafts = drafts[1] != "" ? drafts[1] : drafts[0]; // get the data of either the draft or the published one if there is a case that it has no drafted data yet.

                var pages = drafts.split("|sepPage|"); // separate the data to form pages

                if (pages.length == 1) {
                    var curPageID = (uniqueID);

                    // Slides
                    var slide = createNewSlide();
                    slide.classList.add("active");
                    var slideBtn = createSlideButton("page-"+curPageID, curPageID);
                    slideBtn.classList.add("active");

                        // Append
                    slide.appendChild(slideBtn);
                        //
                    //

                    // Pages
                    var page = createNewPage(curPageID);
                    page.classList.add("show"); page.classList.add("active");
                    page.innerHTML = pages[0];
                    //

                    cont_slides.appendChild(slide);
                    cont_pages.appendChild(page);
                } else {
                    for (i = 0; i < pages.length-1; i++) {
                        var curPageID = (uniqueID + i);
    
                        // Slides
                        var slide = createNewSlide();
                        if (i == 0) {slide.classList.add("active");}
                        var slideBtn = createSlideButton("page-"+curPageID, curPageID);
                        if (i == 0) {slideBtn.classList.add("active");}
    
                            // Append
                        slide.appendChild(slideBtn);
                            //
                        //
    
                        // Pages
                        var page = createNewPage(curPageID);
                        if (i == 0) {page.classList.add("show"); page.classList.add("active");}
                        page.innerHTML = pages[i];
                        //
    
                        cont_slides.appendChild(slide);
                        cont_pages.appendChild(page);
                    }
                }

                getDraggables(); // This activates our slides to become draggable
            }
        }
    };

    request.send("lessonID="+lessonID);
}

function addPage() {
    // Containers
    var cont_slides = document.querySelector(".cont_draggables");
    var cont_pages = document.querySelector("#cont_pageContents");
    //

    // Vars
    var uniqueID = Date.now();
    //

    var slide = createNewSlide();
    var slideBtn = createSlideButton("page-"+uniqueID, uniqueID);

    var page = createNewPage(uniqueID);

    // Append
    slide.appendChild(slideBtn);

    cont_slides.appendChild(slide);
    cont_pages.appendChild(page);

    getDraggables(); // Adds the new slide to the Draggables list (update)


    //
}

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

function createNewPage(pageID) {
    var div = document.createElement("div");

    // Attributes
    div.setAttribute("class","tab-pane fade");
    div.setAttribute("id", "page-"+pageID);
    div.setAttribute("aria-labelledby","page"+pageID+"-tab");
    div.setAttribute("role","tabpanel");
    div.setAttribute("contenteditable","true");
    div.setAttribute("style","border: 0.1rem #053742 solid; min-height: 50vh;");
    //

    return div;
}