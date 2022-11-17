function getAvailableSchools() {
    var request = new XMLHttpRequest();

    request.open("POST", "AJAX/getAvailableSchools.php");
    request.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

    // Variables
    cont_teachers = document.querySelector("#regInSchool"); 
    //

    request.onreadystatechange = function () {
        if (this.readyState === 4 && this.status === 200) {
            var result = this.response;

            // Reset the selection
            cont_teachers.innerHTML = "";

            var placeholder = createOption("null", "Select School", true, true);
            var columns = createOption("null", "School ID: School Name", true);

            cont_teachers.appendChild(placeholder);
            cont_teachers.appendChild(columns);
            //

            if (result != "" && result != null) {

                var schools = JSON.parse(result);

                for (i = 0; i < schools.length; i++) {
                    var opt = createOption(schools[i]['id'], schools[i]['id'] + ": " + schools[i]['schoolName']);

                    cont_teachers.appendChild(opt);
                }
            }
        }
    };

    request.send();
}

function createOption(value, text, isDisabled, isSelected) {
    var opt = document.createElement("option");
    opt.setAttribute("value", value);
    opt.innerText = text;
    if (isDisabled) {opt.disabled = true;}
    if (isSelected) {opt.selected = true;}

    return opt;
}