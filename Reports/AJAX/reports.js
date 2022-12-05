// Obsolete Commands
function getReports_obs() {
    // Search Data
    var search = document.querySelector("#searchStudents");
    search = search.value;
    //


    var request = new XMLHttpRequest();

    request.open("POST", "AJAX/getReports.php");
    request.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

    request.onreadystatechange = function () {
        if (this.readyState === 4 && this.status === 200) {
            var results = this.response;
            console.log(results);

            // Containers
            var cont_reports = document.querySelector("#cont_reports");
            var cont_modals = document.querySelector("#cont_modals");

            cont_reports.innerHTML = "";
            cont_modals.innerHTML = "";
            //

            if (results != null && results != "" && results != "[]") {
                var reports = JSON.parse(results);

                for (i = 0; i < reports.length; i++) {
                    // Rows
                    var row = createRowReports();

                    // Special Initialization
                    var studName = reports[i]['fname'] + " " + reports[i]['mname'] + " " + reports[i]['lname'];
                    var assessTitle = reports[i]['title'].split("|sepData|")[0];
                    var score = reports[i]['score'] + " / " + reports[i]['items'];
                    //

                    var td_id = createData(reports[i]['id']);
                    var td_student = createData(studName);
                    var td_assess = createData(assessTitle);
                    var td_score = createData(score);
                    var td_dateTaken = createData(reports[i]['dateTaken']);

                        // Append
                    appendRow(row, td_id, td_student, td_assess, td_score, td_dateTaken);
                        //

                    //

                    cont_reports.appendChild(row);
                }
            } else {
                generateToast("error", "Notification", "Search", "Error: No Reports Found");
            }
        }
    };

    request.send("search="+search);
}
// -- Obsolete Commands

// Display Command
function getReports() {
    var request = new XMLHttpRequest();

    window.$_GET = new URLSearchParams(location.search);
    var userID = $_GET.get("userID");

    request.open("POST", "AJAX/getReports.php");
    request.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

    request.onreadystatechange = function () {
        if (this.readyState === 4 && this.status === 200) {
            var result = this.response;
            console.log(result);

            try {
                var reports = JSON.parse(result);

                var cont_scores = document.querySelector("#cont_scores");
                cont_scores.innerHTML = "";

                for (i = 0; i < reports.length; i++) {
                    var row = createRow();
                    
                    var td_id = createData(reports[i]['id']);
                    var td_title = createData(reports[i]['title'].split("|sepData|")[0]);
                    var td_score = createData(reports[i]['score']);
                    var td_hpp = createData(reports[i]['highestPossible']); // hpp = Highest Possible Point
                    var td_dateTaken = createData(reports[i]['dateTaken']);

                    var scoreAve =  reports[i]['score'] / reports[i]['highestPossible'];

                    if (scoreAve >= 0.75) {
                        scoreAve = "Passed";
                    } else {
                        scoreAve = "Failed";
                    }

                    var td_status = createData(scoreAve);

                    row.appendChild(td_id);
                    row.appendChild(td_title);
                    row.appendChild(td_score);
                    row.appendChild(td_hpp);
                    row.appendChild(td_dateTaken);
                    row.appendChild(td_status);

                    cont_scores.appendChild(row);
                }
            } catch (e) {
                var cont_scores = document.querySelector("#cont_scores");
                cont_scores.innerHTML = "";

                var row = createRow();

                var txt = document.createTextNode("No Results Found!");
                row.appendChild(txt);

                cont_scores.appendChild(row);
                generateToast("errorReports", "Notification", "Results", "No Records Found");
            }
        }
    };

    request.send("userID="+userID);
}
//

// Admin Commands
function getSchools() {
    var request = new XMLHttpRequest();

    request.open("POST", "AJAX/getSchools.php");
    request.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

    request.onreadystatechange = function () {
        if (this.readyState === 4 && this.status === 200) {
            var result = this.response;

            try {
                var schools = JSON.parse(result);

                var cont_schools = document.querySelector("#cont_schools");
                cont_schools.innerHTML = "";
                
                for (i = 0; i < schools.length; i ++) {
                    var id = schools[i]['id'];
                    var schoolName = schools[i]['schoolName'];

                    var card = createCard("school-"+id, "", schoolName, "", "#", "Get Report");

                    cont_schools.appendChild(card);
                }
            } catch (e) {
                generateToast("errorSchools", "Notification", "Search", "Error: No Schools Found");
            }
        }
    };

    // request.send("schoolID="+schoolID);
    request.send();
}
// -- Admin Commands

// Principal Commands
function getSchool() { // This command needs a parameter for schoolID, but the session variable will be used in the server-side instead
    var request = new XMLHttpRequest();

    request.open("POST", "AJAX/getSchool.php");
    request.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

    request.onreadystatechange = function () {
        if (this.readyState === 4 && this.status === 200) {
            var result = this.response;

            try {
                var school = JSON.parse(result);

                var cont_school = document.querySelector("#cont_school");
                cont_school.innerHTML = ""; // reset the content of the container

                for (i = 0; i < school.length; i ++) {
                    var card = createCard("school-"+school[i]['id'], "", school[i]['schoolName'], "", "schoolReport.php?schoolID="+school[i]['id'], "Get Report", true); // Not sure about the column names; check later

                    // Append
                    cont_school.appendChild(card);
                }
            } catch (e) {
                generateToast("errorSchool", "Notification", "Search", "Error: No School Found");
            }
        }
    };

    request.send();
}

function getSections() { // This command also uses schoolID
    var request = new XMLHttpRequest();

    request.open("POST", "AJAX/getSections.php");
    request.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

    request.onreadystatechange = function () {
        if (this.readyState === 4 && this.status === 200) {
            var result = this.response;

            try {
                var sections = JSON.parse(result);

                var cont_sections = document.querySelector("#cont_sections");
                cont_sections.innerHTML = "";

                for (i = 0; i < sections.length; i++) {
                    var card = createCard("sections-"+sections[i]['id'], "", sections[i]['sectionName'], "", "#", "Get Report");

                    cont_sections.appendChild(card);
                }
            } catch (e) {
                generateToast("errorSections", "Notification", "Search", "Error: No Sections Found");
            }
        }
    };

    request.send();
}
// -- Principal Commands

// Teacher Commands
function getSection() { // This command needs a sectionID parameter, but will be using session variable on the server-side instead
    var request = new XMLHttpRequest();

    request.open("POST", "AJAX/getSection.php");
    request.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

    request.onreadystatechange = function () {
        if (this.readyState === 4 && this.status === 200) {
            var result = this.response;

            try {
                var section = JSON.parse(result);

                var cont_section = document.querySelector("#cont_section");
                cont_section.innerHTML = "";

                for (i = 0; i < section.length; i++) {
                    var card = createCard("section-"+section[i]['id'], "", section[i]['sectionName'], "", "#", "Get Reports");

                    cont_section.appendChild(card);
                }
            } catch(e) {
                generateToast("errorSection", "Notification", "Search", "Error: No Section Found");
            }
        }
    };

    request.send();
}

function getStudents() { // This also needs sectionID
    var request = new XMLHttpRequest();

    var search = document.querySelector("#searchStudents").value;

    request.open("POST", "AJAX/getStudents.php");
    request.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

    request.onreadystatechange = function () {
        if (this.readyState === 4 && this.status === 200) {
            var result = this.response;
            console.log(result);

            var cont_students = document.querySelector("#cont_students");
            cont_students.innerHTML = "";

            try {
                var students = JSON.parse(result);

                for (i = 0; i < students.length; i++) {
                    if (i%5 == 0) {
                        var cardGroup = createCardGroup();
                    }

                    if (i >= students.length) {i = 0;}

                    var card = createCard("students-"+students[i]['id'], "../mat_icons/tensai_profile.png", students[i]['fname'] + " " + students[i]['mname'] + " " + students[i]['lname'], "", "studentReport.php?userID="+students[i]['id'], "Get Reports", true);
                    
                    cardGroup.appendChild(card);
                    cont_students.appendChild(cardGroup);
                }
            } catch (e) {
                var txt = document.createTextNode("No Results Found");

                cont_students.appendChild(txt);
                generateToast("errorStudents", "Notification", "Search", "Error: No Students Found");
            }
        }
    };

    request.send("search="+search);
}
// -- Teacher Commands

// Download Report
function downloadReport() { // This uses the jsPDF & html2Canvas library to work (should be imported in the web page that uses this script)
    window.html2canvas = html2canvas;
    window.jsPDF = window.jspdf.jsPDF;

    var doc = new jsPDF('p', 'pt', 'a4');

    // Get element
    var elementHTML = document.querySelector("#cont_report");
    // console.log(elementHTML.innerHTML);
    var clean = DOMPurify.sanitize(elementHTML.innerHTML);
    // console.log(clean);

    // document.write();

    elementHTML.innerHTML = clean;
    console.log("innerHTML'd");
    // return null;

    var pagewidth = doc.internal.pageSize.getWidth() / 1.1;
    console.log(pagewidth);
    var pageheight = doc.internal.pageSize.getHeight();
    console.log(pagewidth);

    var xval = doc.internal.pageSize.getWidth() - pagewidth;
    var yval = doc.internal.pageSize.getHeight() - pageheight;

    // var imgHeight = elementHTML.height() * 25.4 / 96;

    doc.html(clean, {
        callback:function(doc) {
            var date = new Date().toLocaleDateString();
            doc.save('report-'+date);
        },
        orientation: 'l',
        x: 0,
        y: 0,
        width: pagewidth,
        height: pageheight,
        windowWidth:597.6,
        windowHeight: 842.4
    });
}

// -- Download Report

// Appenders
function appendRow(row, id, student, assessment, score, dateTaken) {
    row.appendChild(id);
    row.appendChild(student);
    row.appendChild(assessment);
    row.appendChild(score);
    row.appendChild(dateTaken);
}
//