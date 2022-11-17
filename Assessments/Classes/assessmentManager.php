<?php

class assessmentManager {
    // Vars
    private $db;
    //

    // Built-in
    function __construct($db) {
        $this->db = $db;
    }
    //

    // Functions
    function displayAssessments($search) {
        // Clean SQL Injection
        $search = mysqli_real_escape_string($this->db, $search);
            // Process Search
        $preSearch = explode("'", $search);
        $search = "";
        for ($i = 0; $i < count($preSearch); $i++) {
            if ($i + 1 >= count($preSearch)) {
                $search .= $preSearch[$i];
            } else {
                $search .= $preSearch[$i] . "'";
            }
        }
            //
        //

        // This command must detect which assessments only belong to the current logged teacher

        switch ($_SESSION['uType']) {
            case "Teacher":
                $uID = $_SESSION['id']; // used to get materials

                // Get lessons from teacher
                $selLessons = "SELECT * FROM matLessons WHERE teacherID = $uID;";
                $selLQ = $this->db->query($selLessons);

                if ($selLQ->num_rows > 0) {
                    $json_string = "";

                    echo "[";
                    while($lessons = $selLQ->fetch_assoc()) { // Get all lessons
                        $lessonID = $lessons['id'];

                        $selAssessments = "SELECT * FROM matAssessments WHERE lessonID = $lessonID";
                        if ($search != null && $search != "") {
                            $selAssessments .= " AND id LIKE '$search%' OR title LIKE '$search%'";
                        }
                        $selAssessments .= ";";

                        $selAQ = $this->db->query($selAssessments);

                        if ($selAQ->num_rows > 0) {
                            while($assessments = $selAQ->fetch_assoc()) { // the assessments will return only those from the lessons owned by the teachers

                                $selLessonTitle = "SELECT title AS lessonName FROM matLessons WHERE id = $lessonID;";
                                $selLTQ = $this->db->query($selLessonTitle);
                                $lessonTitle = $selLTQ->fetch_assoc();

                                $assessID = $assessments['id'];
                                $selAssessmentCount = "SELECT * FROM matQuestions WHERE assessmentID = $assessID;";
                                $selACQ = $this->db->query($selAssessmentCount);
                                $count = $selACQ->fetch_assoc();
                                $questions = explode("|sepData|", $count['question'])[1] != "" ? explode("|sepData|", $count['question'])[1] : explode("|sepData|", $count['question'])[0];
                                $question = explode("|sepQuestion|", $questions);
                                $count = array("numQuestions"=>count($question)-1);

                                $json_string .= json_encode($assessments+$lessonTitle+$count) . ",";
                            }

                        }
                    }
                    echo rtrim($json_string, ",");
                    echo "]";
                }
            break;

            case "Principal":
                $schoolID = $_SESSION['schoolID'];

                $selTeachers = "SELECT * FROM uTeachers WHERE school = $schoolID;";
                $selTQ = $this->db->query($selTeachers);

                if ($selTQ->num_rows > 0) { // get all the teachers under the principal's school
                    $json_string = "";

                    echo "[";
                    while($teachers = $selTQ->fetch_assoc()) {
                        $teacherID = $teachers['id'];

                        $selLessons = "SELECT * FROM matLessons WHERE teacherID = $teacherID;";
                        $selLQ = $this->db->query($selLessons); // Get all Lessons from the teacher under the principal

                        if ($selLQ->num_rows > 0) {
                            while($lessons = $selLQ->fetch_assoc()) {
                                $lessonID = $lessons['id'];

                                $selAssessments = "SELECT * FROM matAssessments WHERE lessonID = $lessonID";
                                if ($search != null && $search != "") {
                                    $selAssessments .= " AND id LIKE '$search%' OR title LIKE '$search%' OR lessonID LIKE '$search%'";
                                }
                                $selAssessments .= ";";
                                $selAQ = $this->db->query($selAssessments);

                                if ($selAQ->num_rows > 0) {
                                    while ($assessments = $selAQ->fetch_assoc()) {
                                        $selLessonTitle = "SELECT title AS lessonName FROM matLessons WHERE id = $lessonID";
                                        $selLTQ = $this->db->query($selLessonTitle);
                                        $lessonTitle = $selLTQ->fetch_assoc();

                                        $assessID = $assessments['id'];
                                        $selAssessmentCount = "SELECT * FROM matQuestions WHERE assessmentID = $assessID;";
                                        $selACQ = $this->db->query($selAssessmentCount);
                                        $count = $selACQ->fetch_assoc();
                                        $questions = explode("|sepData|", $count['question'])[0];
                                        $question = explode("|sepQuestion|", $questions);
                                        $count = array("numQuestions"=>count($question)-1);

                                        $json_string .= json_encode($assessments + $lessonTitle + $count) . ",";
                                    }
                                }
                            }
                        }
                    }
                    echo rtrim($json_string, ",");
                    echo "]";
                }

                
                // $selLessons = "SELECT * FROM matLessons WHERE schoolID = $schoolID;";
                // $selLQ = $this->db->query($selLessons);

                // if ($selLQ->num_rows > 0) {
                //     while ($lessons = $selLQ->fetch_assoc()) {
                //         $lessonID = $lessons['id'];

                //         $selAssessments = "SELECT * FROM matAssessments WHERE lessonID = $lessonID;";
                //         if ($search != null && $search != "") {
                //             $selAssessments .= " AND id LIKE '$search%' OR title LIKE '$search%' OR lessonID LIKE '$search%'";
                //         }
                //         $selAssessments .= ";";
                //         $selAQ = $this->db->query($selAssessments);

                //         if ($selAQ->num_rows > 0) {
                //             while ($assessments = $selAQ->fetch_assoc()) {

                //             }
                //         }
                //     }
                // }
            break;

            case "Admin":
                $selLessons = "SELECT * FROM matLessons;";
                $selLQ = $this->db->query($selLessons);

                if ($selLQ->num_rows > 0) {
                    $json_string = "";

                    echo "[";
                    
                    while($lessons = $selLQ->fetch_assoc()) {
                        $lessonID = $lessons['id'];

                        $selAssessments = "SELECT * FROM matAssessments WHERE lessonID = $lessonID";
                        if ($search != null && $search != "") {
                            $selAssessments .= " id LIKE '$search%' OR title LIKE '$search%' OR lessonID LIKE '$search%'";
                        }
                        $selAssessments .= ";";

                        $selAQ = $this->db->query($selAssessments);

                        if ($selAQ->num_rows > 0) {
                            while ($assessments = $selAQ->fetch_assoc()) {
                                $selLessonTitle = "SELECT title AS lessonName FROM matLessons WHERE id = $lessonID";
                                $selLTQ = $this->db->query($selLessonTitle);
                                $lessonTitle = $selLTQ->fetch_assoc();

                                $assessID = $assessments['id'];
                                $selAssessmentCount = "SELECT * FROM matQuestions WHERE assessmentID = $assessID;";
                                $selACQ = $this->db->query($selAssessmentCount);
                                $count = $selACQ->fetch_assoc();
                                $questions = explode("|sepData|", $count['question'])[0];
                                $question = explode("|sepQuestion|", $questions);
                                $count = array("numQuestions"=>count($question)-1);

                                $json_string .= json_encode($assessments + $lessonTitle + $count) . ",";
                            }
                        }
                    }

                    echo rtrim($json_string, ",");
                    echo "]";
                }

            break;
        }

        $sel = "SELECT * FROM matAssessments";
        if ($search != null && $search != "") {

        }
        $sel .= ";";
    }

    function create($title, $lessonID) {
        // Clean SQL Injection
        $title = mysqli_real_escape_string($this->db, $title);
        $lessonID = mysqli_real_escape_string($this->db, $lessonID);
        //

        $ins = "INSERT INTO matAssessments (title, lessonID, questions, dateCreated, dateUpdated, status) VALUES ('$title|sepData|', $lessonID, '0|sepData|', now(), now(), 'Draft');";

        if ($this->db->query($ins)) {
            $prevInsID = $this->db->insert_id;

            $insQuestions = "INSERT INTO matQuestions (assessmentID, question, options, answer, types) VALUES ($prevInsID, '|sepData|', '|sepData|', '|sepData|', '|sepData|');";
            if ($this->db->query($insQuestions)) {
                return true;
            }

        }

        return false; // failed
    }

    function save() {

    }

    function publish() {

    }

    function delete($assessmentID) {
        // Clean SQL Injections
        $assessmentID = mysqli_real_escape_string($this->db, $assessmentID);
        //

        $delAssessment = "DELETE FROM matAssessments WHERE id = $assessmentID;";

        if ($this->db->query($delAssessment)) {
            $delQuestions = "DELETE FROM matQuestions WHERE assessmentID = $assessmentID;";

            if ($this->db->query($delQuestions)) {
                return true;
            }
        }

        return false;
    }
    //
}