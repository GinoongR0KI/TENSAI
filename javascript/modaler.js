// Modaler

// Contents of a Modal >>> Modal -> Dialog -> Content -> Header; Body; Footer

// This script is made to dynamically be able to create Modals as flexible as possible to code with lesser and cleaner lines.

// CREATORS

function createModal(modalID, modalTitle) {
    var modal = assemModal(modalID);
    var dialog = assemDialog();
    var content = assemContent();

    var header = assemHeader(modalTitle);
    var body = assemBody();
    var footer = assemFooter();

    // Append

    content.appendChild(header);
    content.appendChild(body);
    content.appendChild(footer);

    dialog.appendChild(content);

    modal.appendChild(dialog);

    // Return
    return modal;
}

function assemModal(modalID) {
    var div = document.createElement("div");

    // Set Attributes
    div.setAttribute("class", "modal fade");
    div.setAttribute("id", modalID);
    div.setAttribute("data-bs-backdrop", "static");
    div.setAttribute("data-bs-keyboard", "false");
    div.setAttribute("tabindex", "-1");
    div.setAttribute("aria-labelledby", "staticBackdropLabel"); // This needs to be defined by its content on the Header
    div.setAttribute("aria-hidden", "true");

    //

    return div;
}

function assemDialog() {
    var div = document.createElement("div");

    // Set Attributes
    div.setAttribute("class", "modal-dialog modal-dialog-centered");

    //
    return div;
}

function assemContent() {
    var div = document.createElement("div");

    // Set Attribute
    div.setAttribute("class", "modal-content");

    //
    return div;
}

function assemHeader(modalTitle) {
    var div = document.createElement("div");
    var title = document.createElement("h5");
    var btn = document.createElement("button");

    // Set Attribute
        // div
    div.setAttribute("class", "modal-header");
        // title
    title.setAttribute("class", "modal-title");
    title.setAttribute("id", ""); // This needs to be set somehow
    title.innerText = modalTitle;
        // button
    btn.setAttribute("class","btn-close");
    btn.setAttribute("type", "button");
    btn.setAttribute("data-bs-dismiss", "modal");
    btn.setAttribute("aria-label", "Close");

    // Append
    div.appendChild(title);
    div.appendChild(btn);

    //
    return div;
}

function assemBody() { // This part of the modal will need to be altered later by a different set of commands
    var div = document.createElement("div");

    // Set Attribute
    div.setAttribute("class", "modal-body");

    //
    return div;

}

function assemFooter() {
    var div = document.createElement("div");

    // Set Attribute
    div.setAttribute("class", "modal-footer");
    //

    return div;
} // There are a lot of different kinds of Footer. The need for a dynamic code for these set is required

function assemFooter_Accounts() {
    var div = document.createElement("div");

    // Set Attribute
    div.setAttribute("class", "modal-footer");
    //

    // Append

    return div;
}

function addBtn_Cancel() {
    var btn = document.createElement("button");
    
    // Set Attribute
    btn.setAttribute("class", "btn");
    btn.setAttribute("data-bs-dismiss","modal");
    btn.innerText = "CANCEL";

    // Append

    // Return
    return btn;
}

function addBtn_Terminate(email) {
    var btn = document.createElement("button");
    
    // Set Attribute
    btn.setAttribute("class", "btn btn-redcolor");
    btn.setAttribute("data-bs-dismiss","modal");
    btn.setAttribute("onClick", "terminateAccount('"+email+"')");
    btn.innerText = "DEACTIVATE";

    // Append
    

    // Return
    return btn;
}

// GETTERS

function getModalElements(modalID) {
    var elements = new Array();

    var dialog = modalID.firstChild;
    var content = dialog.firstChild;

    // Push
    elements.push(dialog);
    elements.push(content);
    elements.push(content.childNodes[0]);
    elements.push(content.childNodes[1]);
    elements.push(content.childNodes[2]);

    // Return
    return elements;
}