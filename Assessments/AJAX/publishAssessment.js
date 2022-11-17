function publishAssessment() {
    // Get Data
    window.$_GET = new URLSearchParams(location.search);
    var assessID = $_GET.get("assessID");

    var title = document.querySelector("#assessmentInTitle");
    if (title.value == "" || title.value == null) {generateToast("error", "Notification", "Save", "Please provide a title for the assessment"); return false;}

    var items = document.querySelector("#assessmentInItems");
    if (items.value < 1 || items.value > items.max) {generateToast("error", "Notification", "Save", "Number of items must be between 1 - "+items.max); return false;}

    var slides = document.querySelectorAll(".slideBtn");
        // Questions
    questionData = "";
    optionData = "";
    answerData = "";
    typeData = "";

    var qError = false;
    var optError = false;
    var ansError = false;

    slides.forEach(element => { // This will set all the data up
        var el = element.getAttribute("data-bs-target");
        questionType = document.querySelector(el).childNodes[0].firstChild.childNodes[1].value; // get the value of the select input

        // Questions
        question = document.querySelector(el).childNodes[1].firstChild; // select the contenteditable div only
        if (question.innerHTML == "") {generateToast("error", "Notification", "Save", "Please fill up all questions"); qError = true; return;}
        console.log(question.innerHTML);

        questionData += question.innerHTML + "|sepQuestion|";
        //

        // Types
        typeData += questionType + "|sepQuestion|";
        //

        // Options
            // Ask what kind of question type the option is
        option = document.querySelector(el).childNodes[2]; // Get the 3rd div (answers div)
        if (questionType == "Multiple Choice") {
            optionNodes = option.firstChild.firstChild.childNodes; // get all the options div of opt1-4
            for (i = 0; i < optionNodes.length; i++) {
                if (optionNodes[i].childNodes[1].value == "") {generateToast("error", "Notification", "Save", "Please fill up all Options"); optError = true; return;}
                console.log("optError: " + optError);
                
                optionData += optionNodes[i].childNodes[1].value + "|sepOption|"; // get all the values of option divs 1-4's value
            }
        } else {
            optionData += "null|sepOption|"; // set to null if the question type is identification
        }
        optionData += "|sepQuestion|";
        //

        // Answers
            // Get the value of the correct answer only
        if (questionType == "Multiple Choice") {
            optionNodes = option.firstChild.firstChild.childNodes; // Select all the children (divs) from the multiple choice container
            var answered = false;
            for (i = 0; i < optionNodes.length; i++) {
                if (optionNodes[i].childNodes[0].checked) {answerData += optionNodes[i].childNodes[1].value; answered = true;} // Only assign the value of the text input that's with the radio button in the div
                if (i+1 >= optionNodes.length && !answered) {generateToast("error", "Notification", "Save", "Please provide an answer to all questions"); ansError = true; return;}
            }
        } else {
            if (option.childNodes[1].firstChild.firstChild.value == "") {generateToast("error", "Notification", "Save", "Please provide an answer to all questions"); ansError = true; return;}

            answerData += option.childNodes[1].firstChild.firstChild.value; // Get the value of the text input of the Identification type
        }
        answerData += "|sepQuestion|";
        //
    });

            // Process data
                // Questions
    var processQuestion = questionData.split("&");
    questionData = "";

    for (i = 0; i < processQuestion.length; i++) {
        if (i+1 >= processQuestion.length) {
            questionData += processQuestion[i];
        } else {
            questionData += processQuestion[i] + "|amp|";
        }
    }           
                //

                // Options
    var processOption = optionData.split("&");
    optionData = "";

    for (i = 0; i < processOption.length; i++) {
        if (i+1 >= processOption.length) {
            optionData += processOption[i];
        } else {
            optionData += processOption[i] + "|amp|";
        }
    }
                //


                // Answers
    var processAnswer = answerData.split("&");
    answerData = "";

    for (i = 0; i < processAnswer.length; i++) {
        if (i+1 >= processAnswer.length) {
            answerData += processAnswer[i];
        } else {
            answerData += processAnswer[i] + "|amp|";
        }
    }
                //

            //

        //
    //

    if (qError == true) {
        return false;
    }

    if (optError == true) {
        return false;
    }

    if (ansError == true) {
        return false;
    }

    var request = new XMLHttpRequest();

    request.open("POST", "AJAX/publishAssessment.php");
    request.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

    request.onreadystatechange = function () {
        if (this.readyState === 4 && this.status === 200) {
            var result = this.response;
            console.log(result);

            if (result == "true") {
                generateToast("error", "Notification", "Publish", "Successfully Published Assessment");
            } else {
                generateToast("error", "Notification", "Publish", "Error: Failed to publish assessment");
            }
        }
    };

    request.send("assessID="+assessID+"&title="+title.value+"&items="+items.value+"&questionData="+questionData+"&optionData="+optionData+"&answerData="+answerData+"&typeData="+typeData);
}