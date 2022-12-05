function saveLesson(lessonID) {
    // We are going to take 3 arguments to the php server
    // 1 - Lesson Title
    // 2 - Lesson Description
    // 3 - All the pages

    // Vars
    lessonTitle = document.querySelector("#lessonInTitle");
    lessonDescription = document.querySelector("#lessonInDescription");

    if (lessonTitle.value == "" || lessonTitle.value == null) {generateToast("saveError", "Notification", "Save", "Please provide a title for this lesson"); return false;}

        // Pages
            // Getting all the information from the pages will be a little bit complicated.
    pages = document.querySelectorAll(".slideBtn"); // Gets all the slides button
    pageData = "";

    pages.forEach(element => {
        var el = element.getAttribute("data-bs-target");
        
        page = document.querySelector(el); // get the contenteditable element
        pageData += page.innerHTML + "|sepPage|"; // Gets all the information from one of the contenteditables and append them to the string
    });

            // Process pageData to be safely sent to the server
    var processPages = pageData.split("&"); // the ampersand will make the data sent buggy, so we have to remove it for our php query
    pageData = "";
    for (i = 0; i < processPages.length; i++) {
        if (i+1 >= processPages.length) {
            pageData += processPages[i];
        } else {
            pageData += processPages[i] + "|amp|";
        }
    }
        //
    //

    // Process
    var request = new XMLHttpRequest();

    request.open("POST", "AJAX/Admin/savePages.php");
    request.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

    request.onreadystatechange = function () {
        if (this.readyState === 4 && this.status === 200) {
            var result = this.response;
            console.log(result);

            if (result == "true" || result == true) {
                generateToast("saveError", "Notification", "Save", "Lesson Saved Successfully");
            } else {
                // generateToast("saveError", "Notification", "Save", "Error: Failed to Save Lesson");
                generateToast("saveError", "Notification", "Save", result);
            }
        }
    };

    request.send("lessonID="+lessonID+"&title="+lessonTitle.value+"&description="+lessonDescription.value+"&pageData="+pageData);
    //
}