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