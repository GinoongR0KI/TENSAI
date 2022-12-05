function getLessons(userID) {
    var request = new XMLHttpRequest();

    // Data
    var search = document.querySelector("#searchLessons");
    //

    request.open("POST", "AJAX/Teacher/getLessons.php");
    request.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

    request.onreadystatechange = function () {
        if (this.readyState === 4 && this.status === 200) {
            var result = this.response;
            console.log(result);

            // Containers
            var cont_lessons = document.querySelector("#cont_lessons");
            // var cont_lessons = document.querySelector("#cont_lessons");

            cont_lessons.innerHTML = "";
            //

            try {
                if (result == "[]") escapeToCatch(); // This function does not exist and should not exist; and is only used to go to the catch statement block
                var lessons = JSON.parse(result);

                for (i = 0; i < lessons.length; i++) {
                    // IDs
                    //

                    // Rows
                    var row = createRow();

                        // Special Initialization
                    var selChecked = lessons[i]['sectionID'] != null && lessons[i]['sectionID'] != "" ? true : false;
                    var title = lessons[i]['title'].split("|sepData|")[0];
                    var desc = !lessons[i]['description'].split("|sepData|")[0] ? "No description" : lessons[i]['description'].split("|sepData|")[0];
                        //

                    var td_id = createData(lessons[i]['id']);
                    var td_title = createData(title);
                    var td_desc = createData(desc);
                    var td_owner = createData(lessons[i]['teacherID'] == userID ? "Owned" : "School");
                    // var td_selection = createDataSelection("lessonSel", lessons[i]['id'], selChecked, "saveSelLessons");
                    var td_selection = addSelection("lessonSel", lessons[i]['id'], selChecked, "saveSelLessons");

                        // Append
                    appendRowLessons(row, td_id, td_title, td_desc, td_owner, td_selection);
                        //
                    //

                    cont_lessons.appendChild(row);
                }
            } catch (e) {
                var txt = document.createTextNode("No Lessons Found");
                cont_lessons.appendChild(txt);
                generateToast("searchError", "Notification", "Search", "Error: No Lessons Found");
            }

            // if (result != null && result != "" && result != "[]") {
            //     var lessons = JSON.parse(result);

            //     for (i = 0; i < lessons.length; i++) {
            //         // IDs
            //         //

            //         // Rows
            //         var row = createRow();

            //             // Special Initialization
            //         var selChecked = lessons[i]['sectionID'] != null && lessons[i]['sectionID'] != "" ? true : false;
            //         var title = lessons[i]['title'].split("|sepData|")[0];
            //         var desc = lessons[i]['description'].split("|sepData|")[0];
            //             //

            //         var td_id = createData(lessons[i]['id']);
            //         var td_title = createData(title);
            //         var td_desc = createData(desc);
            //         var td_owner = createData(lessons[i]['teacherID'] == userID ? "Owned" : "School");
            //         // var td_selection = createDataSelection("lessonSel", lessons[i]['id'], selChecked, "saveSelLessons");
            //         var td_selection = addSelection("lessonSel", lessons[i]['id'], selChecked, "saveSelLessons");

            //             // Append
            //         appendRowLessons(row, td_id, td_title, td_desc, td_owner, td_selection);
            //             //
            //         //

            //         cont_lessons.appendChild(row);
            //     }
                

            // } else {
            //     generateToast("searchError", "Notification", "Search", "Error: No Lessons Found");
            // }
        }
    };

    request.send("search="+search.value);
}

// Appending Functions
function appendRowLessons(row, id, lessonName, description, teacher, selection) {
    row.appendChild(id);
    row.appendChild(lessonName);
    row.appendChild(description);
    row.appendChild(teacher);
    row.appendChild(selection);
}
//