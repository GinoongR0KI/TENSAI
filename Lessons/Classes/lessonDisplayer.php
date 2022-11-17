<?php

class lessonDisplayer {
    // Vars
    private $db;
    //

    // Built-in
    function __construct($db) {
        $this->db = $db;
    }
    //

    // Functions
    function dashboardDisplay() {

        $studentID = $_SESSION['id'];
        $selInfo = "SELECT * FROM uStudents WHERE id = $studentID;"; // We need to get student's section ID to determine which materials are available to the student.
        $selIQ = $this->db->query($selInfo);

        if ($selIQ->num_rows > 0) {
            $student = $selIQ->fetch_assoc(); // interprets student information

            $studentSection = $student['section'];
            if ($studentSection != null) {
                $selAssigned = "SELECT * FROM assignLessons WHERE sectionID = $studentSection;";
                $selAQ = $this->db->query($selAssigned);

                if ($selIQ->num_rows > 0) {
                    $json_string = "";

                    echo "[";
                    while($assigned = $selAQ->fetch_assoc()) {
                        $lessonID = $assigned['lessonID'];
                        $selLessons = "SELECT * FROM matLessons WHERE id = $lessonID;";
                        $selLQ = $this->db->query($selLessons);

                        if ($selLQ->num_rows > 0) {
                            while ($lessons = $selLQ->fetch_assoc()) {
                                $json_string .= json_encode($lessons) . ",";
                            }
                        }
                    }
                    echo rtrim($json_string, ",");
                    echo "]";

                }

            }

        }

    }

    function lessonDisplay($lessonID) {
        // Clean SQL Injection
        $lessonID = mysqli_real_escape_string($this->db, $lessonID);
        //

        // Vars
        $selLesson = "SELECT * FROM matLessons WHERE id = $lessonID;";
        $selLQ = $this->db->query($selLesson); // Get the general Information of the lesson

        if ($selLQ->num_rows > 0) {
            $selPages = "SELECT * FROM matPages WHERE lessonID = $lessonID;";
            $selPQ = $this->db->query($selPages);

            if ($selPQ->num_rows > 0) {
                $json_string = "";

                echo "[";

                while($lesson = $selLQ->fetch_assoc()) {
                    $pages = $selPQ->fetch_assoc();
                    $json_string .= json_encode($lesson + $pages) . ",";
                }
                echo rtrim($json_string, ",");
                echo "]";
            }
        }
        //
    }
    //
}