function deleteLesson(lessonID) {
    // Datas
    
    //

    var request = new XMLHttpRequest();

    request.open("POST", "AJAX/Admin/deleteLesson.php");
    request.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

    request.onreadystatechange = function () {
        if (this.readyState === 4 && this.status === 200) {
            var result = this.response;
            console.log(result);

            if (result == "true") {
                getLessons();

                generateToast("delError", "Notification", "Delete", "Successfully Deleted Lesson");
            } else {
                generateToast("delError", "Notification", "Delete", "Error: Failed to Delete Lesson");
            }
        }
    };

    request.send("lessonID="+lessonID);
}