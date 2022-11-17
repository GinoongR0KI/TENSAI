function createSchool() {
    // Variables
    var request = new XMLHttpRequest();

        // Get Form Data
    var id = document.querySelector("#regInID").value;
    var name = document.querySelector("#regInName").value;
    var principal = document.querySelector("#regInPrincipal").value;
    var municipality = document.querySelector("#regInMunicipality").value;

    if (municipality == "null") {
        generateToast("createToast", "Notification", "Create", "Error: Please choose a Municipality");
        return null;
    }

        //
    //

    request.open("POST", "AJAX/createSchool.php");
    request.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

    request.onreadystatechange = function () {
        if (this.readyState === 4 && this.status === 200) {
            var result = this.responseText;
            console.log(result);

            if (result === "true") {
                document.querySelector("#cont_schools").innerHTML = "";
                getSchools();

                getAvailablePrincipalsCreation("regInPrincipal");

                generateToast("createToast", "Notification", "Create", "School Successfully Created");
            } else {
                generateToast("createToast", "Notification", "Create", "Error: Failed to Create School");
            }
        }
    };

    request.send("schoolID="+id+"&schoolName="+name+"&municipality="+municipality+"&principalID="+principal);


}