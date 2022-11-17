<?php

class quizer {
    // Vars
    private $db;
    //

    // Built-In
    function __construct($db) {
        $this->db = $db;
    }
    //

    // Functions
    function getQuestions($assessID) {
        // Clean SQL Injection
        $assessID = mysqli_real_escape_string($this->db, $assessID);
        //

        $selAssessments = "SELECT questions AS numItems FROM matAssessments WHERE id = $assessID;";
        $selAQ = $this->db->query($selAssessments);

        if ($selAQ->num_rows > 0) {
            $json_string = "";

            $selQuestions = "SELECT * FROM matQuestions WHERE assessmentID = $assessID;";
            $selQQ = $this->db->query($selQuestions);

            echo "[";

            if ($selQQ->num_rows > 0) {
                while ($questions = $selQQ->fetch_assoc()) {
                    $numItems = $selAQ->fetch_assoc();

                    $json_string .= json_encode($questions + $numItems) . ",";
                }
            }

            echo rtrim($json_string, ",");
            echo "]";
        }
    }
    //
}