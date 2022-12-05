function saveSelectionLesson() {
    // Get Data
    var lessonSelectors = document.querySelectorAll(".lessonSel");

    var strings = "";

    lessonSelectors.forEach(e => {
        var el = e;
        strings += el.value + "," + el.checked + ".|.";
    });
    //

    var request = new XMLHttpRequest();

    request.open("POST", "AJAX/Teacher/assignLesson.php");
    request.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

    request.onreadystatechange = function () {
        if (this.readyState === 4 && this.status === 200) {
            var result = this.response;
            console.log(result);

            if (result == "true") {
                generateToast("assignError", "Notification", "Assign", "Successfully Assigned Lessons");
            } else {
                generateToast("assignError", "Notification", "Assign", "Error: Failed to Assign Lessons");
            }
        }
    };

    request.send("values="+strings);
}

function saveSelectionStudents() {

    // Get Data
    var studentSelectors = document.querySelectorAll(".studentSel");

    var strings = "";

    studentSelectors.forEach(e => {
        var el = e;
        strings += el.value + "," + el.checked + ".|.";
    });
    console.log(strings);

    //

    var request = new XMLHttpRequest();

    request.open("POST", "AJAX/Teacher/assignStudent.php");
    request.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

    request.onreadystatechange = function () {
        if (this.readyState === 4 && this.status === 200) {
            var result = this.response;
            console.log(result);

            if (result == "true") {
                generateToast("assignError", "Notification", "Assign", "Successfully Assigned Students");
            } else {
                generateToast("assignError", "Notification", "Assign", "Error: Failed to Assign Students");
            }
        }
    };

    // console.log(strings);
    request.send("values="+strings);
}

function toggleBtn(targetBtn, mode) {
    targetBtn = document.querySelector("#"+targetBtn);

    targetBtn.disabled = mode;
}