<?php

class teacherDetail {
    // Vars
    private $db;
    //

    // Built-in
    function __construct($db) {
        $this->db = $db;
    }
    //

    // Functions
    function getAvailableTeachers($schoolID) {
        
        // Clean SQL Injection
        $schoolID = mysqli_real_escape_string($this->db, $schoolID);

        if ($schoolID == null || $schoolID == "null" || $schoolID == "") {return false;}
        //

        $selTeacher = "SELECT * FROM uTeachers WHERE school = $schoolID;";
        $selTQ = $this->db->query($selTeacher); // get all info from the teachers table;

        if ($selTQ->num_rows > 0) {
            $json_string = "";

            echo "[";
            while ($teachers = $selTQ->fetch_assoc()) {
                $tID = $teachers['id'];
                $selSections = "SELECT * FROM etcSections WHERE advisorID = $tID";
                $selSQ = $this->db->query($selSections); // check if the sections have the teacher's ID

                if ($selSQ->num_rows == 0) {// prove teacher's unassigned
                    $selAccountDetail = "SELECT fname, mname, lname FROM uAccounts WHERE id = $tID";
                    $selAQ = $this->db->query($selAccountDetail); // get the teacher's general information (name)
                    $resAcc = $selAQ->fetch_assoc();

                    $json_string .= json_encode($teachers + $resAcc) . ",";
                }

            }
            echo rtrim($json_string, ",");
            echo "]";
        }
    }
    //
}

?>