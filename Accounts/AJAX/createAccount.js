function createAccount() {
    // Variabless
    var request = new XMLHttpRequest();

        // Form Data
    var email = document.querySelector("#regInEmail");
    var roles = document.querySelector("#regInRoles");
    var schoolID = document.querySelector("#regInSchool");

    if (email.value == null || email.value == "") {
        generateToast("regError", "Notification", "Create", "Error: Please enter an email");
        return null;
    } else {
        if (!email.checkValidity()) {
            generateToast("regError", "Notification", "Create", "Error: Please enter a valid email");
            return null;
        }
    }

    if (roles.value == null || roles.value == "null") {
        generateToast("regError", "Notification", "Create", "Error: Please select a role");
        return null;
    }

    if (schoolID.value == null || schoolID.value == "null") {
        generateToast("regError", "Notification", "Create", "Error: Please select a school");
        return null;
    }
    console.log(schoolID.value);
        //
        
    //

    // Error Message
    document.querySelector("#regErrorModal").innerHTML = "Processing...";
    //

    request.open("POST", "AJAX/createAccount.php");
    request.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

    request.onreadystatechange = function () {
        if (this.readyState === 4 && this.status === 200) {
            var result = this.responseText;
            console.log(result);

            if (result == "true") {
                // document.querySelector("#regError").innerHTML = "Account Created!";
                document.querySelector("#cont_accounts").innerHTML = "";
                getAccounts();

                if (schoolID != null) {
                    schoolID.innerHTML = "";
                    getAvailableSchools();
                }

                document.querySelector("#regErrorModal").innerHTML = "";
                generateToast("regError", "Notification", "Create", "Account Successfully Created");
            } else {
                document.querySelector("#regErrorModal").innerHTML = "";
                generateToast("regError", "Notification", "Create", "Error: Failed to Create Account!");
                // document.querySelector("#regError").innerHTML = "Error: Failed to Create Account!";
            }
        }
    };

    if (schoolID != null && schoolID != undefined) {
        if (schoolID.value != "null" && schoolID.value != null) {
            request.send("regInEmail="+email.value+"&regInRoles="+roles.value+"&regInSchoolID="+schoolID.value);
        } else {
            request.send("regInEmail="+email.value+"&regInRoles="+roles.value);    
        }
    } else {
        request.send("regInEmail="+email.value+"&regInRoles="+roles.value);
    }
    
}

// Displaying error message
function regFormDefault() {
    document.querySelector("#regError").innerHTML = "";
}