function deleteAssessment(assessmentID) {
    var request = new XMLHttpRequest();

    request.open("POST", "AJAX/Admin/deleteAssessment.php");
    request.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

    request.onreadystatechange = function () {
        if (this.readyState === 4 && this.status === 200) {
            var result = this.response;
            console.log(result);

            if (result == true || result == "true") {
                // reload dashboard
                getAssessments();
                //

                generateToast("delError", "Notification", "Delete", "Assessment Deleted Successfully");
            } else {
                generateToast("delError", "Notification", "Delete", "Assessment Deleted Successfully");
            }
        }
    };

    request.send("assessmentID="+assessmentID);
}