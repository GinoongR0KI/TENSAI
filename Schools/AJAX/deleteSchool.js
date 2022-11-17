function deleteSchool(schoolID) {
    var notice = "Note: All of it's sections, lessons, assessments will be deleted, and its users unassigned.";
    if (prompt("Are you sure you want to delete this school?\n"+notice+"\nType \"CONFIRM\" to delete:","") == "CONFIRM") {
        // Perform an AJAX call here
        var request = new XMLHttpRequest();

        request.open("POST", "AJAX/deleteSchool.php");
        request.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

        request.onreadystatechange = function () {
            if (this.readyState === 4 && this.status === 200) {
                result = this.responseText;
                console.log(result);

                if (result == "true") {
                    console.log("delete complete");
                    document.querySelector("#cont_schools").innerHTML = "";
                    document.querySelector("#cont_modals").innerHTML = "";
                    getSchools();

                    getAvailablePrincipalsCreation("regInPrincipal");

                    // document.querySelector("#msgError").innerText = "Deleted school associated with '"+schoolID+"'.";

                    generateToast("delToast", "Notification", "Delete", "School "+schoolID+" Successfully Deleted");
                } else {
                    generateToast("delToast", "Notification", "Delete", "Error: Failed to Delete School");
                }
            }
        };

        request.send("schoolID="+schoolID); // Sends schoolID to become a query tool in the php script
        //
    }
}