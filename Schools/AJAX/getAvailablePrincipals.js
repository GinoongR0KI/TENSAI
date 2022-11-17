function getAvailablePrincipals(targetElement, value) {
    var request = new XMLHttpRequest();

    //
    targetElement = document.querySelector("#"+targetElement);
    //

    request.open("POST", "AJAX/getAvailablePrincipals.php");
    request.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

    request.onreadystatechange = function () {
        if (this.readyState === 4 && this.status === 200) {
            var result = this.response;

            if (result != null && result != "") {
                var principals = JSON.parse(result);

                // Reset the selection
                targetElement.innerHTML = "";

                if (value != "null" && value != null) {
                    var placeholder = createOption("null", "Test", true);
                    getPrincipalName(value, placeholder);
                    targetElement.appendChild(placeholder);

                    var unassign = createOption("unassign", "Unassign", false);
                    targetElement.appendChild(unassign);
                } else {
                    var placeholder = createOption("null", "Select Principal", true);
                    targetElement.appendChild(placeholder);
                }
                //

                for (i = 0; i < principals.length; i++) {
                    var opt = createOption(principals[i]['id'], principals[i]['fname'] + " " + principals[i]['mname'] + " " + principals[i]['lname']);
                    console.log("Looped");

                    targetElement.appendChild(opt);
                }
            }
        }
    };

    request.send();
}

function getAvailablePrincipalsCreation(targetElement) {
    var request = new XMLHttpRequest();

    //
    targetElement = document.querySelector("#"+targetElement);
    //

    request.open("POST", "AJAX/getAvailablePrincipals.php");
    request.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

    request.onreadystatechange = function () {
        if (this.readyState === 4 && this.status === 200) {
            var result = this.response;

            if (result != null && result != "") {
                var principals = JSON.parse(result);

                // Reset the selection
                targetElement.innerHTML = "";

                
                var placeholder = createOption("null", "Select Principal", true);
                targetElement.appendChild(placeholder);
                //

                for (i = 0; i < principals.length; i++) {
                    var opt = createOption(principals[i]['id'], principals[i]['fname'] + " " + principals[i]['mname'] + " " + principals[i]['lname']);

                    targetElement.appendChild(opt);
                }
            }
        }
    };

    request.send();
}

function getPrincipalName(id, targetElement) {
    var request = new XMLHttpRequest();

    request.open("POST", "AJAX/getPrincipalName.php");
    request.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

    request.onreadystatechange = function () {
        if (this.readyState === 4 && this.status === 200) {
            var result = this.response;
            console.log(result);

            if (result != "") {
                targetElement.innerText = result;
            } else {
                targetElement.innerText = "Not Set";
            }
        }
    };

    request.send("principalID="+id);
}

function createOption(value, text, isDisabled) {
    var opt = document.createElement("option");
    opt.setAttribute("value", value);
    opt.innerText = text;
    if (isDisabled) {opt.disabled = true; opt.selected = true;}

    return opt;
}