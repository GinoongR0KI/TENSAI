// Obsolete
function getAccounts_Obs() {
    var request = new XMLHttpRequest();

    //
    var searchIn = document.querySelector("#searchText");
    // var filterAdmin = document.querySelector("#searchFilterAdmin");
    // var filterPrincipal = document.querySelector("#searchFilterPrincipal");
    // var filterTeacher = document.querySelector("#searchFilterTeacher");
    // var filterStudent = document.querySelector("#searchFilterStudent");
    //

    request.open("POST", "../Accounts/AJAX/getAccounts.php"); // Get the file we need to open
    request.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

    request.send("search="+searchIn.value); // This starts the communication to the server file

    request.onreadystatechange = function () {
        if (this.readyState === 4 && this.status === 200) {
            var results = this.response.split(".|."); // This returns what the file has outputted.
            console.log(results);

            cont_accounts = document.querySelector("#cont_accounts");
            cont_accounts.innerHTML = "";
            cont_modals = document.querySelector("#cont_modals");
            cont_modals.innerHTML = "";

            if (results[0] === "") {
                generateToast("getAccError", "Notification", "Get Account", "Error: No Results Found");
            } else {
                var accounts = JSON.parse(results[0]);

                for (i = accounts.length-1; i >= 0; i--) {
                    
                    // Initialization for account results
                    row = createRow("#acc-"+accounts[i]['id']+"-modal"); // main container

                    // Special Initialization
                        // Name
                    var fname = accounts[i]['fname'];
                    var mname = accounts[i]['mname'];
                    var lname = accounts[i]['lname'];

                    var fname = fname == null || fname == "" ? "Not Set" : fname;
                    var mname = mname == null || mname == "" ? "Not Set" : mname;
                    var lname = lname == null || lname == "" ? "Not Set" : lname;
                        //

                        // Activation Status
                    var isActivated = accounts[i]['isActivated'] == 1 ? "Active" : "Not Activated";
                        //
                    //

                    td_id = createData(accounts[i]["id"]);
                    td_fname = createData(fname);
                    td_mname = createData(mname);
                    td_lname = createData(lname);
                    td_email = createData(accounts[i]['email']);
                    td_uType = createData(accounts[i]['uType']);
                    td_dCreate = createData(accounts[i]['dateCreated']);

                        // special initialization for td_activated;
                    //

                    td_activated = createData(isActivated);

                    // Appending for account results

                    appendRow(row, td_id, td_fname, td_mname, td_lname, td_email, td_uType, td_dCreate, td_activated);

                    //

                    // Initialize Modal

                        // IDs
                    var editEmail = "inEditEmail-"+accounts[i]['id'];
                    var editFName = "inEditFName-"+accounts[i]['id'];
                    var editMName = "inEditMName-"+accounts[i]['id'];
                    var editLName = "inEditLName-"+accounts[i]['id'];
                        //

                    switch (accounts[i]['uType']) {
                        case "Student":
                            // IDs

                            var editBday = "inEditBday-"+accounts[i]['id'];
                            var editSex = "inEditSex-"+accounts[i]['id'];
                            var editGFName = "inEditGFName-"+accounts[i]['id'];
                            var editGMName = "inEditGMName-"+accounts[i]['id'];
                            var editGLName = "inEditGLName-"+accounts[i]['id'];
                            var editGContact = "inEditGContact-"+accounts[i]['id']
                            var editGEmail = "inEditGEmail-"+accounts[i]['id'];
                            //

                            // Front Modal
                            var modalF = createModal("acc-"+accounts[i]['id']+"-modal");

                            var modalDialogF = createModalDialog();
                            var modalContentF = createModalContent();

                            var modalHeaderF = createModalHeader("Edit Account");
                            var modalBodyF = createModalBody();

                            var modalFooterF = createModalFooterStudent("Front", null, "acc-"+accounts[i]['id']+"-modalNext", accounts[i]['email']);

                                // Append Modal
                            appendModal(modalF, modalDialogF, modalContentF, modalHeaderF, modalBodyF, modalFooterF);
                                //

                                // Create Editable Values for Front Modal
                            var formEditEmail = createFormFloatingInput("Email", accounts[i]['email'], "text", editEmail, "email", "xxx@gmail.com", true);
                            var formEditFName = createFormFloatingInput("First Name", accounts[i]['fname'], "text", editFName, "fname", "First Name", false);
                            var formEditMName = createFormFloatingInput("Middle Name", accounts[i]['mname'], "text", editMName, "mname", "Middle Name", false);
                            var formEditLName = createFormFloatingInput("Last Name", accounts[i]['lname'], "text", editLName, "lname", "Last Name", false);
                                //

                                // Append Editables for Front Modal
                            appendEditables(modalBodyF, formEditEmail, formEditFName, formEditMName, formEditLName);
                                //
                            //

                            // Next Modal
                            var modalN = createModal("acc-"+accounts[i]['id']+"-modalNext");

                            var modalDialogN = createModalDialog();
                            var modalContentN = createModalContent();

                            var modalHeaderN = createModalHeader("Edit Account");
                            var modalBodyN = createModalBody();

                            var modalFooterN = createModalFooterStudent("Next", "acc-"+accounts[i]['id']+"-modal", null, accounts[i]['email'], accounts[i]['uType'], editFName, editMName, editLName, editBday, editSex, editGFName, editGMName, editGLName, editGContact, editGEmail);

                                // Append Modal
                            appendModal(modalN, modalDialogN, modalContentN, modalHeaderN, modalBodyN, modalFooterN);
                                //

                                // Create Editable Values for Next Modal
                            var formEditBDay = createFormFloatingInput("Day of Birth", null, "date", editBday, "bday", "mm/dd/yy", true);
                            var formEditSex = createFormFloatingSelect("Sex", null, editSex, "sex", "Select Sex", "Male, Female, Others");
                            var formEditGFName = createFormFloatingInput("Guardian's First Name", null, "text", editGFName, "gfname", "First Name", false);
                            var formEditGMName = createFormFloatingInput("Guardian's Middle Name", null, "text", editGMName, "gmname", "Middle Name", false);
                            var formEditGLName = createFormFloatingInput("Guardian's Last Name", null, "text", editGLName, "glname", "Last Name", false);

                            var formEditGContact = createFormFloatingInput("Guardian's Contact Number", null, "text", editGContact, "gcontact", "xxxxxxxxxxx", false);
                            var formEditGEmail = createFormFloatingInput("Guardian's Email", null, "email", editGEmail, "gemail", "xxx@gmail.com", false);;
                                //

                                // Append Editables for Next Modal
                            appendEditablesStudent(modalBodyN, formEditBDay, formEditSex, formEditGFName, formEditGMName, formEditGLName, formEditGContact, formEditGEmail);
                                //

                            //

                            cont_modals.appendChild(modalF);
                            cont_modals.appendChild(modalN);
                                // Fill up the Extra Editable Details | It needed to come after the appending of the modals to the main containers
                            getStudentDetail(accounts[i]['email'], editGFName, editGMName, editGLName, editGContact, editGEmail, editBday, editSex);
                                //
                        break;

                        case "Teacher":
                            // Form Editable IDS

                            var editProfID = "inEditProfID-"+accounts[i]['id'];
                            var editSchoolID = "inEditSchoolID-"+accounts[i]['id'];
                            //

                            // Modal
                            var modal = createModal("acc-"+accounts[i]['id']+"-modal");

                            var modalDialog = createModalDialog();
                            var modalContent = createModalContent();

                            var modalHeader = createModalHeader("Edit Account");
                            var modalBody = createModalBody();

                            var modalFooter = createModalFooterTeacher(accounts[i]['email'], accounts[i]['uType'], editFName, editMName, editLName, editProfID, editSchoolID);

                                // Append Modal
                            appendModal(modal, modalDialog, modalContent, modalHeader, modalBody, modalFooter);
                                //

                                // Create Editables for Modal
                            var formEditEmail = createFormFloatingInput("Email", accounts[i]['email'], "text", editEmail, "email", "xxx@gmail.com", true);
                            var formEditFName = createFormFloatingInput("First Name", accounts[i]['fname'], "text", editFName, "fname", "First Name", false);
                            var formEditMName = createFormFloatingInput("Middle Name", accounts[i]['mname'], "text", editMName, "mname", "Middle Name", false);
                            var formEditLName = createFormFloatingInput("Last Name", accounts[i]['lname'], "text", editLName, "lname", "Last Name", false);

                            var formEditProfID = createFormFloatingInput("Professional ID", null, "text", editProfID, "profID", "xxxxxxx", true);
                            var formEditSchoolID = createFormFloatingInput("School ID", null, "text", editSchoolID, "schoolID", "xxxxxx", true);
                                //

                                // Append Editables
                            appendEditables(modalBody, formEditEmail, formEditFName, formEditMName, formEditLName);
                            appendEditablesTeacher(modalBody, formEditProfID, formEditSchoolID);
                                //

                            //

                            cont_modals.appendChild(modal);

                            // Fill up the Extra Editable Details
                            getTeacherDetail(accounts[i]['email'], editProfID, editSchoolID);
                            //
                        break;

                        default:
                            // Modal
                            var modal = createModal("acc-"+accounts[i]['id']+"-modal");

                            var modalDialog = createModalDialog();
                            var modalContent = createModalContent();

                            var modalHeader = createModalHeader("Edit Account");
                            var modalBody = createModalBody();

                            var modalFooter = createModalFooterAccounts(accounts[i]['email'], accounts[i]['uType'], editFName, editMName, editLName);

                                // Append Modal
                            appendModal(modal, modalDialog, modalContent, modalHeader, modalBody, modalFooter);
                                //

                                // Create Editables for Modal
                            var formEditEmail = createFormFloatingInput("Email", accounts[i]['email'], "text", editEmail, "email", "xxx@gmail.com", true);
                            var formEditFName = createFormFloatingInput("First Name", accounts[i]['fname'], "text", editFName, "fname", "First Name", false);
                            var formEditMName = createFormFloatingInput("Middle Name", accounts[i]['mname'], "text", editMName, "mname", "Middle Name", false);
                            var formEditLName = createFormFloatingInput("Last Name", accounts[i]['lname'], "text", editLName, "lname", "Last Name", false);
                                //

                                // Append Editables to Modal
                            appendEditables(modalBody, formEditEmail, formEditFName, formEditMName, formEditLName);
                                //

                            //

                            cont_modals.appendChild(modal);

                        break;
                    }

                    //

                    // Append
                    cont_accounts.appendChild(row); // put the row element into the main container
                    
                    //

                }
            }

        }
    };

}

// Get Accounts
function getAccounts() {
    var request = new XMLHttpRequest();

    // Searching
    var search = document.querySelector("#searchText");
    //

    request.open("POST", "../Accounts/AJAX/getAccounts.php");
    request.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

    request.onreadystatechange = function () {
        if (this.readyState === 4 && this.status === 200) {
            var result = this.response;
            console.log(result);

            cont_accounts = document.querySelector("#cont_accounts");
            cont_accounts.innerHTML = "";
            cont_modals = document.querySelector("#cont_modals");
            cont_modals.innerHTML = "";

            try {
                var accounts = JSON.parse(result);

                for (i = 0; i < accounts.length; i++) {
                    // Row
                    var row = createRow();

                        // Data
                            // names
                    fname = accounts[i]['fname'];
                    mname = accounts[i]['mname'];
                    lname = accounts[i]['lname'];
                            //

                            // Actions
                    var accStat = accounts[i]['isActivated'];
                    if (accStat == 0) {
                        accStat = "Not Activated";
                    } else if (accStat == 1) {
                        accStat = "Active";
                    } else if (accStat == -1) {
                        accStat = "Terminated";
                    }
                            //

                    var td_id = createData(accounts[i]['id']);
                    var td_fname = createData(!fname ? "Not Set" : fname);
                    var td_mname = createData(!mname ? "Not Set" : mname);
                    var td_lname = createData(!lname ? "Not Set" : lname);
                    var td_email = createData(accounts[i]['email']);
                    var td_utype = createData(accounts[i]['uType']);
                    var td_dcreate = createData(accounts[i]['dateCreated']);
                    
                    var td_status = createData(accStat);
                    var td_action = addActions_Accounts("#deleteAccount", accounts[i]['id'], accStat);
                    // var td_action = createActions_Accounts("#modal-del"+accounts[i]['id'], "#modal-view"+accounts[i]['id'], accStat);

                        // Append
                    appendRow(row, td_id, td_fname, td_mname, td_lname, td_email, td_utype, td_dcreate, td_status, td_action);

                    cont_accounts.appendChild(row);
                    

                    // Modals
                    // var delModal = createModal("modal-del"+accounts[i]['id'], "Account Termination");
                    // var del = getModalElements(delModal);
                    // var delTxt = document.createTextNode("Are you sure you want to deactivate this account?");
                    // del[3].appendChild(delTxt);
                    // del[4].appendChild(addBtn_Cancel());
                    // del[4].appendChild(addBtn_Terminate(accounts[i]['email']));

                    // var viewModal = createModal("modal-view"+accounts[i]['id'], "View Account");


                    // cont_modals.appendChild(delModal);
                    // var delModal = createModal("modal-del"+accounts[i]['id'], "Account Termination");
                    // var viewModal = createModal("modal-view"+accounts[i]['id'], "View Account");

                    // cont_modals.appendChild(delModal);
                    // cont_modals.appendChild(viewModal);
                    
                }
            } catch (e) {
                generateToast("getAccError", "Notification", "Get Account", "Error: No Results Found");
            }
        }
    };

    request.send("search="+search.value);
}

function account_deactivate(accID) {
    delBtn = document.querySelector("#btn_deactivate");
    delBtn.setAttribute("onClick", "terminateAccount("+accID+")");
}

// Appending
function appendRow_Obs(row, id, fname, mname, lname, email, uType, dateCreated, status) {
    row.appendChild(id);
    row.appendChild(fname);
    row.appendChild(mname);
    row.appendChild(lname);
    row.appendChild(email);
    row.appendChild(uType);
    row.appendChild(dateCreated);
    row.appendChild(status);
}

function appendRow(row, id, fname, mname, lname, email, utype, dcreate, status, action) {
    row.appendChild(id);
    row.appendChild(fname);
    row.appendChild(mname);
    row.appendChild(lname);
    row.appendChild(email);
    row.appendChild(utype);
    row.appendChild(dcreate);
    row.appendChild(status);
    row.appendChild(action);
}

// Editable Appending
function appendEditables(modalBody, email, fname, mname, lname) { // This function needs to be more specific
    modalBody.appendChild(email);
    modalBody.appendChild(fname);
    modalBody.appendChild(mname);
    modalBody.appendChild(lname);
}

function appendEditablesTeacher(modalBody, profID, schoolID) {
    modalBody.appendChild(profID);
    modalBody.appendChild(schoolID);
}

function appendEditablesStudent(modalBody, bday, sex, gfname, gmname, glname, gcontact, gemail) {
    modalBody.appendChild(bday);
    modalBody.appendChild(sex);
    modalBody.appendChild(gfname);
    modalBody.appendChild(gmname);
    modalBody.appendChild(glname);
    modalBody.appendChild(gcontact);
    modalBody.appendChild(gemail);
}
//

function appendModal(modal, dialog, content, header, body, footer) {    
    content.appendChild(header);
    content.appendChild(body);
    content.appendChild(footer);

    dialog.appendChild(content);

    modal.appendChild(dialog);
}
//

// 
function terminateAccount(accID) {
    var request = new XMLHttpRequest();

    request.open("POST", "AJAX/deleteAccount.php");
    request.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

    request.onreadystatechange = function () {
        if (this.readyState === 4 && this.status === 200) {
            var result = this.response;
            console.log(result);

            if (result == "true") {
                generateToast("terminateAccount", "Notification", "Termination", "Account Terminated Successfully");
                getAccounts();
            } else {
                generateToast("terminateAccount", "Notification", "Termination", "Error: Failed to Terminate Account");
            }
        }
    };

    request.send("accID="+accID); 
}
//

// GET DETAILS
function getAccountsDetails(email, uType) {
    var request = new XMLHttpRequest();
    var details;

    request.open("POST", "AJAX/getAccountDetails.php"); // Get the file we need to open
    request.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

    request.onreadystatechange = function () {
        if (this.readyState === 4 && this.status === 200) {
            var results = this.response;
            details = results;

            if (results != "") {
                details = JSON.parse(results);

                switch (uType ) {
                    case "Teacher":

                    break;
                    case "Student":
                    break;
                }
            }
        }
    };

    request.send("email="+email);
    return details;
}

function getTeacherDetail(email, profID, schoolID) {
    var request = new XMLHttpRequest();

    // 
    profID = document.querySelector("#"+profID);
    schoolID = document.querySelector("#"+schoolID);
    //

    request.open("POST", "AJAX/getAccountDetails.php"); // Get the file we need to open
    request.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

    request.onreadystatechange = function () {
        if (this.readyState === 4 && this.status === 200) {
            var results = this.response;

            if (results != "") {
                details = JSON.parse(results);

                profID.value = details[0]['profID'];
                schoolID.value = details[0]['school'];
            }
        }
    };

    request.send("email="+email);
}

function getStudentDetail(email, gfname, gmname, glname, gcontact, gemail, bday, sex) {
    var request = new XMLHttpRequest();
    gfname = document.querySelector("#"+gfname);
    gmname = document.querySelector("#"+gmname);
    glname = document.querySelector("#"+glname);

    gcontact = document.querySelector("#"+gcontact);
    gemail = document.querySelector("#"+gemail);

    bday = document.querySelector("#"+bday);
    sex = document.querySelector("#"+sex);

    request.open("POST", "AJAX/getAccountDetails.php"); // Get the file we need to open
    request.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

    request.onreadystatechange = function () {
        if (this.readyState === 4 && this.status === 200) {
            var results = this.response;
            details = results;

            if (results != "") {
                details = JSON.parse(results);

                for (i = details.length - 1; i >= 0; i--) {
                    gfname.value = details[i]['gfname'];
                    gmname.value = details[i]['gmname'];
                    glname.value = details[i]['glname'];

                    gcontact.value = details[i]['gcontact'];
                    gemail.value = details[i]['gemail'];

                    bday.value = details[i]['bday'];
                    sex.value = details[i]['sex'];
                }
            }
        }
    };

    request.send("email="+email);
}