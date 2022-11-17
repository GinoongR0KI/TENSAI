function getSections() {
    var request = new XMLHttpRequest();

    // Variables
    var search = document.querySelector("#searchSection");
    //

    request.open("POST", "AJAX/Principal/getSections.php"); // Open the targetted php file
    request.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

    request.onreadystatechange = function() {
        if (this.readyState === 4 && this.status === 200) {
            var results = this.responseText;
            console.log(results);

            // Containers
            var cont_sections = document.querySelector("#cont_sections");
            var cont_modals = document.querySelector("#cont_modalsSection");

                // Reset
            cont_sections.innerHTML = "";
            cont_modals.innerHTML = "";
                //
            //

            if (results != null && results != "") {
                var sections = JSON.parse(results);
                console.log(sections);

                for (i = sections.length - 1; i >= 0; i--) {
                    // IDs
                    editSchoolID = "inEditSchoolID-"+sections[i]['id'];
                    editSectionName = "inEditSectionName-"+sections[i]['id'];
                    editAdvisorID = "inEditAdvisorID-"+sections[i]['id'];
                    //

                    // Create Rows
                    var row = createRow("#section-"+sections[i]['id']+"-modal");

                    var td_id = createData(sections[i]['id']);
                    var td_name = createData(sections[i]['sectionName']);
                    // var td_schoolID = createData(sections[i]['schoolID']);
                    var td_students = createData(null); // put a script here to read how many students are assigned to the current section
                    var td_advisorID = createData(sections[i]['advisorID']);

                        // Append
                    // appendRow(row, td_id, td_name, td_schoolID, td_students, td_advisorID);
                    appendRowSections(row, td_id, td_name, td_students, td_advisorID);
                        //

                    //

                    // Create Modals
                    var modal = createModal("section-"+sections[i]['id']+"-modal");

                    var modalDialog = createModalDialog();
                    var modalContent = createModalContent();

                    var modalHeader = createModalHeader("Edit Section");
                    var modalBody = createModalBody();
                    
                    var modalFooter = createModalFooterSection(sections[i]['id'], sections[i]['schoolID'], editSectionName, editAdvisorID);

                        // Append
                    appendModalSections(modal, modalDialog, modalContent, modalHeader, modalBody, modalFooter);
                        //

                    //

                    // Create Editable Inputs for Modals
                    var formEditSchoolID = createFormFloatingInput("School ID", sections[i]['schoolID'], "text", editSchoolID, "schoolID", "xxxxxx", true);
                    var formEditSectionName = createFormFloatingInput("Section Name", sections[i]['sectionName'], "text", editSectionName, "sectionName", "Section Name");
                    var formEditAdvisorID = createFormFloatingSelect("Advisor", "null", editAdvisorID, "advisorID", "Select Teacher", "null");

                        // Append
                    appendEditablesSections(modalBody, formEditSchoolID, formEditSectionName, formEditAdvisorID);
                        //
                    //

                    // Append
                    cont_sections.appendChild(row);
                    cont_modals.appendChild(modal);
                    //

                    getStudentCount(sections[i]['id'], td_students);
                    getTeacherName(sections[i]['advisorID'], td_advisorID);
                    getAvailableTeachers(editSchoolID, editAdvisorID, sections[i]['advisorID']); // nasa for loop
                }

            } else {
                generateToast("searchError", "Notifications", "Search", "Error: No Results Found");
            }

        }
    };

    request.send("schoolID="+schoolID+"&search="+search.value);
}

// Append Stuff
function appendRowSections(row, id, name, students, advisor) {
    row.appendChild(id);
    row.appendChild(name);
    // row.appendChild(school);
    row.appendChild(students);
    row.appendChild(advisor);
}

function appendEditablesSections(modalBody, schoolID, sectionName, advisorID) {
    modalBody.appendChild(schoolID);
    modalBody.appendChild(sectionName);
    modalBody.appendChild(advisorID);
}

function appendModalSections(modal, dialog, content, header, body, footer) {
    content.appendChild(header);
    content.appendChild(body);
    content.appendChild(footer);

    dialog.appendChild(content);

    modal.appendChild(dialog);
}
//

// Data
function getStudentCount(sectionID, targetElement) {
    var request = new XMLHttpRequest();

    request.open("POST", "AJAX/Principal/getStudentCount.php");
    request.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

    request.onreadystatechange = function () {
        if (this.readyState === 4 && this.status === 200) {
            var result = this.response;
            console.log(result);

            if (result != "") {
                targetElement.innerText = result;
            } else {
                targetElement.innerText = 0;
            }
        }
    };

    request.send("sectionID="+sectionID);
}
//