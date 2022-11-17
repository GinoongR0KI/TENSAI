function getLessons() {
    var request = new XMLHttpRequest();

    // Data
    var search = document.querySelector("#searchText");
    //

    request.open("POST", "AJAX/getLessons.php");
    request.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

    request.onreadystatechange = function () {
        if (this.readyState === 4 && this.status === 200) {
            var result = this.response;
            console.log(result);

            // Containers
            cont_lessons = document.querySelector("#cont_lessons");
            cont_modals = document.querySelector("#cont_modals");

            cont_lessons.innerHTML = "";
            cont_modals.innerHTML = "";
            //

            if (result != null && result != "" && result != "[]") {
                var lessons = JSON.parse(result);

                uID = document.querySelector("#hiddenUserID");
                

                for (i = 0; i < lessons.length; i++) {
                    // IDs
                
                    //

                    // Row
                    var row = createRowLessons();

                        // Process Data
                    var uType = document.querySelector("#hiddenUserType").value;

                    var lessonID = lessons[i]['id'];
                    var lessonTitle = lessons[i]['title'].split("|sepData|");
                    var lessonDesc = lessons[i]['description'].split("|sepData|");
                    var lessonDCreated = lessons[i]['dateCreated'];
                    var lessonDUpdated = lessons[i]['dateUpdated'];
                    var lessonStatus = lessons[i]['state'];

                    if (uType == "Teacher") {
                        lessonTitle = lessonTitle[1] != "" ? lessonTitle[1] : lessonTitle[0];
                        lessonDesc = lessonDesc[1] != "" ? lessonDesc[1] : lessonDesc[0];
                    } else {
                        lessonTitle = lessonTitle[0];
                        lessonDesc = lessonDesc[0];
                    }
                        //

                    var td_id = createData(lessonID);
                    var td_title = createData(lessonTitle);
                    var td_desc = createData(lessonDesc);
                    var td_dateCreated = createData(lessonDCreated);
                    var td_dateUpdated = createData(lessonDUpdated);
                    var td_status = createData(lessonStatus);
                    var td_actions = createDataActionsLesson(lessons[i]['id'], uID.value, lessons[i]['teacherID'], "#modalDel-"+lessons[i]['id']);

                        // Append Row
                    appendRow(row, td_id, td_title, td_desc, td_dateCreated, td_dateUpdated, td_status, td_actions);
                        //

                    //

                    // Modals
                        // Del
                    var modalDel = createModal("modalDel-"+lessons[i]['id']);
                    
                    var modalDialogDel = createModalDialog();
                    var modalContentDel = createModalContent();

                    var modalHeaderDel = createModalHeader("Delete");
                    var modalBodyDel = createModalBody();
                    var modalFooterDel = createModalFooterLesson("deleteLesson("+lessons[i]['id']+")", true); // needs an attrib of what to do onClick

                    var modalMessageDel = createModalMessage("Are you sure you want to delete \""+lessons[i]['title'].split("|sepData|")[0]+"\"?");

                            // Append
                    appendModal(modalDel, modalDialogDel, modalContentDel, modalHeaderDel, modalBodyDel, modalMessageDel, modalFooterDel);
                            //
                        //
                        
                        // Publish
                    var modalPub = createModal("modalPub-"+lessons[i]['id']);
                
                    var modalDialogPub = createModalDialog();
                    var modalContentPub = createModalContent();

                    var modalHeaderPub = createModalHeader("Publish");
                    var modalBodyPub = createModalBody();
                    var modalFooterPub = createModalFooterLesson("", false); // needs an attrib of what to do onClick

                    var modalMessagePub = createModalMessage("Are you sure you want to publish \""+lessons[i]['title']+"\"?");

                            // Append
                    appendModal(modalPub, modalDialogPub, modalContentPub, modalHeaderPub, modalBodyPub, modalMessagePub, modalFooterPub);
                            //

                        //
                        
                    //

                    cont_lessons.appendChild(row);
                    cont_modals.appendChild(modalDel);
                    cont_modals.appendChild(modalPub);
                }


            } else {
                generateToast("searchError", "Notifications", "Search", "Error: No Lessons Found");
            }
        }
    };

    request.send("search="+search.value);
}

// Append
function appendRow(row, id, title, desc, created, updated, status, actions) {
    row.appendChild(id);
    row.appendChild(title);
    row.appendChild(desc);
    row.appendChild(created);
    row.appendChild(updated);
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

function appendEditables() {

}
//