function deleteSchool(schoolID) {
    var request = new XMLHttpRequest();

    request.open("POST", "AJAX/deleteSchool.php");
    request.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

    request.onreadystatechange = function () {
        if (this.readyState === 4 && this.status === 200) {
            result = this.responseText;
            console.log(result);

            if (result == "true") {
                console.log("delete complete");
                getSchools();

                getAvailablePrincipalsCreation("regInPrincipal");

                generateToast("delToast", "Notification", "Delete", "School "+schoolID+" Successfully Deleted");
            } else {
                generateToast("delToast", "Notification", "Delete", "Error: Failed to Delete School");
            }
        }
    };

    request.send("schoolID="+schoolID); // Sends schoolID to become a query tool in the php script
}