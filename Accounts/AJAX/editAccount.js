function editAccount(email, uType, fname, mname, lname) {
    // Variables

    fname = document.querySelector("#"+fname).value;
    mname = document.querySelector("#"+mname).value;
    lname = document.querySelector("#"+lname).value;
    //

    var request = new XMLHttpRequest();

    request.open("POST", "AJAX/editAccount.php"); 
    request.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

    request.onreadystatechange = function () {
        if (this.readyState === 4 && this.status === 200) {
            var result = this.response;

            if (result == "true") {
                document.querySelector("#cont_accounts").innerHTML = "";
                document.querySelector("#cont_modals").innerHTML = "";
                getAccounts();

                generateToast("editToast", "Notification", "Edit", "Account Details Successfully Updated");
            } else {
                generateToast("editToast", "Notification", "Edit", "Error: Failed to Save Account Details");
            }
        }
    };

    request.send("email="+email+"&uType="+uType+"&fname="+fname+"&mname="+mname+"&lname="+lname);
}

function editAccountTeacher(email, uType, fname, mname, lname, profID, schoolID) {
    // Variables
    fname = document.querySelector("#"+fname).value;
    mname = document.querySelector("#"+mname).value;
    lname = document.querySelector("#"+lname).value;
    profID = document.querySelector("#"+profID).value;
    schoolID = document.querySelector("#"+schoolID).value;
    //

    var request = new XMLHttpRequest();

    request.open("POST", "AJAX/editAccount.php"); 
    request.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

    request.onreadystatechange = function() {
        if (this.readyState === 4 && this.status === 200) {
            var result = this.response;
            console.log(result);

            if (result == "true") {
                document.querySelector("#cont_accounts").innerHTML = "";
                document.querySelector("#cont_modals").innerHTML = "";
                getAccounts();

                generateToast("editToast", "Notification", "Edit", "Account Details Successfully Updated");
            } else {
                generateToast("editToast", "Notification", "Edit", "Error: Failed to Save Account Details");
            }
        }
    }

    request.send("email="+email+"&uType="+uType+"&fname="+fname+"&mname="+mname+"&lname="+lname+"&profID="+profID+"&schoolID="+schoolID);
}

function editAccountStudent(email, uType, fname, mname, lname, bday, sex, gfname, gmname, glname, gcontact, gemail) {
    // Variables
    fname = document.querySelector("#"+fname).value;
    mname = document.querySelector("#"+mname).value;
    lname = document.querySelector("#"+lname).value;
    bday = document.querySelector("#"+bday).value;
    sex = document.querySelector("#"+sex).value;
    gfname = document.querySelector("#"+gfname).value;
    gmname = document.querySelector("#"+gmname).value;
    glname = document.querySelector("#"+glname).value;
    gcontact = document.querySelector("#"+gcontact).value;
    gemail = document.querySelector("#"+gemail).value;
    //

    var request = new XMLHttpRequest();

    request.open("POST", "AJAX/editAccount.php"); 
    request.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

    request.onreadystatechange = function() {
        if (this.readyState === 4 && this.status === 200) {
            var result = this.response;

            if (result == "true") {
                document.querySelector("#cont_accounts").innerHTML = "";
                document.querySelector("#cont_modals").innerHTML = "";
                getAccounts();

                generateToast("editToast", "Notification", "Edit", "Account Details Successfully Updated");
            } else {
                generateToast("editToast", "Notification", "Edit", "Error: Failed to Save Account Details");
            }
        }
        
    }

    request.send("email="+email+"&uType="+uType+"&fname="+fname+"&mname="+mname+"&lname="+lname+"&bday="+bday+"&sex="+sex+"&gfname="+gfname+"&gmname="+gmname+"&glname="+glname+"&gcontact="+gcontact+"&gemail="+gemail);

}