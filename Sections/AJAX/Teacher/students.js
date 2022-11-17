function getStudents() {
    var request = new XMLHttpRequest();

    // Data
    var search = document.querySelector("#searchTextStudent");
    //

    request.open("POST", "AJAX/Teacher/getStudents.php");
    request.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

    request.onreadystatechange = function () {
        if (this.readyState === 4 && this.status === 200) {
            var result = this.response;
            // console.log(result);

            // Containers
            var cont_students = document.querySelector("#cont_students");

            cont_students.innerHTML = "";
            //

            if (result != null && result != "" && result != "[]") {

                var students = JSON.parse(result);

                for (i = 0; i < students.length; i++) {
                    // Rows
                    var row = createRowStudents();

                        // Special Initialization
                    var selChecked = students[i]['section'] != null && students[i]['section'] != "" ? true : false;
                        //

                    var td_id = createData(students[i]['id']);
                    var td_fname = createData(students[i]['fname']);
                    var td_mname = createData(students[i]['mname']);
                    var td_lname = createData(students[i]['lname']);
                    var td_selection = createDataSelection("studentSel", students[i]['id'], selChecked, "saveSelStudents");

                        // Append
                    appendRowStudent(row, td_id, td_fname, td_mname, td_lname, td_selection);
                        //

                    //

                    cont_students.appendChild(row);
                }

            } else {
                generateToast("searchError", "Notification", "Search", "Error: No Students Found");
            }
        }
    };

    request.send("search="+search.value);
}

// Appending
function appendRowStudent(row, id, fname, mname, lname, selection) {
    row.appendChild(id);
    row.appendChild(fname);
    row.appendChild(mname);
    row.appendChild(lname);
    row.appendChild(selection);
}
//