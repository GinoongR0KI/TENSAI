<?php

class sectionManager {

    // Variables
    private $db;
    //

    // Built-in Functions
    function __construct($db) {
        $this->db = $db;
    }
    //

    // Custom Functions

    function display($schoolID, $search) {

        // Should we get the principal's id or the teacher's?

        // Clean SQL Injection
        $schoolID = mysqli_real_escape_string($this->db, $schoolID);
        $search = mysqli_real_escape_string($this->db, $search);
        //

        // Variable


        $sel = "SELECT * FROM etcSections WHERE schoolID = $schoolID"; 

        if ($search != null && $search != "") {
            $sel .= " AND id LIKE '$search%' OR sectionName LIKE '$search%' OR schoolID LIKE '$search%' OR advisorID LIKE '$search%'";
        }

        $sel .= ";";

        // The selection would be based on the Admin/Principal uType where it will select all that is a part of their school.
        $selQ = $this->db->query($sel); // Get the selection query.

        //

        // Process
        if ($selQ->num_rows > 0) {
            $json_string = ""; // Instantiate the JSON string

            echo "["; // beginning of the JSON data

            while ($results = $selQ->fetch_assoc()) {
                $json_string .= json_encode($results) . ","; // Encode the results into JSON format.
            }

            echo rtrim($json_string, ","); // remove the last , mark and return the JSON data.
            echo "]"; // Close the JSON data off.
        }
        //
    }

    function getTeacherName($teacherID) {
        // Clean SQL Injection
        $teacherID = mysqli_real_escape_string($this->db, $teacherID);
        //

        // Variables
        $sel = "SELECT * FROM uAccounts WHERE id = $teacherID;";
        $selQ = $this->db->query($sel);
        //

        // Process
        if ($selQ->num_rows > 0) {
            $teacher = $selQ->fetch_assoc();

            echo $teacher['fname'] . " " . $teacher['mname'] . " " . $teacher['lname'];
        }
        //

    }

    function getStudentCount($sectionID) {
        // Clean SQL Injection
        $sectionID = mysqli_real_escape_string($this->db, $sectionID);
        //

        // Variables
        $sel = "SELECT * FROM uStudents WHERE section = $sectionID";
        $selQ = $this->db->query($sel);
        //

        // Process
        echo $selQ->num_rows;
        // if ($selQ->num_rows > 0) {
        //     $student = $selQ->fetch_assoc();

        //     if ($student['section'] != null) {
        //         $studentID = $student['id'];
        //         $selName = "SELECT * FROM uAccounts WHERE id = $studentID";

        //         $selNQ = $this->db->query($selName);

        //         if ($selNQ->num_rows > 0) {
        //             $name = $selNQ->fetch_assoc();

        //             echo $name['fname'] . " " . $name['mname'] . " " . $name['lname'];
        //         }
        //     }
        // }
        //
    }

        // Principal
    function create($sectionName, $schoolID, $advisorID) {
        // Clean SQL Injection
        $sectionName = mysqli_real_escape_string($this->db, $sectionName);
        $schoolID = mysqli_real_escape_string($this->db, $schoolID);

        $advisorID = mysqli_real_escape_string($this->db, $advisorID);
        //

        // Variables
        if ($advisorID != "null") {
            $ins = "INSERT INTO etcSections (sectionName, schoolID, advisorID) VALUES ('$sectionName', $schoolID, $advisorID);";
        } else {
            $ins = "INSERT INTO etcSections (sectionName, schoolID, advisorID) VALUES ('$sectionName', $schoolID, null);";
        }
        //

        // Process
        if ($this->db->query($ins)) {
            return true;
        }

        return false;
        //
    }

    function edit($sectionID, $sectionName, $advisorID) {
        // Clean SQL Injection
        $sectionID = mysqli_real_escape_string($this->db, $sectionID);
        $sectionName = mysqli_real_escape_string($this->db, $sectionName);
        $advisorID = mysqli_real_escape_string($this->db, $advisorID);
        //

        // Vars
        if ($advisorID != null && $advisorID != "" && $advisorID != "null" && $advisorID != "unassign") {
            $edit = "UPDATE etcSections SET sectionName = '$sectionName', advisorID = $advisorID WHERE id = $sectionID;"; // This will assign an advisor to the section
        } else {
            $edit = "UPDATE etcSections SET sectionName = '$sectionName', advisorID = NULL WHERE id = $sectionID;"; // This will unassign the advisor in section
        }
        //

        // Process
        if ($this->db->query($edit)) {
            return true;
        }

        return false;
        //
    }

    function delete($sectionID) {
        // Clean SQL Injection
        $sectionID = mysqli_real_escape_string($this->db, $sectionID);
        //

        // Variables
        $del = "DELETE FROM etcSections WHERE id = $sectionID;";
        //

        // Process
        if ($this->db->query($del)) {
            return true;
        }

        return false;
        //
    }

    //

}