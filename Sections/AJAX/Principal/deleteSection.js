function deleteSection(schoolID, sectID) {
    var request = new XMLHttpRequest();

    request.open("POST", "AJAX/Principal/deleteSection.php");
    request.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

    request.onreadystatechange = function () {
        if (this.readyState === 4 && this.status === 200) {
            result = this.responseText;
            console.log(result);

            if (result == "true") {
                getSections();

                getAvailableTeachersCreation(schoolID, "regInTeacherID"); // schoolID and targetElement

                generateToast("delToast", "Notification", "Delete", "Section with id of '"+sectID+"' is successfully deleted");
            } else {
                generateToast("delToast", "Notification", "Delete", "Error: Failed to Delete School");
            }
        }
    };

    request.send("id="+sectID); // Sends schoolID to become a query tool in the php script
}