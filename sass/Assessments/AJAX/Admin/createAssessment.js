function createAssessment() {
    // datas
    var title = document.querySelector("#regInTitle").value;
    var lessonID = document.querySelector("#regInLessonID").value;

    if (title == "" || title == null) {generateToast("createError", "Notification", "Create", "Please Enter a Title");return false;}
    if (lessonID == "null" || lessonID == "" || lessonID == null) {generateToast("createError", "Notification", "Create", "Please Choose a Lesson");return false;}
    //

    var request = new XMLHttpRequest();

    request.open("POST", "AJAX/Admin/createAssessment.php");
    request.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

    request.onreadystatechange = function () {
        if (this.readyState === 4 && this.status === 200) {
            var result = this.response;
            console.log(result);

            if (result == "true") {
                // Reload the assessment results
                getAssessments();
                //
                
                generateToast("createError", "Notification", "Create", "Successfully Created Assessment");
            } else {
                generateToast("createError", "Notification", "Create", "Error: Failed to create assessment");
            }
        }
    };

    request.send("title="+title+"&lessonID="+lessonID);

}