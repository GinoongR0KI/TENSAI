function editSection(schoolID, sectionID, sectionName, advisorID) {
    // Variables
    sectionName = document.querySelector("#"+sectionName);
    advisorID = document.querySelector("#"+advisorID);
    //

    var request = new XMLHttpRequest();

    request.open("POST", "AJAX/Principal/editSection.php");
    request.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

    request.onreadystatechange = function () {
        if (this.readyState === 4 && this.status === 200) {
            result = this.responseText;
            console.log(result);

            if (result == "true") {
                document.querySelector("#cont_sections").innerHTML = "";
                document.querySelector("#cont_modalsSection").innerHTML = "";
                getSections();
                getAvailableTeachersCreation(schoolID, "regInTeacherID"); // schoolID and targetElement
                // getAvailableTeachers(); We need a new script to display the available teachers for the section creation

                generateToast("editToast", "Notification", "Edit", "Section Successfully Updated");
            } else {
                generateToast("editToast", "Notification", "Edit", "Error: Failed to Update Section");
            }
        }
    };

    request.send("sectionID="+sectionID+"&sectionName="+sectionName.value+"&advisorID="+advisorID.value); // Sends schoolID to become a query tool in the php script
}