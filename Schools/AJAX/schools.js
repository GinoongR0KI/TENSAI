function getSchools() {
    var request = new XMLHttpRequest();

    // Search
    var search = document.querySelector("#searchText");
    //

    request.open("POST", "AJAX/getSchools.php"); // Open the file that we want to execute asynchronously
    request.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

    request.onreadystatechange = function () {
        if (this.readyState === 4 && this.status === 200) {
            var results = this.response;
            console.log(results);

            // Containers
            var cont_schools = document.querySelector("#cont_schools");
            // var cont_modals = document.querySelector("#cont_modals");

            cont_schools.innerHTML = "";
            // cont_modals.innerHTML = "";
            //

            if (results != "") {
                var schools = JSON.parse(results);
                console.log(schools);

                for (i = schools.length-1; i >= 0; i--) {

                    // IDs
                    var editSchoolID = "inEditSchoolID-"+schools[i]['id'];
                    var editSchoolName = "inEditSchoolName-"+schools[i]['id'];
                    var editPrincipal = "inEditPrincipal";
                    var editMunicipality = "inEditMunicipality-"+schools[i]['id'];
                    //

                    // Create the Rows
                    var row = createRow("#school-"+schools[i]['id']+"-modal"); // create a row that will display the specified modal

                    var td_id = createData(schools[i]['id']);
                    var td_name = createData(schools[i]['schoolName']);
                    var td_municipality = createData(schools[i]['municipality']);
                    var td_principal = createData(schools[i]['principalID']);

                        // Special Assignments
                    var td_teachers = createData(schools[i]['teachers']); // This needs to be set using another ajax call that returns the number of teachers in the school
                    var td_sections = createData(schools[i]['sections']); // This needs to be set using another ajax call that returns the number of sections in the school
                    var td_actions = addActions_Schools("#deleteSchool", "#editSchool", schools[i]['id'], schools[i]['schoolName'], schools[i]['principalID'], schools[i]['municipality']);
                        //

                        // Append to Row
                    appendRow(row, td_id, td_name, td_municipality, td_principal, td_teachers, td_sections, td_actions);
                        //

                        // Append to School Container
                    cont_schools.appendChild(row);
                        //
                    //

                    // console.log(schools[i]['principalID']);
                    getPrincipalName(schools[i]['principalID'], td_principal); // Change principal id to principal name in table data
                    getAvailablePrincipals(editPrincipal, schools[i]['principalID']); // This is to set which available principals are there in the edit modal
                    //

                }
            } else {
                generateToast("searchError", "Notification", "Search", "Error: No Schools Found");
            }
        }
        
    };

    request.send("search="+search.value);
}

// Appending in one line
function appendRow(row, td_id, td_name, td_municipality, td_principal, td_teachers, td_sections, td_actions) {
    row.appendChild(td_id);
    row.appendChild(td_name);
    row.appendChild(td_municipality);
    row.appendChild(td_principal);
    row.appendChild(td_teachers);
    row.appendChild(td_sections);
    row.appendChild(td_actions);
}

function appendEditables(modalBody, id, name, principal, municipality) {

    modalBody.appendChild(id);
    modalBody.appendChild(name);
    modalBody.appendChild(principal);
    modalBody.appendChild(municipality);
}

function appendModal(modal, dialog, content, header, body, footer) {
    content.appendChild(header);
    content.appendChild(body);
    content.appendChild(footer);

    dialog.appendChild(content);

    modal.appendChild(dialog);
}
//

// Modal Functionalities

// Changing Modal Values
function school_delete(schoolID) {
    var btn = document.querySelector("#delBtn");
    btn.setAttribute("onCLick", "deleteSchool("+schoolID+")");
}

function school_edit(schoolID, schoolName, principal, municipality) {
    var inOrigID = document.getElementById("inOrigID");
    var inID = document.getElementById("inEditSchoolID");
    var inName = document.getElementById("inEditSchoolName");
    var inPrincipal = document.getElementById("inEditPrincipal");
    var inMunicipality = document.getElementById("inEditMunicipality");

    inOrigID.value = schoolID;
    inID.value = schoolID;
    inName.value = schoolName;
    inPrincipal.value = principal;
    inMunicipality.value = municipality;

    getAvailablePrincipals("inEditPrincipal", principal);
}