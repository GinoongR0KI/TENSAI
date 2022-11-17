function editSchool(origID, schoolID, schoolName, principal, municipality) {
    //
    var request = new XMLHttpRequest();
    //

    request.open("POST", "AJAX/editSchool.php"); 
    request.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

    // Get Data from Inputs
    schoolID = document.querySelector("#inEditSchoolID-"+schoolID).value;
    schoolName = document.querySelector("#"+schoolName).value;
    principal = document.querySelector("#"+principal).value;
    municipality = document.querySelector("#"+municipality).value;
    //

    request.onreadystatechange = function () {
        if (this.readyState === 4 && this.status === 200) {
            var result = this.responseText;
            console.log(result);

            if (result == "true") {
                document.querySelector("#cont_schools").innerHTML = "";
                document.querySelector("#cont_modals").innerHTML = "";
                getSchools();

                getAvailablePrincipalsCreation("regInPrincipal");

                generateToast("editToast", "Notification", "Edit", "School Successfully Updated");
            } else {
                generateToast("editToast", "Notification", "Edit", "Error: Failed to Save School Details");
            }
        }
    };

    request.send("schoolID="+schoolID+"&schoolName="+schoolName+"&principal="+principal+"&municipality="+municipality+"&origID="+origID); // sends the schoolID, name, principal, and municipality as tools for php query.
}