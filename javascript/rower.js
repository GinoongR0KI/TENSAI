function createRow() {
    var row = document.createElement("tr");

    // Attributes

    // Return
    return row;
}

function createData(data) {
    var td = document.createElement("td");

    // Attributes
    td.setAttribute("value", data);
    td.innerText = data;

    // Return
    return td;
}

function createActions_Accounts(delModal, viewModal, isActivated) {
    // Need to create actions for delete, edit, deactivate, view

    var td = document.createElement("td");

    var toggleAcc = document.createElement("button");
    var view = document.createElement("button");

    // Attributes
    if (isActivated == "Active") {
        toggleAcc.setAttribute("class", "btn btn-palette3 md-3");
        toggleAcc.setAttribute("data-bs-toggle","modal");
        toggleAcc.setAttribute("data-bs-target", delModal); // Need targets / data-bs-toggle="modal" data-bs-target="#accountEdit"
        toggleAcc.innerHTML = '<i class="bi bi-person-x"></i>';

        view.setAttribute("class", "btn btn-palette3 md-3");
        view.setAttribute("data-bs-toggle", "modal");
        view.setAttribute("data-bs-target", viewModal);
        view.innerHTML = '<i class="bi bi-eye"></i>';
    }

    // Append
    if (isActivated == "Active") {
        // td.appendChild(view);
        td.appendChild(toggleAcc);
    }

    // Return
    return td;
}

function addActions_Accounts(delModal, accID, isActivated) {
    var td = document.createElement("td");
    var hover = document.createElement("div");

    var deacBtn = document.createElement("button");

    // Attributes
    hover.setAttribute("class", "hover-button");

    deacBtn.setAttribute("class", "btn btn-palette3 md-3");
    deacBtn.setAttribute("data-bs-toggle","modal");
    deacBtn.setAttribute("data-bs-target", delModal); // Need targets / data-bs-toggle="modal" data-bs-target="#accountEdit"
    deacBtn.setAttribute("onClick", "account_deactivate("+accID+")");
    deacBtn.innerHTML = '<i class="bi bi-person-x"></i>';

    // Append
    if (isActivated == "Active") {
        td.appendChild(hover);
        hover.appendChild(deacBtn);
    } else {
        txt = document.createTextNode("N/A");

        td.appendChild(hover);
        hover.appendChild(txt);
    }

    // Return
    return td;
}

function addActions_Schools(deleteModal, editModal, schoolID, schoolName, principal, municipality) {
    console.log(municipality);
    var td = document.createElement("td");
    var hover = document.createElement("div");

    var delBtn = document.createElement("button");
    var editBtn = document.createElement("button");

    // Attributes
    hover.setAttribute("class", "hover-button");

    delBtn.setAttribute("class", "btn btn-palette3 md-3");
    delBtn.setAttribute("data-bs-toggle","modal");
    delBtn.setAttribute("data-bs-target", deleteModal);
    delBtn.setAttribute("onClick", "school_delete("+schoolID+")"); // Add function here to set which school is to be deleted
    delBtn.innerHTML = '<i class="bi bi-trash"></i>';

    editBtn.setAttribute("class", "btn btn-palette3 md-3");
    editBtn.setAttribute("data-bs-toggle","modal");
    editBtn.setAttribute("data-bs-target", editModal);
    editBtn.setAttribute("onClick", "school_edit("+schoolID+", '"+schoolName+"', "+principal+", '"+municipality+"')"); // Add function here to set which school is to be edited
    editBtn.innerHTML = '<i class="bi bi-pencil-square"></i>';

    // Append
    hover.appendChild(delBtn);
    hover.appendChild(editBtn);

    td.appendChild(hover);

    // Return
    return td;
}

function addActions_Sections(deleteModal, editModal, sectionID, schoolID, sectionName, advisorID) {
    var td = document.createElement("td");
    var hover = document.createElement("div");

    var editBtn = document.createElement("button");
    var delBtn = document.createElement("button");

    // Attribute
    hover.setAttribute("class", "hover-button");

    delBtn.setAttribute("class", "btn btn-palette3 md-3");
    delBtn.setAttribute("data-bs-toggle","modal");
    delBtn.setAttribute("data-bs-target", deleteModal);
    delBtn.setAttribute("onClick", "sections_delete("+sectionID+", "+schoolID+", '"+sectionName+"')"); // Add function here to set which section is to be deleted
    delBtn.innerHTML = '<i class="bi bi-trash"></i>';

    editBtn.setAttribute("class", "btn btn-palette3 md-3");
    editBtn.setAttribute("data-bs-toggle","modal");
    editBtn.setAttribute("data-bs-target", editModal);
    editBtn.setAttribute("onClick", "sections_edit("+sectionID+","+schoolID+", '"+sectionName+"', "+advisorID+")"); // Add function here to set which section is to be edited
    editBtn.innerHTML = '<i class="bi bi-pencil-square"></i>';

    // Append
    hover.appendChild(delBtn);
    hover.appendChild(editBtn);

    td.appendChild(hover);

    // Return
    return td;
}

function addActions_Lessons(lessonID, lessonName, accID, teacherID, state, uType, targetModalDel) {
    var td = document.createElement("td");

    var hover = document.createElement("div");

    var delBtn = document.createElement("button");
    var editBtn = document.createElement("button");
    var viewBtn = document.createElement("button");
    var aprvBtn = document.createElement("button");

    // Attribute
    hover.setAttribute("class", "hover-button");

    if (accID == teacherID) {// only show these buttons if they are the owner of the material
        delBtn.setAttribute("class", "btn btn-palette3 md-3");
        delBtn.setAttribute("data-bs-toggle", "modal");
        delBtn.setAttribute("data-bs-target", targetModalDel);
        delBtn.setAttribute("onClick", "lessons_delete("+lessonID+", '"+lessonName+"')");
        delBtn.innerHTML = '<i class="bi bi-trash"></i>';

        editBtn.setAttribute("class", "btn btn-palette3 md-3");
        editBtn.setAttribute("href", "creator.php?lessonID="+lessonID);
        editBtn.innerHTML = '<a href="creator.php?lessonID='+lessonID+'"><i class="bi bi-pencil"></i></a>';
        editBtn.addEventListener("click", function() {
            this.firstChild.click();
        });

            // Append
        hover.appendChild(delBtn);
        hover.appendChild(editBtn);
            //
    }

    viewBtn.setAttribute("class", "btn btn-palette3 md-3");
    viewBtn.innerHTML = '<a href="viewer.php?lessonID='+lessonID+'"><i class="bi bi-eye"></i></a>';
    viewBtn.addEventListener("click", function () {
        this.firstChild.click();
    });

    // Approve Button
    if ((state == "Pending" || state == "Draft/Pending" || state == "Published/Pending") && uType == "Principal") {
        aprvBtn.setAttribute("class", "btn btn-palette3 md-3");
        aprvBtn.setAttribute("onclick", "approveLesson("+lessonID+")"); // Do Approve Lesson
        aprvBtn.innerHTML = '<a href="#"><i class="bi bi-send-check"></i></a>';

        // Append
        hover.appendChild(aprvBtn);
        //
    }

    // Append
    hover.appendChild(viewBtn);

    td.appendChild(hover);

    // Return
    return td;
}

function addActions_Assessments(assessID, assessTitle, targetModalDel) {
    var td = document.createElement("td");

    var hover = document.createElement("div");

    var delBtn = document.createElement("button");
    var editBtn = document.createElement("button");

    // Attribute
    hover.setAttribute("class", "hover-button");

        // Del
    delBtn.setAttribute("class", "btn btn-palette3 md-3");
    delBtn.setAttribute("data-bs-toggle", "modal");
    delBtn.setAttribute("data-bs-target", targetModalDel);
    delBtn.setAttribute("onClick", "assessments_delete("+assessID+", '"+assessTitle+"')");
    delBtn.innerHTML = '<i class="bi bi-trash"></i>';
        //

        // Edit
    editBtn.setAttribute("class", "btn btn-palette3 md-3");
    editBtn.setAttribute("href", "creator.php?assessID="+assessID);
    editBtn.innerHTML = '<a href="creator.php?assessID='+assessID+'"><i class="bi bi-pencil"></i></a>';
    editBtn.addEventListener("click", function() {
        this.firstChild.click();
    });
        //

    // Append
    if (document.querySelector("#hidVal_uType").value == "Teacher") {
        hover.appendChild(delBtn);
        hover.appendChild(editBtn);
    }

    td.appendChild(hover);

    // Return
    return td;
}

function addActions_Reports(studID) {
    var td = document.createElement("td");

    var div = document.createElement("div");
    var btn = document.createElement("button");

    // Attribute
    div.setAttribute("class", "hover-button");

    btn.setAttribute("class", "btn btn-sm btn-button");
    btn.innerHTML = '<a href="student.php?userID='+studID+'"><i class="bi bi-eye"></i></a>';
    btn.addEventListener("click", function () {
        this.firstChild.click();
    });
    btn.firstChild.setAttribute("target", "_blank");

    //

    // Append
    div.appendChild(btn);

    td.appendChild(div);
    //

    // Return
    return td;
}

function addSelection(className, value, isChecked, targetBtn) {
    var td = document.createElement("td");

    var selection = document.createElement("input");

    // Attribute

    selection.setAttribute("class", className);
    selection.setAttribute("type", "checkbox");
    selection.setAttribute("value", value);
    selection.setAttribute("onChange", "toggleBtn('"+targetBtn+"', false)");
    selection.checked = isChecked;

    // Append

    td.appendChild(selection);

    // Return
    return td;
}