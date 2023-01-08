<?php

class assessmentDisplayer {
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
        $selInfo = "SELECT * FROM uStudents WHERE id = $studentID;";
        $selIQ = $this->db->query($selInfo);

        if ($selIQ->num_rows > 0) {
            $json_string = "";

            $student = $selIQ->fetch_assoc();

            $studentSection = $student['section'];

            echo "[";
            if ($studentSection != null) {
                $selAssigned = "SELECT * FROM assignLessons WHERE sectionID = $studentSection;"; // get the assigned lesson to the section
                $selAQ = $this->db->query($selAssigned);
                
                if ($selAQ->num_rows > 0) {
                    while($assignedLessons = $selAQ->fetch_assoc()) {
                        $lessonID = $assignedLessons['lessonID'];
                        
                        // $json_string .= json_encode($assignedLessons) . ",";

                        $selAssessments = "SELECT * FROM matAssessments WHERE lessonID = $lessonID AND (status = 'Published' OR status = 'Published/Draft' OR status = 'Published/Pending');";
                        $selAsQ = $this->db->query($selAssessments);

                        if ($selAsQ->num_rows > 0) {
                            while($assessments = $selAsQ->fetch_assoc()) {
                                $json_string .= json_encode($assessments) . ",";
                            }
                        }
                    }
                }
            }
            echo rtrim($json_string, ",");
            echo "]";
        }
    }
    //
}