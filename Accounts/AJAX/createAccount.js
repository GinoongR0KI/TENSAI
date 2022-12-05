function createAccount() {
    // Variabless
    var request = new XMLHttpRequest();

        // Form Data
    var email = document.querySelector("#regInEmail");
    var schoolID = document.querySelector("#regInSchool");

    if (!email.value) {
        generateToast("regError", "Notification", "Create", "Please enter an email");
        return null;
    } else {
        if (!email.checkValidity()) {
            generateToast("regError", "Notification", "Create", "Please enter a valid email");
            return null;
        }
    }

    if (!schoolID.value || schoolID.value == "null") {
        generateToast("regError", "Notification", "Create", "Please enter a school ID");
        return null;
    }
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
                    schoolID.innerHTML = ""; // Clears the list
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

    console.log(!schoolID ? "true" : "false");
    if (schoolID != null && schoolID != undefined) {
        if (schoolID.value != "null" && schoolID.value != null) {
            request.send("regInEmail="+email.value+"&regInSchoolID="+schoolID.value);
            console.log("Email with School");
        } else {
            request.send("regInEmail="+email.value);
            console.log("Email only");
        }
    } else {
        request.send("regInEmail="+email.value);
        console.log("Email only with school not exist");
    }
    
}

// Displaying error message
function regFormDefault() {
    document.querySelector("#regError").innerHTML = "";
}