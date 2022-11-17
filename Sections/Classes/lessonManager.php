<?php

class lessonManager {
    // Vars
    private $db;
    //

    // Built-in
    function __construct($db) {
        $this->db = $db;
    }
    //

    // Functions
    function displayLessons($search) {
        // Clean
        $search = mysqli_real_escape_string($this->db, $search);
        //

        // Vars
        $schoolID = $_SESSION['schoolID'];
        $selTeachers = "SELECT * FROM uTeachers WHERE school = '$schoolID';"; // used to get the schools of teachers
        $selTQ = $this->db->query($selTeachers); // use this to get id
        //

        // Process
        if ($selTQ->num_rows > 0) {
            while($teacher = $selTQ->fetch_assoc()) {
                
                $teacherID = $teacher['id'];
                $selLessons = "SELECT * FROM matLessons WHERE teacherID = $teacherID"; // get the lessons from all the teachers in the same school

                if ($search != null && $search != "") { // Add the search query
                    $selLessons .= " AND id LIKE '$search%' OR title LIKE '$search%' OR description LIKE '$search%'";
                }

                $selLessons .= ";";

                $selLQ = $this->db->query($selLessons); // get lessons

                if ($selLQ->num_rows > 0) { // Convert data to JSON format

                    $json_string = "";

                    echo "[";
                    while($lesson = $selLQ->fetch_assoc()) {
                        $lessonID = $lesson['id'];
                        $sectionID = $_SESSION['sectionID'];
                        // if ($sectionID == "" || $sectionID == null) {echo "]"; return false;} // Aborts the query since the user have no section
                        $selAssigned = "SELECT * FROM assignLessons WHERE lessonID = $lessonID AND sectionID = $sectionID";

                        $selAQ = $this->db->query($selAssigned);
                        $assigned = $selAQ->fetch_assoc();

                        if ($assigned != null) {
                            $json_string .= json_encode($lesson + $assigned) . ",";
                        } else {
                            $json_string .= json_encode($lesson) . ",";
                        }
                    }
                    echo rtrim($json_string, ",");
                    echo "]";

                    
                }
            }
        }
        //
    }

    function saveLesson($values) {
        // Clean SQL Injection
        $values = mysqli_real_escape_string($this->db, $values);
        //

        // Vars
        $elements = explode(".|.", $values);
        $success = 0;
        
        //

        // Process
        for ($i = 0; $i < count($elements)-1; $i++) {
            $results = explode(",", $elements[$i]); // gets the value of lesson ID and if it was selected (boolean)
            $lessonID = $results[0]; // Lesson ID
            $isChecked = $results[1]; // the boolean whether it is checked or not

            $sectionID = $_SESSION['sectionID']; // We need this to check on the assigned lesson.

            // Check if the lesson is already assigned
            $selLesson = "SELECT * FROM assignLessons WHERE lessonID = $lessonID AND sectionID = $sectionID;";
            $selLQ = $this->db->query($selLesson);

            if ($selLQ->num_rows > 0) { // This means the lesson is already assigned to the current section.
                // remove it if the checked input was unchecked
                if ($isChecked == "false" || $isChecked == false) {

                    $del = "DELETE FROM assignLessons WHERE lessonID = $lessonID AND sectionID = $sectionID;"; // Delete that record to unassign the lesson
                    if ($this->db->query($del)) {
                        $success++;
                    }

                } else {
                    $success++;
                }
            } else { // The said lesson have not yet been assigned to the section
                if ($isChecked == "true" || $isChecked == 1) {

                    $ins = "INSERT INTO assignLessons (lessonID, sectionID) VALUES ($lessonID, $sectionID);"; // Assign lesson to section by inserting to db
                    if ($this->db->query($ins)) {
                        $success++;
                    }
                } else {
                    $success++;
                }
            }
        }

        if ($success == count($elements)-1) {
            return true;
        }
        
        return false; // failed

        //
    }

    //
}