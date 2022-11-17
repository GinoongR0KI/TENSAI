function getAvailableTeachers(schoolID, targetElement, value) {
    var request = new XMLHttpRequest();

    // Variables
    var schoolID = document.querySelector("#"+schoolID);
    var targetElement = document.querySelector("#"+targetElement);
    //

    request.open("POST", "AJAX/Principal/getAvailableTeachers.php");
    request.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

    request.onreadystatechange = function () {
        if (this.readyState === 4 && this.status === 200) {
            var results = this.response;
            console.log(results);

            

            if (results != "" && results != null) {
                var teachers = JSON.parse(results);

                // Reset the Selection
                targetElement.innerHTML = "";

                if (value != null && value != "null") {
                    var placeholder = createOption("null", null, true);
                    getTeacherNameEdit(value, placeholder); // name
                    targetElement.appendChild(placeholder);

                    var unassign = createOption("unassign", "Unassign", false);
                    targetElement.append(unassign);
                } else {
                    var placeholder = createOption("null", "Select Teacher", true);
                    targetElement.appendChild(placeholder);
                }
                //

                for (i = 0; i < teachers.length; i++) {
                    // We create the options here.
                    console.log(teachers);
                    var opt = createOption(teachers[i]['id'], teachers[i]['id']+" | "+teachers[i]['fname']+" "+teachers[i]['mname']+" "+teachers[i]['lname']);
                    targetElement.appendChild(opt);
                }
            }
        }
    };

    request.send("schoolID="+schoolID.value);
}

function getAvailableTeachersCreation(schoolID, targetElement) {
    var request = new XMLHttpRequest();

    // Variables
    // var schoolID = document.querySelector("#"+schoolID);
    var targetElement = document.querySelector("#"+targetElement);
    //

    request.open("POST", "AJAX/Principal/getAvailableTeachers.php");
    request.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

    request.onreadystatechange = function () {
        if (this.readyState === 4 && this.status === 200) {
            var results = this.response;
            console.log(results);

            

            if (results != "" && results != null) {
                // Reset the Selection
                targetElement.innerHTML = "";

                var placeholder = createOption("null", "Select Teacher", true);
                targetElement.appendChild(placeholder);
                //

                var teachers = JSON.parse(results);

                for (i = 0; i < teachers.length; i++) {
                    // We create the options here.
                    var tname = teachers[i]['fname']+" "+teachers[i]['mname']+" "+teachers[i]['lname'];
                    var opt = createOption(teachers[i]['id'], teachers[i]['id']+" | "+tname);
                    targetElement.appendChild(opt);
                }
            }
        }
    };

    request.send("schoolID="+schoolID);
}

function createOption(value, text, isDisabled) {
    var opt = document.createElement("option");
    opt.setAttribute("value", value);
    opt.innerText = text;
    if (isDisabled) {opt.disabled = true; opt.selected = true;}

    return opt;
}

// Displaying
function getTeacherName(id, targetElement) {
    var request = new XMLHttpRequest();

    request.open("POST", "AJAX/Principal/getTeacherName.php");
    request.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

    request.onreadystatechange = function () {
        if (this.readyState === 4 && this.status === 200) {
            var result = this.response;
            console.log(result);

            if (result != "") {
                targetElement.innerText = result;
            } else {
                targetElement.innerText = "Not Set";
            }
        }
    };

    request.send("teacherID="+id);
}

function getTeacherNameEdit(id, targetElement) {
    var request = new XMLHttpRequest();

    request.open("POST", "AJAX/Principal/getTeacherName.php");
    request.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

    request.onreadystatechange = function () {
        if (this.readyState === 4 && this.status === 200) {
            var result = this.response;
            console.log(result);

            if (result != "") {
                targetElement.innerText = id + " | " + result;
            } else {
                targetElement.innerText = "Not Set";
            }
        }
    };

    request.send("teacherID="+id);
}
//