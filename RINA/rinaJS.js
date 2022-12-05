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

function toggleBubble() {
    var rina = document.querySelector("#rina_bubble");
    if (rina.style.display == "none") {
        rina.style.display = "block";
    } else {
        rina.style.display = "none";
    }
    // rina.style.display = rina.style.display == "none" ? "block" : "none";
    console.log("bubble toggled " + rina.style.display);
    takeCommand = !takeCommand;
    console.log(takeCommand);
}


//Speech Recognition code block
document.querySelector("#rina_bubble").style.display = "none";
var takeCommand = false;

window.SpeechRecognition = window.SpeechRecognition || window.webkitSpeechRecognition;

const recognition = new SpeechRecognition();
recognition.interimResults = true;

recognition.addEventListener("result", (e) => {
  const text = Array.from(e.results)
    .map((result) => result[0])
    .map((result) => result.transcript)
    .join("");

    // Insert DOM editing here to change text on RINA speech bubble
    speechBubble = document.querySelector("#rina_speech")
    speechBubble.innerText = text;
    console.log(text);

    //Commands / Queries
    if (e.results[0].isFinal) {

        //Q: Hello RINA
        if (text.toLowerCase().includes("hello rina"))
        {
            console.log("Hello!");
            audioCall("./audio/okaeri.wav");

            //Speech wrap block checker
            var dsp = document.getElementById("rina_bubble");
            document.getElementById("rina_click").click();

            //takeCommand boolean to 'true' value
            // toggleBubble();
        }

        if (takeCommand) {
            //Q: What's your name? / Who are you?
            if (text.includes("what's your name") || text.includes("what is your name") || text.includes("who are you"))
            {
                console.log("My name is RINA, your personal virtual assistant!");
                audioCall("../RINA/audio/wakuwaku.wav");
            }

            //Q: How are you?
            if (text.includes("how are you"))
            {
                console.log("I'm fine and doing great!");
                audioCall("../RINA/audio/genki.wav");
            }

            // Student Dashboard Things
                // Click Lesson / Go to Lessons
            if (text.toLowerCase().includes("click lessons")) {
                try {
                    document.querySelector("#btn_lessons").click();
                } catch(e) {
                    speechBubble.innerText = "RINA SAYS: Button does not exist";
                }
            }

                // Click Assessment / Go to Assessments
            if (text.toLowerCase().includes("click assessments")) {
                try {
                    document.querySelector("#btn_assessments").click();
                } catch(e) {
                    speechBubble.innerText = "RINA SAYS: Button does not exist";
                }
            }

            // Student Lessons Dashboard
                // Go back
            if (text.toLowerCase().includes("go back")) {
                try {
                    document.querySelector("#btn_back").click();
                } catch(e) {
                    speechBubble.innerText = "RINA SAYS: Button does not exist";
                }
            }
                // Select Lesson
            if (text.toLowerCase().includes("view")) {
                var lesson = text.split("view ")[1];
                console.log(lesson);
                try {
                    var lessons = document.querySelectorAll(".lesson-card");
                    console.log(lessons[0].childNodes[1].childNodes[2]);
                    
                    for(i = 0; i < lessons.length; i++) {
                        console.log(lessons[i].childNodes[1].childNodes[0].innerText.toLowerCase());
                        if (lessons[i].childNodes[1].childNodes[0].innerText.toLowerCase() == lesson) {
                            console.log("matched");
                            console.log(lessons[i]);
                            lessons[i].click();
                            // lessons[i].childNodes[1].childNodes[2].click();
                            speechBubble.innerText = "RINA SAYS: Lesson found";
                        }
                    }
                    // speechBubble.innerText = "Lesson can't be found";
                } catch (e) {
                    speechBubble.innerText = "RINA SAYS: Lesson can't be found";
                }
            }

            if (text.toLowerCase().includes("go to lesson")) {
                try {
                    var btn = document.getElementById("lesson_url");
                    if (!btn.childNodes[1].disabled) {btn.click();}
                    else {speechBubble.innerText = "RINA SAYS: Select a lesson first";}
                    // console.log(btn.childNodes[1].disable);
                } catch (e) {
                    speechBubble.innerText = "RINA SAYS: No selected lesson";
                }
            }

            // Lesson Viewing
            if (text.toLowerCase().includes("turn page next")) {
                try {
                    speechBubble.innerText = "";
                    document.querySelector("#nextBTN").click();
                } catch (e) {
                    speechBubble.innerText = "RINA SAYS: Button does not exist";
                }
            }

            if (text.toLowerCase().includes("turn page back")) {
                try {
                    speechBubble.innerText = "";
                    document.querySelector("#prevBTN").click();
                } catch (e) {
                    speechBubble.innerText = "RINA SAYS: Button does not exist";
                }
            }

            if (text.toLowerCase().includes("view lesson details")) {
                try {
                    speechBubble.innerText = "";
                    document.querySelector("#btn_info").click();
                } catch (e) {
                    speechBubble.innerText = "RINA SAYS: Button does not exist";
                }
            }

            if (text.toLowerCase().includes("close lesson details")) {
                try {
                    speechBubble.innerText = "";
                    document.querySelector("#btn_infoClose").click();
                    toggleBubble();
                } catch (e) {
                    speechBubble.innerText = "RINA SAYS: Button does not exist";
                }
            }

            // Students Assessments Dashboard
            if (text.toLowerCase().includes("take")) {
                var assessment = text.split("take ")[1];
                try {
                    var assessments = document.querySelectorAll(".assessment-card");

                    for (i = 0; i < assessments.length; i++) {
                        console.log(assessments[i].childNodes[2].firstChild.firstChild);
                        if (assessments[i].childNodes[1].childNodes[0].innerText.toLowerCase() == assessment) { // Checks on the assessment's title
                            assessments[i].childNodes[2].firstChild.firstChild.click();
                            speechBubble.innerText = "RINA SAYS: Assessment found";
                        }
                    }
                    // speechBubble.innerText = "RINA SAYS: Assessment can't be found";
                } catch (e) {
                    speechBubble.innerText = "RINA SAYS: Assessment can't be found";
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
                        document.getElementById("rina_click").click();
                    }
                } catch (e) {
                    speechBubble.innerText = "RINA SAYS: Couldn't cancel action";
                }
            }

            // Taking Assessment
            if (text.toLowerCase().includes("my answer is")) {
                var answer = text.split("my answer is ")[1];

                try {
                    var modal = new bootstrap.Modal(document.querySelector("#rina_modalConfirm"));

                    document.querySelector("#cont_answerRina").innerText = answer;
                    switch (questionTypes[currentQuestion]) {
                        case "Identification":
                            var textIn = document.querySelector("#ident-ans");
                            textIn.value = answer;
                            modal.show();
                        break;
                        case "Multiple Choice":
                            var choices = document.querySelectorAll(".choice");
                            // console.log(choices);
                            modal.show();
                        break;
                        case "True / False":
                            var choices = document.querySelectorAll(".choice");
                            modal.show();
                        break;
                    }
                    
                } catch (e) {
                    speechBubble.innerText = "RINA SAYS: Option can't be found";
                }
            }

            if (text.toLowerCase().includes("confirm answer")) {
                var modal = document.querySelector("#rina_modalConfirm");
                // console.log(modal.childNodes[1].childNodes[1].childNodes[5].childNodes[1]);
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
                    speechBubble.innerText = "RINA SAYS: Option can't be found";
                }
            }

            if (text.toLowerCase().includes("cancel answer")) {
                var modal = document.querySelector("#rina_modalConfirm");
                modal.childNodes[1].childNodes[1].childNodes[1].childNodes[3].click()

            }

            if (text.toLowerCase().includes("finish assessment")) {
                if (isFinished) {
                    var modal = document.querySelector("#finishModal");
                    // console.log(modal.childNodes[1].childNodes[1].childNodes[5].childNodes[1]);
                    modal.childNodes[1].childNodes[1].childNodes[5].childNodes[1].click();
                } else {
                    speechBubble.innerText = "RINA SAYS: You can't do that yet";
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
