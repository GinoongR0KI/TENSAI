function createSection() {

    var request = new XMLHttpRequest();

    request.open("POST", "AJAX/Principal/createSection.php");
    request.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

    // Get Form Data
    var schoolID = document.querySelector("#regInSchoolID");
    var sectionName = document.querySelector("#regInSectionName");
    var advisorID = document.querySelector("#regInTeacherID");

    if (sectionName.value == "" || sectionName.value == null) {
        generateToast("sectionError", "Notification", "Create", "Error: Enter a Section Name");
        return null;
    }

    if (advisorID.value == "null") {
        generateToast("sectionError", "Notification", "Create", "Error: Select an Advisor");
        return null;
    }
    //

    // Variables
    var cont_sections = document.querySelector("#cont_sections");
    var cont_modals = document.querySelector("#cont_modalsSection");
    //

    request.onreadystatechange = function () {
        if (this.readyState === 4 && this.status === 200) {
            var result = this.response;
            console.log(result);

            if (result == "true") {
                cont_sections.innerHTML = "";
                cont_modals.innerHTML = "";
                getSections();
                loadTeachers("regInTeacherID"); // This is from the manage page in-line script to retrieve all available teachers for section creation.

                generateToast("sectionError", "Notification", "Create", "Successfully Created Section");
            } else {
                generateToast("sectionError", "Notification", "Create", "Error: Failed to Create Section");
            }
        }
    };

    request.send("schoolID="+schoolID.value+"&sectionName="+sectionName.value+"&advisorID="+advisorID.value);
}