<?php

class questionManager {
    // Vars
    private $db;
    //

    // Built-in
    function __construct($db) {
        $this->db = $db;
    }
    //

    // Functions
    function displayQuestions($assessID) {
        // Clean SQL Injection
        $assessID = mysqli_real_escape_string($this->db, $assessID);

        //

        $sel = "SELECT * FROM matQuestions WHERE assessmentID = $assessID;";
        $selQ = $this->db->query($sel);

        if ($selQ->num_rows > 0) {
            $json_string = "";

            echo "[";

            while ($assessment = $selQ->fetch_assoc()) {
                $json_string .= json_encode($assessment) . ",";
            }

            echo rtrim($json_string, ",");
            echo "]";
        }
    }

    function displayAssessment($assessID) {
        // Clean SQL Injection
        $assessID = mysqli_real_escape_string($this->db, $assessID);

        //

        $sel = "SELECT * FROM matAssessments WHERE id = $assessID;";
        $selQ = $this->db->query($sel);
        
        if ($selQ->num_rows > 0) {
            $json_string = "";

            echo "[";

            while ($assessment = $selQ->fetch_assoc()) {
                $json_string .= json_encode($assessment) . ",";
            }

            echo rtrim($json_string, ",");
            echo "]";
        }

    }

    function save($assessID, $title, $items, $questionData, $optionData, $answerData, $typeData) {
        // Clean SQL Injection
        $assessID = mysqli_real_escape_string($this->db, $assessID);
        $title = mysqli_real_escape_string($this->db, $title);
        $items = mysqli_real_escape_string($this->db, $items);
        $questionData = mysqli_real_escape_string($this->db, $questionData);
        $optionData = mysqli_real_escape_string($this->db, $optionData);
        $answerData = mysqli_real_escape_string($this->db, $answerData);
        $typeData = mysqli_real_escape_string($this->db, $typeData);
        //

        // Get Previous Saved Data
        $selAssessment = "SELECT * FROM matAssessments WHERE id = $assessID;";
        $selAQ = $this->db->query($selAssessment);

        if ($selAQ->num_rows > 0) {
            $assessment = $selAQ->fetch_assoc(); // gets the data from the assessment being edited
            $status = $assessment['status'];

            // Version Control
            $sepTitle = explode("|sepData|", $assessment['title']);
            $pubDraftTitle = $sepTitle[0] . "|sepData|" . $title;

            $sepItems = explode("|sepData|", $assessment['questions']);
            $pubDraftItems = $sepItems[0] . "|sepData|" . $items;
            //

            if ($status == "Published") {
                $updateAssessment = "UPDATE matAssessments SET title = '$pubDraftTitle', questions = '$pubDraftItems', status = 'Published/Draft', dateUpdated = now() WHERE id = $assessID;";
            } else {
                $updateAssessment = "UPDATE matAssessments SET title = '$pubDraftTitle', questions = '$pubDraftItems', dateUpdated = now() WHERE id = $assessID;";
            }

            if ($this->db->query($updateAssessment)) { // updates the assessment
                // Get all previous saved questions from the database
                $selQuestions = "SELECT * FROM matQuestions WHERE assessmentID = $assessID;";
                $selQQ = $this->db->query($selQuestions);

                if ($selQQ->num_rows > 0) {
                    $question = $selQQ->fetch_assoc();

                    // Version Control
                    $publishedQuestions = $question['question'];
                    $publishedOptions = $question['options'];
                    $publishedAnswers = $question['answer'];

                    $sepQuestions = explode("|sepData|", $publishedQuestions);
                    $pubDraftQuestions = $sepQuestions[0] . "|sepData|" . $questionData;

                    $sepOptions = explode("|sepData|", $question['options']);
                    $pubDraftOptions = $sepOptions[0] . "|sepData|" . $optionData;

                    $sepAnswers = explode("|sepData|", $question['answer']);
                    $pubDraftAnswers = $sepAnswers[0] . "|sepData|" . $answerData;

                    $sepTypes = explode("|sepData|", $question['types']);
                    $pubDraftTypes = $sepTypes[0] . "|sepData|" . $typeData;

                    //

                    // update questions, options, and answers
                    $updateQuestions = "UPDATE matQuestions SET
                    question = '$pubDraftQuestions',
                    options = '$pubDraftOptions',
                    answer = '$pubDraftAnswers',
                    types = '$pubDraftTypes'
                    WHERE assessmentID = $assessID;";

                    // echo $pubDraftQuestions;

                    if ($this->db->query($updateQuestions)) {
                        return true;
                    }


                }
            }

        }

        return false;
    }

    function publish($assessID, $title, $items, $questionData, $optionData, $answerData, $typeData) {
        // Clean SQL Injection
        $assessID = mysqli_real_escape_string($this->db, $assessID);
        $title = mysqli_real_escape_string($this->db, $title);
        $items = mysqli_real_escape_string($this->db, $items);
        $questionData = mysqli_real_escape_string($this->db, $questionData);
        $optionData = mysqli_real_escape_string($this->db, $optionData);
        $answerData = mysqli_real_escape_string($this->db, $answerData);
        $typeData = mysqli_real_escape_string($this->db, $typeData);
        //

        $selAssessment = "SELECT * FROM matAssessments WHERE id = $assessID;";
        $selAQ = $this->db->query($selAssessment);

        if ($selAQ->num_rows > 0) {
            $assessment = $selAQ->fetch_assoc();
            $status = $assessment['status'];

            // Format Versions
            $title = $title . "|sepData|";
            $items = $items . "|sepData|";

            //

            if ($status == "Published") {
                $updateAssessment = "UPDATE matAssessments SET title = '$title', questions = '$items', dateUpdated = now() WHERE id = $assessID;";
            } else {
                $updateAssessment = "UPDATE matAssessments SET title = '$title', questions = '$items', dateUpdated = now(), status = 'Published' WHERE id = $assessID;";
            }

            if ($this->db->query($updateAssessment)) {
                // Update the questions, types, options, and answers here
                $questions = $questionData . "|sepData|";
                $options = $optionData . "|sepData|";
                $answers = $answerData . "|sepData|";
                $types = $typeData . "|sepData|";

                $updateQuestions = "UPDATE matQuestions SET question = '$questions', options = '$options', answer = '$answers', types = '$types' WHERE assessmentID = $assessID;";

                if ($this->db->query($updateQuestions)) {
                    return true;
                }
            }
        }

        return false;
    }
    //
}