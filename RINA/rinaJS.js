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


//Speech Recognition code block
const texts = document.querySelector(".texts");

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
    // console.log(text);

    //Commands / Queries
    if (e.results[0].isFinal) {

        //Q: Hello RINA
        if (text.includes("hello rina") || text.includes("hello RINA"))
        {
            console.log("Hello!");
            audioCall("../RINA/audio/okaeri.wav");
        }

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

        //A: Open Google
        // if (text.includes("open google") || text.includes("open Google")) // This needs to be removed (no function in the system)
        // {
        //     audioCall("../RINA/audio/wawawa.wav");
        //     console.log("opening Google...");
        //     window.open("https://www.google.com.ph");
        // }

        // Student Dashboard Things
            // Click Lesson / Go to Lessons
        if (text.toLowerCase().includes("click lessons")) {
            try {
                document.querySelector("#btn_lessons").click();
            } catch(e) {
                speechBubble.innerText = "Button does not exist";
            }
        }
            // Click Assessment / Go to Assessments
        if (text.toLowerCase().includes("click assessments")) {
            try {
                document.querySelector("#btn_assessments").click();
            } catch(e) {
                speechBubble.innerText = "Button does not exist";
            }
        }

        // Student Lessons Dashboard
            // Go back
        if (text.toLowerCase().includes("go back")) {
            try {
                document.querySelector("#btn_back").click();
            } catch(e) {
                speechBubble.innerText = "Button does not exist";
            }
        }
            // Select Lesson
        if (text.toLowerCase().includes("view")) {
            var lesson = text.split("view ")[1];
            console.log(lesson);
            try {
                var lessons = document.querySelectorAll(".card");
                console.log(lessons[0].childNodes[1].childNodes[2]);
                
                for(i = 0; i < lessons.length; i++) {
                    console.log(lessons[i].childNodes[1].childNodes[0].innerText.toLowerCase());
                    if (lessons[i].childNodes[1].childNodes[0].innerText.toLowerCase() == lesson) {
                        console.log("matched");
                        lessons[i].childNodes[1].childNodes[2].click();
                        speechBubble.innerText = "Lesson found";
                    }
                }
                speechBubble.innerText = "Lesson can't be found";
            } catch (e) {
                speechBubble.innerText = "Lesson can't be found";
            }
        }

        // Lesson Viewing
        if (text.toLowerCase().includes("turn page next")) {
            try {
                speechBubble.innerText = "";
                document.querySelector("#nextBTN").click();
            } catch (e) {
                speechBubble.innerText = "Button does not exist";
            }
        }

        if (text.toLowerCase().includes("turn page back")) {
            try {
                speechBubble.innerText = "";
                document.querySelector("#prevBTN").click();
            } catch (e) {
                speechBubble.innerText = "Button does not exist";
            }
        }

        // Students Assessments Dashboard
        if (text.toLowerCase().includes("take")) {
            var assessment = text.split("take ")[1];
            try {
                var assessments = document.querySelectorAll(".card");

                for (i = 0; i < assessments.length; i++) {
                    if (assessments[i].childNodes[1].childNodes[0].innerText.toLowerCase() == assessment) { // Checks on the assessment's title
                        assessments[i].childNodes[1].childNodes[2].click();
                        speechBubble.innerText = "Assessment found";
                    }
                }
                speechBubble.innerText = "Assessment can't be found";
            } catch (e) {
                speechBubble.innerText = "Assessment can't be found";
            }
        }

        // Taking Assessment
        // if (text.toLowerCase().includes("my answer is")) {
        //     var answer = text.split("my answer is ")[1];

        //     try {
        //         var choices = document.querySelectorAll(".choice");
        //         // console.log(choices);

        //         var modal = new bootstrap.Modal(document.querySelector("#rina_modalConfirm"));
        //         modal.show();

        //         document.querySelector("#cont_answerRina").innerText = answer;
        //     } catch (e) {
        //         speechBubble.innerText = "Option can't be found 1";
        //     }
        // }

        // if (text.toLowerCase().includes("confirm answer")) {
        //     var modal = document.querySelector("#rina_modalConfirm");
        //     console.log(modal.childNodes[1].childNodes[1].childNodes[5].childNodes[1]);
        //     try {
        //         var choices = document.querySelectorAll(".choice");

        //         var ansTxt = document.querySelector("#cont_answerRina").innerText;
        //         if (ansTxt.toLowerCase().includes("option number one") || ansTxt.toLowerCase().includes("option number 1")) {
        //             modal.childNodes[1].childNodes[1].childNodes[5].childNodes[1].click();
        //             choices[0].childNodes[1].click();
        //         } else if (ansTxt.toLowerCase().includes("option number two") || ansTxt.toLowerCase().includes("option number 2")) {
        //             modal.childNodes[1].childNodes[1].childNodes[5].childNodes[1].click();
        //             choices[1].childNodes[1].click();
        //         } else if (ansTxt.toLowerCase().includes("option number three") || ansTxt.toLowerCase().includes("option number 3")) {
        //             modal.childNodes[1].childNodes[1].childNodes[5].childNodes[1].click();
        //             choices[2].childNodes[1].click();
        //         } else if (ansTxt.toLowerCase().includes("option number four") || ansTxt.toLowerCase().includes("option number 4")) {
        //             modal.childNodes[1].childNodes[1].childNodes[5].childNodes[1].click();
        //             choices[3].childNodes[1].click();
        //         }
        //     } catch (e) {
        //         speechBubble.innerText = "Option can't be found 2";
        //     }
        // }

        // Logging Out
        if (text.toLowerCase().includes("rina log me out")) {
            try {
                var modal = new bootstrap.Modal(document.querySelector("#rina_modalConfirmLogout"));
                modal.show();
            } catch(e) {
                speechBubble.innerText = "Button does not exist";
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
                speechBubble.innerText = "Couldn't log out";
            }
        }

        if (text.toLowerCase().includes("cancel logout")) {
            try {
                var modal = document.querySelector("#rina_modalConfirmLogout");

                if (modal.style.display == "block") {
                    modal.childNodes[1].childNodes[1].childNodes[1].childNodes[3].click();
                }
            } catch (e) {
                speechBubble.innerText = "Couldn't cancel action";
            }
        }
    }
});

//Loop for Speech Recognition
recognition.addEventListener("end", () => {
    // only restart if rina is turned on as an option
    recognition.start();
});

// only start if rina is enabled
recognition.start();
