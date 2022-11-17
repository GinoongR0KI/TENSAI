function getAssessments() {

    // Get Search
    var search = document.querySelector("#searchText");
    //

    var request = new XMLHttpRequest();

    request.open("POST", "AJAX/getAssessments.php");
    request.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

    request.onreadystatechange = function () {
        if (this.readyState === 4 && this.status === 200) {
            var result = this.response;
            console.log(result);

            // Containers
            var cont_assessments = document.querySelector("#cont_assessments");

            cont_assessments.innerHTML = "";
            //

            if (result != null && result != "" && result != "[]") {
                var assessments = JSON.parse(result);

                for (i = 0; i < assessments.length; i++) {
                    // Rows
                    var row = createRowAssessments();

                        // Special Initialization
                    var title = assessments[i]['title'].split("|sepData|")[1] != "" ? assessments[i]['title'].split("|sepData|")[1] : assessments[i]['title'].split("|sepData|")[0];
                    var lessonTitle = assessments[i]['lessonName'].split("|sepData|")[0];
                    var numItems = assessments[i]['questions'].split("|sepData|")[1] != "" ? assessments[i]['questions'].split("|sepData|")[1] : assessments[i]['questions'].split("|sepData|")[0]; // get the values of these data from a script that will return the questions in an assessment
                    var numQuestions = assessments[i]['numQuestions'];
                        //

                    var td_id = createData(assessments[i]['id']);
                    var td_title = createData(title);
                    var td_lesson = createData(lessonTitle);
                    var td_numItems = createData(numItems); // to be added
                    var td_numQuestions = createData(numQuestions); // to be added
                    var td_dateCreated = createData(assessments[i]['dateCreated']);
                    var td_dateUpdated = createData(assessments[i]['dateUpdated']);
                    var td_status = createData(assessments[i]['status']);
                    var td_actions = createDataActionsAssessment(assessments[i]['id'], "#modalDel-"+assessments[i]['id']);

                        // Append
                    appendRow(row, td_id, td_title, td_lesson, td_numItems, td_numQuestions, td_dateCreated, td_dateUpdated, td_status, td_actions);
                    
                        //

                    //

                    // Modals
                    var modalDel = createModal("modalDel-"+assessments[i]['id']);

                    var modalDialogDel = createModalDialog();
                    var modalContentDel = createModalContent();

                    var modalHeaderDel = createModalHeader("Delete");
                    var modalBodyDel = createModalBody();
                    var modalFooterDel = createModalFooterAssessment("deleteAssessment("+assessments[i]['id']+")");

                    var modalMessageDel = createModalMessage("Are you sure you want to delete \""+title+"\"?");

                        // Append
                    appendModal(modalDel, modalDialogDel, modalContentDel, modalHeaderDel, modalBodyDel, modalMessageDel, modalFooterDel);
                        //
                    //

                    cont_assessments.appendChild(row);
                    cont_modals.appendChild(modalDel);
                }
            } else {
                generateToast("searchError", "Notification", "Search", "Error: No Assessments Found");
            }
        }
    };

    request.send("search="+search.value);

}

// Appending
function appendRow(row, id, title, lesson, numItems, numQuestions, dateCreated, dateUpdated, status, actions) {
    // console.log(actions);
    row.appendChild(id);
    row.appendChild(title);
    row.appendChild(lesson);
    row.appendChild(numItems);
    row.appendChild(numQuestions);
    row.appendChild(dateCreated);
    row.appendChild(dateUpdated);
    row.appendChild(status);
    row.appendChild(actions);
}

function appendModal(modal, dialog, content, header, body, message, footer) {
    body.appendChild(message);

    content.appendChild(header);
    content.appendChild(body);
    content.appendChild(footer);

    dialog.appendChild(content);

    modal.appendChild(dialog);
}
//