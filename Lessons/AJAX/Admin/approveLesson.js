function approveLesson(lessonID) {
    var request = new XMLHttpRequest();

    request.open("POST", "AJAX/Admin/approvePages.php");
    request.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

    request.onreadystatechange = function () {
        if (this.readyState === 4 && this.status === 200) {
            var result = this.response;

            // Container
            cont_lessons = document.querySelector("#cont_lessons");
            cont_lessons.innerHTML = "";
            //

            if (result == "true") {
                getLessons();
                
                generateToast("approveSuccess", "Notification", "Search", "Lesson Successfully Approved");
            } else {
                generateToast("approveError", "Notification", "Search", "Error: Failed to Approve Lesson");
            }
        }
    };

    request.send("lessonID="+lessonID);
}