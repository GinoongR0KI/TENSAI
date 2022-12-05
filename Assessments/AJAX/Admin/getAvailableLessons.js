function getAvailableLessons() {
    var request = new XMLHttpRequest();

    request.open("POST", "AJAX/Admin/getAvailableLessons.php");
    request.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

    request.onreadystatechange = function () {
        if (this.readyState === 4 && this.status === 200) {
            var result = this.response;
            console.log(result);

            // Containers
            var cont_options = document.querySelector("#regInLessonID");

            cont_options.innerHTML = "";
            //

            if (result != null && result != "" && result != "[]") {
                var lessons = JSON.parse(result);

                // Reset the Options
                var optNull = createOption("null", "Select A Lesson");
                optNull.selected = true;
                optNull.disabled = true;

                    // Append
                cont_options.appendChild(optNull);
                    //
                //

                for (i = 0; i < lessons.length; i++) {
                    // Create Options here
                        // Interpret
                    var title = lessons[i]['title'].split("|sepData|")[0];
                        //
                    var opt = createOption(lessons[i]['id'], title);
                    //

                    // Append
                    cont_options.appendChild(opt);
                    //
                }
            } else {
                generateToast("availError", "Notification", "Get", "Error: No Available Lessons Found");
            }
        }
    };

    request.send();
}

// Create Options

function createOption(value, text) {
    var opt = document.createElement("option");

    // Attributes
    opt.setAttribute("value",value);
    opt.innerText = text;
    //

    return opt;
}
//