function generateToast(toastID, title, time, message) {
    var cont_toasts = document.querySelector("#cont_toasts");

    var toast = createToast(toastID);

    var toastHeader = createToastHeader(title, time);
    var toastBody = createToastBody(message);

    // Append
    toast.appendChild(toastHeader);
    toast.appendChild(toastBody);

    cont_toasts.appendChild(toast);
    //

    // Show the toast
    var toastEl = new bootstrap.Toast(toast);
    toastEl.show();
    //

    toast.addEventListener("hidden.bs.toast", function () {
        cont_toasts.removeChild(toast);
    });
}

function generateToastPersist(toastID, title, time, message) {
    var cont_toasts = document.querySelector("#cont_toasts");

    var toast = createToast(toastID);

    var toastHeader = createToastHeader(title, time);
    var toastBody = createToastBody(message);

    // Append
    toast.appendChild(toastHeader);
    toast.appendChild(toastBody);

    cont_toasts.appendChild(toast);
    //

    // Show the toast
    var toastEl = new bootstrap.Toast(toast, {
        autohide: false
    });
    toastEl.show();
    //

    toast.addEventListener("hidden.bs.toast", function () {
        cont_toasts.removeChild(toast);
    });
}

function generateToastPrompt(toastID, title, message) {
    var cont_toasts = document.querySelector("#cont_toasts");

    var toast = createToast(toastID);


    var toastHeader = createToastHeader(title, "Just Now");
    var toastBody = createToastBody(message);

    var toastBR = document.createElement("br");

    var toastButton = createButton("Yes", 'console.log("Yes")');
    var toastButton2 = createButton("No", 'toast.hide()');
    toastButton2.setAttribute("data-bs-dismiss", "toast");

    // Append
    toast.appendChild(toastHeader);
    toast.appendChild(toastBody);

    cont_toasts.appendChild(toast);

    toastBody.appendChild(toastBR);
    toastBody.appendChild(toastButton);
    toastBody.appendChild(toastButton2);
    //

    var toastEl = new bootstrap.Toast(toast, {
        autohide: false
    });
    toastEl.show();

    toast.addEventListener("hidden.bs.toast", function () {
        cont_toasts.removeChild(toast);
    });
}


// Toast Creator

function createToast(toastID) {
    var div = document.createElement("div");

    // Attributes
    div.setAttribute("id", toastID);
    div.setAttribute("class", "toast");
    div.setAttribute("role", "alert");
    div.setAttribute("aria-live", "assertive");
    div.setAttribute("aria-atomic", "true");
    //

    return div;
}

function createToastHeader(headerTitle, headerTime) {
    var div = document.createElement("div");

    var title = document.createElement("strong");
    var time = document.createElement("small");

    var btn = document.createElement("button");

    // Attributes
    div.setAttribute("class", "toast-header bg-palette1");

    title.setAttribute("class", "me-auto");
    title.innerText = headerTitle;

    // time.setAttribute("class", "text-muted");
    time.innerText = headerTime;

    btn.setAttribute("class", "btn-close");
    btn.setAttribute("data-bs-dismiss", "toast");
    btn.setAttribute("aria-label","Close");
    //

    // Append
    div.appendChild(title);
    div.appendChild(time);

    div.appendChild(btn);
    //

    return div;
}

function createToastBody(message) {
    var div = document.createElement("div");

    // Attribute
    div.setAttribute("class", "toast-body");
    div.innerText = message;
    //

    return div;
}
//

// Alert Toasts
function createButton(type, onClick) {
    var button = document.createElement("button");

    button.setAttribute("onClick",onClick);
    button.innerText = type;

    return button;
}
//