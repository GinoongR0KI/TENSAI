function getSections() {
    var request = new XMLHttpRequest();

    // Variables
    var search = document.querySelector("#searchSection");
    //

    request.open("POST", "AJAX/Principal/getSections.php"); // Open the targetted php file
    request.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

    request.onreadystatechange = function() {
        if (this.readyState === 4 && this.status === 200) {
            var results = this.response;
            console.log(results);

            // Containers
            var cont_sections = document.querySelector("#cont_sections");

                // Reset
            cont_sections.innerHTML = "";
                //
            //

            try {
                var sections = JSON.parse(results);
                console.log(sections);

                for (i = sections.length - 1; i >= 0; i--) {
                    // IDs
                    editSchoolID = "inEditSchoolID";
                    editSectionName = "inEditSectionName-"+sections[i]['id'];
                    editAdvisorID = "inEditAdvisorID-"+sections[i]['id'];
                    //

                    // Create Rows
                    var row = createRow();

                    var td_id = createData(sections[i]['id']);
                    var td_name = createData(sections[i]['sectionName']);
                    var td_students = createData(null); // put a script here to read how many students are assigned to the current section
                    var td_advisorID = createData(sections[i]['advisorID']);
                    var td_actions = addActions_Sections("#deleteSectionModal", "#editSectionModal", sections[i]['id'], sections[i]['schoolID'], sections[i]['sectionName'], sections[i]['advisorID']);

                        // Append
                    // appendRow(row, td_id, td_name, td_schoolID, td_students, td_advisorID);
                    appendRowSections(row, td_id, td_name, td_students, td_advisorID, td_actions);
                        //

                    //

                    // Append
                    cont_sections.appendChild(row);
                    // cont_modals.appendChild(modal);
                    //

                    getStudentCount(sections[i]['id'], td_students);
                    getTeacherName(sections[i]['advisorID'], td_advisorID);
                }
            } catch (e) {
                var txt = document.createTextNode("No Results Found");

                cont_sections.appendChild(txt);

                generateToast("searchError", "Notifications", "Search", "Error: No Results Found");
            }

        }
    };

    request.send("schoolID="+schoolID+"&search="+search.value);
}

// Append Stuff
function appendRowSections(row, id, name, students, advisor, actions) {
    row.appendChild(id);
    row.appendChild(name);
    // row.appendChild(school);
    row.appendChild(students);
    row.appendChild(advisor);
    row.appendChild(actions);
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

// Change Modal Values
function sections_edit(sectionID, schoolID, sectionName, advisorID) {
    var inID = document.getElementById("inEditSectionID");
    var inSchoolID = document.getElementById("inEditSchoolID");
    var inName = document.getElementById("inEditSectionName");
    var inAdvisor = document.getElementById("inEditAdvisorID");

    var editBtn = document.getElementById("editBtn");

    inID.value = sectionID;
    inSchoolID.value = schoolID;
    inName.value = sectionName;
    inAdvisor.value = advisorID;

    editBtn.setAttribute("onClick", "editSection("+schoolID+","+sectionID+",'inEditSectionName','inEditAdvisorID')");

    getAvailableTeachers("inEditSchoolID", "inEditAdvisorID", advisorID); // nasa for loop
    console.log(advisorID);
}

function sections_delete(sectionID, schoolID, sectionName) {
    var inID = document.getElementById("inEditSectionID");
    var txtName = document.getElementById("delSectionTxt");

    var delBtn = document.getElementById("delBtn");

    txtName.innerText = sectionName;

    delBtn.setAttribute("onClick", "deleteSection("+schoolID+", "+sectionID+")");
}

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