function addReport() {
    // Get Data from URL
    window.$_GET = new URLSearchParams(location.search);
    var assessID = $_GET.get("assessID");
    var studID = $_GET.get("studentID");
    //
    var score = document.querySelector("#cont_score");

    // Disable the button
    var btn = document.querySelector("#btn_finish");
    btn.disabled = true;
    btn.innerText = "Processing...";
    //

    var request = new XMLHttpRequest();

    request.open("POST", "../Reports/AJAX/addReport.php");
    request.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

    request.onreadystatechange = function () {
        if (this.readyState === 4 && this.status === 200) {
            var result = this.response
            console.log(result);

            if (result == "true") {
                generateToast("error", "Notification", "Add", "Successfully Saved Score");
                window.location.href="assessmentDashboard.php";
            } else {
                generateToast("error", "Notification", "Add", "Error: Failed to Save Score");
                btn.innerText = "GO HOME";
                btn.classList.replace("btn-palette2", "btn-redcolor");
                btn.parentNode.setAttribute("href", "assessmentDashboard.php");
                btn.disabled = false;
            }
        }
    };

    request.send("studentID="+studID+"&assessID="+assessID+"&score="+score.innerText+"&items="+questionItems); // questionItems came from quizer.js after loading questions
}