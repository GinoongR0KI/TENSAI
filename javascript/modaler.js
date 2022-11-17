// General Modal Creator

function createModal(modalID) {
    var div = document.createElement("div");

    // set Attributes
    div.setAttribute("id", modalID);
    div.setAttribute("class", "modal fade");
    div.setAttribute("data-bs-backdrop", "static");
    div.setAttribute("data-bs-keyboard", "false");
    div.setAttribute("tabindex", "-1");
    div.setAttribute("aria-labelledby", "staticBackdropLabel");
    div.setAttribute("aria-hidden", "true");
    //

    return div;
}

function createModalDialog() {
    var div = document.createElement("div");

    // Set Attributes
    div.setAttribute("class", "modal-dialog modal-dialog-centered modal-dialog-scrollable");
    //

    return div;
}

function createModalContent() {
    var div = document.createElement("div");

    // Set Attributes
    div.setAttribute("class","modal-content");
    //

    return div;
}

function createModalHeader(modalTitle) {
    var div = document.createElement("div");

    var title = document.createElement("h5");
    var close = document.createElement("button");

    // Set Attributes
        // Modal Header
    div.setAttribute("class","modal-header");
        //

        // Title
    title.setAttribute("id", "staticBackdropLabel");
    title.setAttribute("class", "modal-title");
    title.innerText = modalTitle;
        //

        // Close Button
    close.setAttribute("class","btn-close");
    close.setAttribute("data-bs-dismiss","modal");
    close.setAttribute("aria-label","Close");
        //
    //

    // Append to Header
    div.appendChild(title);
    div.appendChild(close);
    //

    return div;
}

function createModalBody() {
    var div = document.createElement("div");

    // Set Attributes
        // Modal Header
    div.setAttribute("class","modal-body");
        //
    //

    return div;
}

function createModalFooterAccounts(email, uType, fname, mname, lname) {
    var div = document.createElement("div");

    var del = document.createElement("button");
    var save = document.createElement("button");

    // Attributes
    div.setAttribute("class", "modal-footer");

    del.setAttribute("id","");
    del.setAttribute("class","btn btn-redcolor");
    del.setAttribute("data-bs-dismiss","modal");
    del.setAttribute("onClick","deleteAccount('"+email+"')"); // Put a script here to ajax deletion
    del.innerText = "DELETE";

    save.setAttribute("class", "btn btn-palette2");
    save.setAttribute("data-bs-dismiss","modal");
    save.setAttribute("onClick", "editAccount('"+email+"', '"+uType+"', '"+fname+"', '"+mname+"', '"+lname+"')");
    save.innerText = "SAVE";
    //

    // Append
    div.appendChild(del);
    div.appendChild(save);
    //

    return div;
}

function createModalFooterTeacher(email, uType, fname, mname, lname, profID, schoolID) {
    var div = document.createElement("div");

    var del = document.createElement("button");
    var save = document.createElement("button");

    // Attributes
    div.setAttribute("class", "modal-footer");

    del.setAttribute("id","");
    del.setAttribute("class","btn btn-redcolor");
    del.setAttribute("data-bs-dismiss","modal");
    del.setAttribute("onClick","deleteAccount('"+email+"')"); // Put a script here to ajax deletion
    del.innerText = "DELETE";

    save.setAttribute("class", "btn btn-palette2");
    save.setAttribute("data-bs-dismiss","modal");
    save.setAttribute("onClick", "editAccountTeacher('"+email+"', '"+uType+"', '"+fname+"', '"+mname+"', '"+lname+"', '"+profID+"', '"+schoolID+"')");
    save.innerText = "SAVE";
    //

    // Append
    div.appendChild(del);
    div.appendChild(save);
    //

    return div;
}

function createModalFooterStudent(footerType, targetBack, targetNext, email, uType, fname, mname, lname, bday, sex, gfname, gmname, glname, gcontact, gemail) {
    var div = document.createElement("div");

    // Attributes
    div.setAttribute("class", "modal-footer");
    //

    switch (footerType) {
        case "Front":
            var del = document.createElement("button");
            var next = document.createElement("button");

            // Attributes
            del.setAttribute("class","btn btn-redcolor");
            del.setAttribute("data-bs-dismiss","modal");
            del.setAttribute("onClick","deleteAccount('"+email+"')"); // Put a script here to ajax deletion
            del.innerText = "DELETE";

            next.setAttribute("class", "btn btn-palette2");
            next.setAttribute("data-bs-toggle", "modal");
            next.setAttribute("data-bs-target", "#"+targetNext);
            next.innerText = "NEXT";
            //

            // Append
            div.appendChild(del);
            div.appendChild(next);
            //
        break;
        case "Next":
            var back = document.createElement("button");
            var del = document.createElement("button");
            var save = document.createElement("button");

            // Attributes
            back.setAttribute("class", "btn");
            back.setAttribute("data-bs-toggle", "modal");
            back.setAttribute("data-bs-target", "#"+targetBack);
            back.innerText = "BACK";

            del.setAttribute("class","btn btn-redcolor");
            del.setAttribute("data-bs-dismiss","modal");
            del.setAttribute("onClick","deleteAccount('"+email+"')"); // Put a script here to ajax deletion
            del.innerText = "DELETE";

            save.setAttribute("class", "btn btn-palette2");
            save.setAttribute("data-bs-dismiss","modal");
            save.setAttribute("onClick", "editAccountStudent('"+email+"', '"+uType+"', '"+fname+"', '"+mname+"', '"+lname+"', '"+bday+"', '"+sex+"', '"+gfname+"', '"+gmname+"', '"+glname+"', '"+gcontact+"', '"+gemail+"')");
            save.innerText = "SAVE";
            //

            // Append
            div.appendChild(back);
            div.appendChild(del);
            div.appendChild(save);
            //
        break;
    }

    return div;
}

function createModalFooterSchool(origID, schoolID, schoolName, principal, municipality) {
    var div = document.createElement("div");
        // Footer Attributes
    div.setAttribute("class", "modal-footer");
        //

    // Buttons
        // Delete
    var delBtn = document.createElement("button");
            // Attributes
    delBtn.setAttribute("id","");
    delBtn.setAttribute("class","btn btn-redcolor");
    delBtn.setAttribute("data-bs-dismiss","modal");
    delBtn.setAttribute("onClick","deleteSchool('"+schoolID+"')"); // Put a script here to ajax deletion
    delBtn.innerText = "DELETE";
            //

        //

        // Save
    var saveBtn = document.createElement("button");
            // Attributes
    saveBtn.setAttribute("id","");
    saveBtn.setAttribute("class","btn btn-palette2");
    saveBtn.setAttribute("data-bs-dismiss","modal");
    saveBtn.setAttribute("onClick","editSchool('"+origID+"','"+schoolID+"','"+schoolName+"','"+principal+"','"+municipality+"')"); // Put a script here to ajax saving
    saveBtn.innerText = "SAVE";
            //

        //
    //

    // Append the buttons to div
    div.appendChild(delBtn);
    div.appendChild(saveBtn);
    //

    return div;
}

function createModalFooterSection(sectionID, schoolID, sectionName, advisorID) {
    var div = document.createElement("div");
        // Footer Attributes
    div.setAttribute("class", "modal-footer");
        //

    // Buttons
        // Delete
    var delBtn = document.createElement("button");
            // Attributes
    delBtn.setAttribute("id","");
    delBtn.setAttribute("class","btn btn-redcolor");
    delBtn.setAttribute("data-bs-dismiss","modal");
    delBtn.setAttribute("onClick","deleteSection('"+schoolID+"', '"+sectionID+"')"); // Put a script here to ajax deletion
    delBtn.innerText = "DELETE";
            //

        //

        // Save
    var saveBtn = document.createElement("button");
            // Attributes
    saveBtn.setAttribute("id","");
    saveBtn.setAttribute("class","btn btn-palette2");
    saveBtn.setAttribute("data-bs-dismiss","modal");
    saveBtn.setAttribute("onClick","editSection('"+schoolID+"','"+sectionID+"','"+sectionName+"','"+advisorID+"')"); // Put a script here to ajax saving
    saveBtn.innerText = "SAVE";
            //

        //
    //

    // Append the buttons to div
    div.appendChild(delBtn);
    div.appendChild(saveBtn);
    //

    return div;
}

function createModalFooterLesson(onClick, isSensitive) {
    var div = document.createElement("div");

    var cancel = document.createElement("button");
    var yes = document.createElement("button");

    // Attributes
    div.setAttribute("class", "modal-footer");

        // Cancel
    cancel.setAttribute("class","btn");
    cancel.setAttribute("data-bs-dismiss","modal");
    cancel.innerText = "CANCEL";
        //

        // Edit
            // This button will take you to the lesson creator page and it will send the values needed to the other page
    if (isSensitive) {yes.setAttribute("class","btn btn-redcolor");}
    else {yes.setAttribute("class","btn btn-palette2");}
    yes.setAttribute("onClick", onClick);
    yes.setAttribute("data-bs-dismiss","modal");
    yes.innerText = "YES";
        //
    //

    // Append
    div.appendChild(cancel);
    div.appendChild(yes);
    //

    return div;
}

function createModalFooterAssessment(onClick) {
    var div = document.createElement("div");
    
    var cancel = document.createElement("button");
    var yes = document.createElement("button");

    // Attribute
    div.setAttribute("class", "modal-footer");

    // Cancel
    cancel.setAttribute("class","btn");
    cancel.setAttribute("data-bs-dismiss","modal");
    cancel.innerText = "CANCEL";

        // Edit
            // This button will take you to the lesson creator page and it will send the values needed to the other page
    yes.setAttribute("class","btn btn-redcolor");
    yes.setAttribute("onClick", onClick);
    yes.setAttribute("data-bs-dismiss","modal");
    yes.innerText = "YES";
        //
    //

    // Append
    div.appendChild(cancel);
    div.appendChild(yes);
    //
    
    return div;
}
//

// Modal Input Creator

function createFormFloatingInput(label, value, inType, inID, inName, placeholder, isReadOnly) {
    // Floating Form Container
    var div = document.createElement("div");
        // Attributes
    div.setAttribute("class", "form-floating");
        //
    //

    // Input
        // Input
    var inp = document.createElement("input");
            // Attributes
    inp.setAttribute("type", inType);
    inp.setAttribute("name", inName);
    inp.setAttribute("id", inID);
    inp.setAttribute("class", "form-control mb-3");
    inp.setAttribute("placeholder", placeholder);
    if (isReadOnly) {inp.readOnly = true;} // makes this input to readOnly if given a true value
    if (value != null && value != "") {inp.value = value;} // only sets the value if it has been set and not empty
            //

        //

        // Label
    var lbl = document.createElement("label");
            // Attributes
    lbl.setAttribute("for", inID);
    lbl.innerText = label;
            //

        //

    //

    // Append
    div.appendChild(inp);
    div.appendChild(lbl);
    //
    
    return div;
}

function createFormFloatingSelect(label, value, inID, inName, placeholder, options) {
    // Floating Form Container
    var div = document.createElement("div");
        // Attributes
    div.setAttribute("class", "form-floating");
        //
    //

    // Select
        // Input
    var inp = document.createElement("select");
    var opts = options != null ? options.split(",") : null;
            // Attributes
    inp.setAttribute("name", inName);
    inp.setAttribute("id", inID);
    inp.setAttribute("class", "form-select mb-3");
    inp.setAttribute("aria-label", "Municipality");

    if (placeholder != null && placeholder != "") { // Create the first option as its placeholder value
        var opt = document.createElement("option");
            // Attributes
        opt.setAttribute("value", "null");
        opt.disabled = true;
        opt.innerText = placeholder;
            //

        inp.appendChild(opt);
    }

    if (opts != null) {
        opts.forEach(element => {
            var opt = document.createElement("option");
                // Attributes
            opt.setAttribute("value", element);
            opt.innerText = element;
                //

            inp.appendChild(opt);
        });
    }
            //

        //

    if (value != null && value != "") {inp.value = value;}

        // Label
    var lbl = document.createElement("label");
            // Attributes
    lbl.setAttribute("for", inID);
    lbl.innerText = label;
            //
        //
    //

    // Append
    div.appendChild(inp);
    div.appendChild(lbl);
    //

    return div;
}

function createModalMessage(message) {
    var text = document.createTextNode(message);

    return text;
}

//

// Data Creators

function createRow(targetModal) {
    var row = document.createElement("tr");

    // Set Attributes
    row.setAttribute("data-bs-toggle", "modal");
    row.setAttribute("data-bs-target", targetModal);
    //

    return row;
}

function createRowLessons() {
    var row = document.createElement("tr");

    return row;
}

function createRowAssessments() {
    var row = document.createElement("tr");

    return row;
}

function createRowStudents() {
    var row = document.createElement("tr");

    return row;
}

function createRowReports() {
    var row = document.createElement("tr");

    return row;
}

function createData(value) {
    var data = document.createElement("td");

    // Set Attributes
    data.setAttribute("value",value);
    data.innerText = value;
    //

    return data;
}

function createDataActionsLesson(lessonID, accID, teacherID, targetModalDel) {
    var data = document.createElement("td");

    var del = document.createElement("button");
    var edit = document.createElement("button");
    var view = document.createElement("button");

    // Set Attributes
    if (accID == teacherID) { // only show these buttons if they are the owner of the material
        // The uType will be unreliable as not all materials, although they are teachers will be from them.
        // but, they will only see materials in the manager that came from them?
        // even so, it will still require us to ask for the user's uType
        del.setAttribute("class", "btn btn-palette3 md-3");
        del.setAttribute("data-bs-toggle", "modal");
        del.setAttribute("data-bs-target", targetModalDel);
        del.innerHTML = '<i class="bi bi-trash"></i>';

        edit.setAttribute("class", "btn btn-palette3 md-3");
        edit.setAttribute("href", "creator.php?lessonID="+lessonID);
        edit.innerHTML = '<a href="creator.php?lessonID='+lessonID+'"><i class="bi bi-pencil"></i></a>';

            // Append
        data.appendChild(del);
        data.appendChild(edit);
            //
    }

    view.setAttribute("class", "btn btn-palette3 md-3");
    // view.setAttribute("href", "creator.php?lessonID="+lessonID);
    view.innerHTML = '<a href="viewer.php?lessonID='+lessonID+'"><i class="bi bi-eye"></i></a>';

    // Append
    data.appendChild(view);
    //

    //

    return data;
}

function createDataActionsAssessment(assessID, targetModalDel) {
    var data = document.createElement("td");

    var del = document.createElement("button");
    var edit = document.createElement("button");

    // Attributes
        // Del
    del.setAttribute("class", "btn btn-palette3 md-3");
    del.setAttribute("data-bs-toggle", "modal");
    del.setAttribute("data-bs-target", targetModalDel);
    del.innerHTML = '<i class="bi bi-trash"></i>';
        //

        // Edit
    edit.setAttribute("class", "btn btn-palette3 md-3");
    edit.setAttribute("href", "creator.php?assessID="+assessID);
    edit.innerHTML = '<a href="creator.php?assessID='+assessID+'"><i class="bi bi-pencil"></i></a>';
        //
    //

    // Append
    if (document.querySelector("#hidVal_uType").value == "Teacher") {
        data.appendChild(del);
        data.appendChild(edit);
    }
    //

    return data;
}

function createDataSelection(className, value, isChecked, targetBtn) {
    var data = document.createElement("td");

    var inSel = document.createElement("input");

    // Attributes
    inSel.setAttribute("class", className);
    inSel.setAttribute("type", "checkbox");
    inSel.setAttribute("value", value);
    inSel.setAttribute("onChange", "toggleBtn('"+targetBtn+"', false)");
    inSel.checked = isChecked;
    //

    // Append
    data.appendChild(inSel);
    //

    return data;
}

//