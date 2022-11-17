function deleteAccount(email) {
    if (confirm("Are you sure you want to delete this account?\nPress 'OK' to continue:","")) {
        console.log("Deleted");

        // Perform an AJAX call here
        var request = new XMLHttpRequest();

        request.open("POST", "AJAX/deleteAccount.php");
        request.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

        request.onreadystatechange = function () {
            if (this.readyState === 4 && this.status === 200) {
                result = this.responseText;
                console.log(result);

                if (result == "true") {
                    document.querySelector("#cont_accounts").innerHTML = "";
                    getAccounts();

                    if (document.querySelector("#regInSchool") != null) {
                        document.querySelector("#regInSchool").innerHTML = "";
                        getAvailableSchools();
                    }

                    generateToast("msgError", "Notification", "Delete", "Deleted account associated with '"+email+"'");
                    // document.querySelector("#msgError").innerText = "Deleted account associated with '"+email+"'.";
                } else {
                    generateToast("msgError", "Notification", "Delete", "Error: Failed to Delete Account");
                }
            }
        };

        request.send("email="+email);
        //

    } else {
        console.log("Safe");
    }
}

// function deleteAccount(id) {
//     if (prompt("Are you sure you want to delete this account?\nType \"CONFIRM\" to delete","") == "CONFIRM") {
//         console.log("Deleted");

//         var btn = document.querySelector(id);

//         console.log(btn);

//         console.log(btn.closest("form"));
//         btn.closest("form").submit();
//     }
// }