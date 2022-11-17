function deleteSection(schoolID, sectID) {
    if (prompt("Are you sure you want to delete this school?\nType \"CONFIRM\" to delete","") == "CONFIRM") {
        var request = new XMLHttpRequest();

        request.open("POST", "AJAX/Principal/deleteSection.php");
        request.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

        request.onreadystatechange = function () {
            if (this.readyState === 4 && this.status === 200) {
                result = this.responseText;
                console.log(result);

                if (result == "true") {
                    console.log("delete complete");
                    document.querySelector("#cont_sections").innerHTML = "";
                    document.querySelector("#cont_modalsSection").innerHTML = "";
                    getSections();

                    getAvailableTeachersCreation(schoolID, "regInTeacherID"); // schoolID and targetElement

                    generateToast("delToast", "Notification", "Delete", "School "+sectID+" Successfully Deleted");
                } else {
                    generateToast("delToast", "Notification", "Delete", "Error: Failed to Delete School");
                }
            }
        };

        request.send("id="+sectID); // Sends schoolID to become a query tool in the php script
    }
}