function createLesson() {
    // datas
    var title = document.querySelector("#regInTitle");
    var desc = document.querySelector("#regInDesc");
    var teacherID = document.querySelector("#regInProfID");

    if (title.value == "") {generateToast("regError", "Notification", "Create", "Error: Please enter a Lesson Title"); return false;}

        // Process Data
    title = title.value + "|sepData|";
    desc = desc.value + "|sepData|";

    console.log(title + " " + desc);
        //

    //

    var request = new XMLHttpRequest();

    request.open("POST", "AJAX/Admin/createLesson.php");
    request.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

    request.onreadystatechange = function () {
        if (this.readyState === 4 && this.status === 200) {
            var result = this.response;
            console.log(result);

            if (result == "true") {
                // we need to recall the display command here
                getLessons();

                generateToast("regError", "Notification", "Create", "Successfully Created Lesson");
            } else {
                generateToast("regError", "Notification", "Create", "Error: Failed to Create Lesson");
            }
        }
    };

    request.send("title="+title+"&desc="+desc+"&teacherID="+teacherID.value);
}