// Vars
var score = 0;

var questionItems = 0;

let questionPool = Array();
let questionOptions = Array();
let questionAnswers = Array();
let questionTypes = Array();

var currentQuestion = 0;
console.log("ran");
//

function loadQuestions() {
    // Vars
    window.$_GET = new URLSearchParams(location.search);
    var assessID = $_GET.get("assessID");
    //

    var request = new XMLHttpRequest();

    request.open("POST", "AJAX/Students/getQuestions.php");
    request.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

    request.onreadystatechange = function () {
        if (this.readyState === 4 && this.status === 200) {
            var result = this.response;
            console.log(result);

            if (result != null && result != "" && result != "[]") {
                var questions = JSON.parse(result);

                questionItems = questions[0]['numItems'].split("|sepData|")[0]; // This is how many questions will be asked (not how many questions there really are); also, it's using a global variable

                var pool = questions[0]['question'].split("|sepData|")[0]; // get the published questions
                var sepQuestions = pool.split("|sepQuestion|");
                var maxQuestionRange = sepQuestions.length-1; // Will be used in the randomization of questions

                var options = questions[0]['options'].split("|sepData|")[0];
                var sepOptions = options.split("|sepQuestion|");
                
                var answers = questions[0]['answer'].split("|sepData|")[0];
                var sepAnswers = answers.split("|sepQuestion|");

                var types = questions[0]['types'].split("|sepData|")[0];
                var sepTypes = types.split("|sepQuestion|");

                var pooler = Array();
                for (i = 0; i < maxQuestionRange; i ++) {
                    pooler.push(false);
                }

                for (i = 0; i < questionItems; i++) {
                    // Select a random Question here
                    // reroll if randNum is already taken
                    var randNum = Math.floor(Math.random() * maxQuestionRange); // randomize number from 0 to the max question range (number of actual questions from the pool)
                    while(pooler[randNum] == true) {
                        var randNum = Math.floor(Math.random() * maxQuestionRange); // randomize number from 0 to the max question range (number of actual questions from the pool)
                    }
                    console.log(randNum);
                    pooler[randNum] = true;

                    questionPool.push(sepQuestions[randNum]);
                    questionOptions.push(sepOptions[randNum]);
                    questionAnswers.push(sepAnswers[randNum]);
                    questionTypes.push(sepTypes[randNum]);
                }

                displayQuestion();

            } else {
                generateToast("error", "Notification", "Load", "Error: Quiz Failed to Load");
            }
        }
    };

    request.send("assessID="+assessID);
}

function displayQuestion() {
    var cont_questions = document.querySelector("#cont_question");

    var mcOpt1 = document.querySelector("#mc-opt1");
    var mcOpt2 = document.querySelector("#mc-opt2");
    var mcOpt3 = document.querySelector("#mc-opt3");
    var mcOpt4 = document.querySelector("#mc-opt4");

    var identAns = document.querySelector("#ident-ans");
    var identSub = document.querySelector("#ident-submit");

    cont_questions.innerText = questionPool[currentQuestion];

    if (questionTypes[currentQuestion] == "Multiple Choice") {
        mcOpt1.style.display = "block";
        mcOpt2.style.display = "block";
        mcOpt3.style.display = "block";
        mcOpt4.style.display = "block";

        identAns.style.display = "none";
        identSub.style.display = "none";

        var options = questionOptions[currentQuestion].split("|sepOption|");
        mcOpt1.innerText = options[0];
        mcOpt2.innerText = options[1];
        mcOpt3.innerText = options[2];
        mcOpt4.innerText = options[3];
    } else {
        mcOpt1.style.display = "none";
        mcOpt2.style.display = "none";
        mcOpt3.style.display = "none";
        mcOpt4.style.display = "none";

        identAns.style.display = "block";
        identSub.style.display = "block";
    }
    // console.log("test:"+questionPool.length);
}

function checkAnswer(targetElement) {
    targetElement = document.querySelector(targetElement);

    if (questionTypes[currentQuestion] == "Multiple Choice") {
        if (questionAnswers[currentQuestion] == targetElement.innerText) {
            score ++;
        }
    } else {
        if (questionAnswers[currentQuestion] == targetElement.value) {
            score ++;
        }

        var identAns = document.querySelector("#ident-ans");
        identAns.value = "";
    }

    currentQuestion++;

    if (currentQuestion >= questionItems) {
        finishQuiz();
    } else {
        displayQuestion();
    }
    console.log("checked");
}

function finishQuiz() {
    var cont_score = document.querySelector("#cont_score");
    cont_score.innerText = score;

    var modal = new bootstrap.Modal(document.querySelector("#finishModal"));    
    modal.show();
}