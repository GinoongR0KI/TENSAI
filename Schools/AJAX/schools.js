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
            var cont_modals = document.querySelector("#cont_modals");

            cont_schools.innerHTML = "";
            cont_modals.innerHTML = "";
            //

            if (results != "") {
                var schools = JSON.parse(results);
                console.log(schools);

                for (i = schools.length-1; i >= 0; i--) {

                    // IDs
                    var editSchoolID = "inEditSchoolID-"+schools[i]['id'];
                    var editSchoolName = "inEditSchoolName-"+schools[i]['id'];
                    var editPrincipal = "inEditPrincipal-"+schools[i]['id']
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
                        //

                        // Append to Row
                    appendRow(row, td_id, td_name, td_municipality, td_principal, td_teachers, td_sections);
                        //

                        // Append to School Container
                    cont_schools.appendChild(row);
                        //
                    //

                    // Create the Modals
                    var modal = createModal("school-"+schools[i]['id']+"-modal");

                    var modalDialog = createModalDialog();
                    var modalContent = createModalContent();

                    var modalHeader = createModalHeader("Edit School");
                    var modalBody = createModalBody();

                    var modalFooter = createModalFooterSchool(schools[i]['id'], schools[i]['id'], editSchoolName, editPrincipal, editMunicipality);

                        // Append Modal
                    appendModal(modal, modalDialog, modalContent, modalHeader, modalBody, modalFooter);
                        //
                    //

                    // Create Editable Values for Modals
                    var formSchoolID = createFormFloatingInput("School ID", schools[i]['id'], "number", editSchoolID, "schoolID", "xxxxxx", false);
                    var formSchoolName = createFormFloatingInput("School Name", schools[i]['schoolName'], "text", editSchoolName, "schoolName", "School", false);
                    // var formPrincipal = createFormFloatingSelect("Assigned Principal", schools[i]['principalID'], "text", editPrincipal, "principalID", "xxxxxxx", false);
                    var formPrincipal = createFormFloatingSelect("Principal ID", schools[i]['principalID'], editPrincipal, "principalID", "Select Principal", null);
                    var formMunicipality = createFormFloatingSelect("Municipality", schools[i]['municipality'], editMunicipality, "municipality", "Select Municipality", "Abucay,Bagac,Balanga,Dinalupihan,Hermosa,Limay,Mariveles,Morong,Orani,Orion,Pilar,Samal");
                        // Append to Modal Body
                    appendEditables(modalBody, formSchoolID, formSchoolName, formPrincipal, formMunicipality);
                        //
                    
                    //

                    // Append to main container
                    cont_modals.appendChild(modal);

                    getPrincipalName(schools[i]['principalID'], td_principal);
                    getAvailablePrincipals(editPrincipal, schools[i]['principalID']);
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
function appendRow(row, td_id, td_name, td_municipality, td_principal, td_teachers, td_sections) {
    row.appendChild(td_id);
    row.appendChild(td_name);
    row.appendChild(td_municipality);
    row.appendChild(td_principal);
    row.appendChild(td_teachers);
    row.appendChild(td_sections);
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

