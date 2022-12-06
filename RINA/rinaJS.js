// Text to Speech

let synth = speechSynthesis,
isSpeaking = true;

function textToSpeech(text){
    let utterance = new SpeechSynthesisUtterance(text);
    for(let voice of synth.getVoices()){
        if(voice.name === "Google US English"){
            utterance.voice = voice;
        }
    }

    synth.speak(utterance);
    console.log("Speaking Text-to-Speech");
}

// Speech Recognition

var takeCommand = false;

//btn Log tester
function logger(){
    console.log("Test Start");
    recognition.start();
}

//audioCall function
function audioCall(filename){
    // console.log("audioCall function...");
    var audio = new Audio(filename);
    audio.play();
}

function manualToggleBubble() {
    rinaReply = document.querySelector("#rina_reply");

    if (isToggledBubble()) {
        rinaReply.innerText = "Call me again when you need anything";
        textToSpeech(rinaReply.innerText);

        untoggleBubble();
        takeCommand = false;
    } else {
        rinaReply.innerText = "Hello! How can I help you?";
        textToSpeech(rinaReply.innerText);

        toggleBubble();
        takeCommand = true;
    }
    console.log(takeCommand);
}

function toggleBubble() {
    var rina = document.querySelector("#rina_bubble");
    rina.style.display = "block";
}

function untoggleBubble() {
    var rina = document.querySelector("#rina_bubble");
    rina.style.display = "none";
}

function isToggledBubble() {
    var rina = document.querySelector("#rina_bubble");
    if (rina.style.display == "block") {
        return true;
    }

    return false;
}

document.querySelector("#rina_bubble").style.display = "none";

//Speech Recognition code block
function callRINA() {

    window.SpeechRecognition = window.SpeechRecognition || window.webkitSpeechRecognition;

    const recognition = new SpeechRecognition();
    recognition.interimResults = true;

    recognition.addEventListener("result", (e) => {
        const text = Array.from(e.results)
        .map((result) => result[0])
        .map((result) => result.transcript)
        .join("");

        // Insert DOM editing here to change text on RINA speech bubble
        rinaReply = document.querySelector("#rina_reply");

        speechBubble = document.querySelector("#rina_speech")
        speechBubble.innerText = text;
        console.log(text);

        //Commands / Queries
        if (e.results[0].isFinal) {

            //Q: Hello RINA
            if (text.toLowerCase().includes("hello rina"))
            {
                // console.log("Hello!");
                // audioCall("./audio/okaeri.wav");

                //Speech wrap block checker
                var dsp = document.getElementById("rina_bubble");

                //takeCommand boolean to 'true' value
                // if (takeCommand == false) {takeCommand = toggleBubble(takeCommand);}
                // takeCommand = toggleBubble(takeCommand);
                if (!isToggledBubble()) {
                    toggleBubble();
                }
                takeCommand = true;

                rinaReply.innerText = "Hello! How can I help?";
                textToSpeech(rinaReply.innerText);
            }

            if (takeCommand) {
                //Q: What's your name? / Who are you?
                if (text.includes("what's your name") || text.includes("what is your name") || text.includes("who are you"))
                {
                    console.log("My name is RINA, your personal virtual assistant!");
                    // audioCall("../RINA/audio/wakuwaku.wav");
                    rinaReply.innerText = "My name is RINA, your personal virtual assistant!";

                    textToSpeech(rinaReply.innerText);

                }

                //Q: How are you?
                if (text.includes("how are you"))
                {

                    // audioCall("../RINA/audio/genki.wav");
                    rinaReply.innerText = "I'm fine and doing great!";

                    textToSpeech(rinaReply.innerText);
                    console.log("I'm fine and doing great!");
                }

                // Disabling RINA
                if (text.toLowerCase().includes("bye rina") || text.toLowerCase().includes("thanks rina")) {
                    rinaReply.innerText = "Call me again if you need anything";
                    textToSpeech(rinaReply.innerText);

                    var dsp = document.getElementById("rina_bubble");

                    if (isToggledBubble()) {
                        untoggleBubble();
                    }
                    
                    takeCommand = false;
                }

                // Student Dashboard Things
                    // Click Lesson / Go to Lessons
                if (text.toLowerCase().includes("click lessons")) {
                    try {
                        rinaReply.innerText = "Going to Lessons dashboard";
                        textToSpeech(rinaReply.innerText);
                        

                        document.querySelector("#btn_lessons").click();
                    } catch(e) {
                        rinaReply.innerText = "Sorry, that button does not exist";
                        textToSpeech(rinaReply.innerText);
                        // speechBubble.innerText = "RINA SAYS: Button does not exist";
                    }
                }

                    // Click Assessment / Go to Assessments
                if (text.toLowerCase().includes("click assessments")) {
                    try {
                        rinaReply.innerText = "Going to Assessments dashboard";
                        textToSpeech(rinaReply.innerText);

                        document.querySelector("#btn_assessments").click();
                    } catch(e) {
                        rinaReply.innerText = "Sorry, that button does not exist";
                        textToSpeech(rinaReply.innerText);
                        // speechBubble.innerText = "RINA SAYS: Button does not exist";
                    }
                }

                // Student Lessons Dashboard
                    // Go back
                if (text.toLowerCase().includes("go back")) {
                    try {
                        rinaReply.innerText = "Going back";
                        textToSpeech(rinaReply.innerText);
                        
                        document.querySelector("#btn_back").click();
                    } catch(e) {
                        rinaReply.innerText = "Sorry, that button does not exist";
                        textToSpeech(rinaReply.innerText);
                        // speechBubble.innerText = "RINA SAYS: Button does not exist";
                    }
                }
                    // Select Lesson
                if (text.toLowerCase().includes("view")) {
                    if (window.location.href == "https://tensaiedu.online/Lessons/dashboard.php") {
                        var lesson = text.split("view ")[1];
                        console.log(lesson);
                        try {
                            var lessons = document.querySelectorAll(".lesson-card");
                            console.log(lessons[0].childNodes[1].childNodes[2]);
                            
                            for(i = 0, matched = false; i < lessons.length; i++) {
                                console.log(lessons[i].childNodes[1].childNodes[0].innerText.toLowerCase());
                                if (lessons[i].childNodes[1].childNodes[0].innerText.toLowerCase() == lesson) {
                                    matched = true;
                                    console.log("matched");
                                    console.log(lessons[i]);
                                    lessons[i].click();
                                    // lessons[i].childNodes[1].childNodes[2].click();
                                    rinaReply.innerText = "I have found "+ lessons[i].childNodes[1].childNodes[0].innerText;
                                    textToSpeech(rinaReply.innerText);
                                }
                                if (i+1 >= lessons.length && !matched) {
                                    escapeToCatch(); // This is an intentional non-existent function that helps escape to the catch statement block;
                                }
                            }
                            // speechBubble.innerText = "Lesson can't be found";
                        } catch (e) {
                            rinaReply.innerText = "Sorry, I was not able to find that lesson";
                            textToSpeech(rinaReply.innerText);
                            // speechBubble.innerText = "RINA SAYS: Lesson can't be found";
                        }
                    }
                    
                }

                if (text.toLowerCase().includes("go to lesson")) {
                    if (window.location.href == "https://tensaiedu.online/Lessons/dashboard.php") {
                        try {
                            var btn = document.getElementById("lesson_url");
                            if (!btn.childNodes[1].disabled) {
                                btn.click();

                                rinaReply.innerText = "Let's view this lesson";
                                textToSpeech(rinaReply.innerText);
                            }
                            else {escapeToCatch();} // This is an intentional non-existent function that helps escape to the catch statement block;
                            // console.log(btn.childNodes[1].disable);
                        } catch (e) {
                            rinaReply.innerText = "There is no selected lesson. Please select one first";
                            textToSpeech(rinaReply.innerText);
    
                            // speechBubble.innerText = "RINA SAYS: No selected lesson";
                        }
                    } else {
                        rinaReply.innerText = "You should go to lessons dashboard first";
                        textToSpeech(rinaReply.innerText);
                    }
                    
                }

                // Lesson Viewing
                if (text.toLowerCase().includes("turn page next")) {
                    if (window.location.href.includes("https://tensaiedu.online/Lessons/viewer.php")) {
                        try {
                            rinaReply.innerText = "Turning to the next page";
                            textToSpeech(rinaReply.innerText);

                            speechBubble.innerText = "";
                            document.querySelector("#nextBTN").click();
                        } catch (e) {
                            rinaReply.innerText = "Sorry, that button does not exist";
                            textToSpeech(rinaReply.innerText);
                            // speechBubble.innerText = "RINA SAYS: Button does not exist";
                        }
                    } else {
                        rinaReply.innerText = "You should go and view a lesson first";
                        textToSpeech(rinaReply.innerText);
                    }
                    
                }

                if (text.toLowerCase().includes("turn page back")) {
                    if (window.location.href.includes("https://tensaiedu.online/Lessons/viewer.php")) {
                        try {
                            rinaReply.innerText = "Turning to the previous page";
                            textToSpeech(rinaReply.innerText);

                            speechBubble.innerText = "";
                            document.querySelector("#prevBTN").click();
                        } catch (e) {
                            rinaReply.innerText = "Sorry, that button does not exist";
                            textToSpeech(rinaReply.innerText);
                            // speechBubble.innerText = "RINA SAYS: Button does not exist";
                        }
                    } else {
                        rinaReply.innerText = "You should go and view a lesson first";
                        textToSpeech(rinaReply.innerText);
                    }
                    
                }

                if (text.toLowerCase().includes("view lesson details")) {
                    if (window.location.href.includes("https://tensaiedu.online/Lessons/viewer.php")) {
                        try {
                            rinaReply.innerText = "Opening lesson details";
                            textToSpeech(rinaReply.innerText);

                            speechBubble.innerText = "";
                            document.querySelector("#btn_info").click();
                        } catch (e) {
                            rinaReply.innerText = "Sorry, that button does not exist";
                            textToSpeech(rinaReply.innerText);
                            // speechBubble.innerText = "RINA SAYS: Button does not exist";
                        }
                    } else {
                        rinaReply.innerText = "You should go and view a lesson first";
                        textToSpeech(rinaReply.innerText);
                    }
                }

                if (text.toLowerCase().includes("close lesson details")) {
                    if (window.location.href.includes("https://tensaiedu.online/Lessons/viewer.php")) {
                        try {
                            rinaReply.innerText = "Closing lesson details";
                            textToSpeech(rinaReply.innerText);

                            speechBubble.innerText = "";
                            document.querySelector("#btn_infoClose").click();
                            
                            untoggleBubble();
                            takeCommand = false;
                        } catch (e) {
                            rinaReply.innerText = "Sorry, that button does not exist";
                            textToSpeech(rinaReply.innerText);
                            // speechBubble.innerText = "RINA SAYS: Button does not exist";
                        }
                    }
                }

                // Students Assessments Dashboard
                if (text.toLowerCase().includes("take")) {
                    if (window.location.href == "https://tensaiedu.online/Assessments/dashboard.php") {
                        var assessment = text.split("take ")[1];
                        try {
                            var assessments = document.querySelectorAll(".assessment-card");

                            for (i = 0, matched = false; i < assessments.length; i++) {
                                console.log(assessments[i].childNodes[2].firstChild.firstChild);
                                if (assessments[i].childNodes[1].childNodes[0].innerText.toLowerCase() == assessment) { // Checks on the assessment's title
                                    matched = true;
                                    assessments[i].childNodes[2].firstChild.firstChild.click();
                                    rinaReply.innerText = "I have found " + assessments[i].childNodes[1].childNodes[0].innerText;
                                    textToSpeech(rinaReply.innerText);
                                    // speechBubble.innerText = "RINA SAYS: Assessment found";
                                }
                                if (i+1 >= assessments.length && !matched) {
                                    rinaReply.innerText = "Sorry, I was not able to find that assessment";
                                    textToSpeech(rinaReply.innerText);
                                }
                            }
                            // speechBubble.innerText = "RINA SAYS: Assessment can't be found";
                        } catch (e) {
                            rinaReply.innerText = "Sorry, I was not able to find that assessment";
                            textToSpeech(rinaReply.innerText);
                            // speechBubble.innerText = "RINA SAYS: Assessment can't be found";
                        }
                    } else {
                        rinaReply.innerText = "You should go to assessments dashboard first";
                        textToSpeech(rinaReply.innerText);
                    }
                }

                // Logging Out
                if (text.toLowerCase().includes("rina log me out")) {
                    try {
                        var modal = new bootstrap.Modal(document.querySelector("#rina_modalConfirmLogout"));
                        modal.show();
                    } catch(e) {
                        speechBubble.innerText = "RINA SAYS: Button does not exist";
                    }
                }

                if (text.toLowerCase().includes("confirm logout")) {
                    try {
                        var modal = document.querySelector("#rina_modalConfirmLogout");
                        // var modal = new bootstrap.Modal(document.querySelector("#rina_modalConfirmLogout"));

                        if (modal.style.display == "block") {
                            document.querySelector("#btn_logout").click();
                        }
                    } catch (e) {
                        speechBubble.innerText = "RINA SAYS: Couldn't log out";
                    }
                }

                if (text.toLowerCase().includes("cancel logout")) {
                    try {
                        var modal = document.querySelector("#rina_modalConfirmLogout");

                        if (modal.style.display == "block") {
                            modal.childNodes[1].childNodes[1].childNodes[1].childNodes[3].click();
                            
                            var dsp = document.getElementById("rina_bubble");

                            untoggleBubble();
                            takeCommand = false;

                            // document.getElementById("rina_click").click();
                        }
                    } catch (e) {
                        speechBubble.innerText = "RINA SAYS: Couldn't cancel action";
                    }
                }

                // Taking Assessment
                if (text.toLowerCase().includes("my answer is")) {
                    if (window.location.href.includes("https://tensaiedu.online/Assessments/quiz.php")) {
                        var answer = text.split("my answer is ")[1];

                        try {
                            var modal = new bootstrap.Modal(document.querySelector("#rina_modalConfirm"));
    
                            ansTxt = document.querySelector("#cont_answerRina");
                            ansTxt.innerText = answer;
                            console.log(ansTxt.innerText);
                            switch (questionTypes[currentQuestion]) {
                                case "Identification":
                                    if (ansTxt.innerText != "undefined") {
                                        var textIn = document.querySelector("#ident-ans");
                                        textIn.value = answer;
                                        modal.show();

                                        rinaReply.innerText = "Are you sure with this answer?";
                                        textToSpeech(rinaReply.innerText);
                                    }
                                break;
                                case "Multiple Choice":
                                    if (ansTxt.innerText.toLowerCase().includes("option number one") || ansTxt.innerText.toLowerCase().includes("option number two") || ansTxt.innerText.toLowerCase().includes("option number three") || ansTxt.innerText.toLowerCase().includes("option number four") || ansTxt.innerText.toLowerCase().includes("option number 1") || ansTxt.innerText.toLowerCase().includes("option number 2") || ansTxt.innerText.toLowerCase().includes("option number 3") || ansTxt.innerText.toLowerCase().includes("option number 4")) {
                                        modal.show();
                                        rinaReply.innerText = "Are you sure with this answer?";
                                        textToSpeech(rinaReply.innerText);
                                    }
                                    // var choices = document.querySelectorAll(".choice");
                                    // console.log(choices);
                                    
                                break;
                                case "True / False":
                                    // var choices = document.querySelectorAll(".choice");
                                    if (ansTxt.innerText.toLowerCase().includes("true") || ansTxt.innerText.toLowerCase().includes("false")) {
                                        modal.show();
                                        rinaReply.innerText = "Are you sure with this answer?";
                                        textToSpeech(rinaReply.innerText);
                                    }
                                break;
                            }
                            
                        } catch (e) {
                            rinaReply.innerText = "Sorry, but that option is not listed";
                            textToSpeech(rinaReply.innerText);
                            // speechBubble.innerText = "RINA SAYS: Option can't be found";
                        }
                    }
                    
                }

                if (text.toLowerCase().includes("confirm answer")) {
                    var modal = document.querySelector("#rina_modalConfirm");
                    // console.log(modal.childNodes[1].childNodes[1].childNodes[5].childNodes[1]);
                    if (modal.style.display == "block") {
                        try {
                            var choices = document.querySelectorAll(".choice");
    
                            var ansTxt = document.querySelector("#cont_answerRina").innerText;
    
                            switch (questionTypes[currentQuestion]) {
                                case "Identification":
                                    modal.childNodes[1].childNodes[1].childNodes[5].childNodes[1].click();
                                    document.querySelector("#ident-submit").click();
                                break;
                                case "Multiple Choice":
                                    if (ansTxt.toLowerCase().includes("option number one") || ansTxt.toLowerCase().includes("option number 1")) {
                                        modal.childNodes[1].childNodes[1].childNodes[5].childNodes[1].click();
                                        choices[0].childNodes[1].click();
                                    } else if (ansTxt.toLowerCase().includes("option number two") || ansTxt.toLowerCase().includes("option number 2")) {
                                        modal.childNodes[1].childNodes[1].childNodes[5].childNodes[1].click();
                                        choices[1].childNodes[1].click();
                                    } else if (ansTxt.toLowerCase().includes("option number three") || ansTxt.toLowerCase().includes("option number 3")) {
                                        modal.childNodes[1].childNodes[1].childNodes[5].childNodes[1].click();
                                        choices[2].childNodes[1].click();
                                    } else if (ansTxt.toLowerCase().includes("option number four") || ansTxt.toLowerCase().includes("option number 4")) {
                                        modal.childNodes[1].childNodes[1].childNodes[5].childNodes[1].click();
                                        choices[3].childNodes[1].click();
                                    }
                                break;
                                case "True / False":
                                    if (ansTxt.toLowerCase().includes("true")) {
                                        modal.childNodes[1].childNodes[1].childNodes[5].childNodes[1].click();
                                        choices[4].childNodes[1].click();
                                    } else if (ansTxt.toLowerCase().includes("false")) {
                                        console.log(choices[5].childNodes);
                                        modal.childNodes[1].childNodes[1].childNodes[5].childNodes[1].click();
                                        choices[5].childNodes[1].click();
                                    }
                                break;
                            }
                        } catch (e) {
                            rinaReply.innerText = "Sorry, but that option is not on the list";
                            textToSpeech(rinaReply.innerText);
                            // speechBubble.innerText = "RINA SAYS: Option can't be found";
                        }
                    }
                    
                }

                if (text.toLowerCase().includes("cancel answer")) {
                    var modal = document.querySelector("#rina_modalConfirm");

                    if (modal.style.display == "block") {
                        var modal = document.querySelector("#rina_modalConfirm");
                        modal.childNodes[1].childNodes[1].childNodes[1].childNodes[3].click();
                    }

                }

                if (text.toLowerCase().includes("finish assessment")) {
                    if (isFinished) {
                        var modal = document.querySelector("#finishModal");
                        // console.log(modal.childNodes[1].childNodes[1].childNodes[5].childNodes[1]);
                        if (modal.style.display == "block") {
                            rinaReply.innerText = "Good job on finishing the quiz";
                            textToSpeech(rinaReply.innerText);
                            modal.childNodes[1].childNodes[1].childNodes[5].childNodes[1].click();
                        }
                    } else {
                        rinaReply.innerText = "You can't do that yet";
                        textToSpeech(rinaReply.innerText);
                        // speechBubble.innerText = "RINA SAYS: You can't do that yet";
                    }
                    
                }
            }

            
        }
    });

    //Loop for Speech Recognition
    recognition.addEventListener("end", () => {
        // only restart if rina is turned on as an option
        recognition.start();
        console.log("ended");
    });

    // only start if rina is enabled
    recognition.start();
    console.log("started");
}