<?php

class schoolManager {
    
    // Variables
    private $db;
    //

    // Built-in Functions
    function __construct($db) {
        $this->db = $db;
    }
    //

    // Custom Functions
    function displaySchools($search) {

        // SQL Injection Cleaner

        //

        // Select
        $sel = "SELECT * FROM etcSchools"; // Select all schools

            // We could insert a series of concatenation in between these lines to create a more specific selection of schools (filtered)
        if ($search != null && $search != "") {
            $sel .= " WHERE id LIKE '$search%' OR schoolName LIKE '$search%' OR municipality LIKE '$search%' OR principalID LIKE '$search%'";
        }
        

        $sel .= ";";
        //

        $selQ = $this->db->query($sel); // call the query

        if ($selQ->num_rows > 0) {

            $json_string = ""; // Instantiate the JSON string

            echo "["; // beginning of the JSON data

            while ($results = $selQ->fetch_assoc()) {
                $schoolID = $results['id'];

                // Get Sections
                $selSections = "SELECT COUNT(*) as sections FROM etcSections WHERE schoolID = $schoolID;";
                $selSQ = $this->db->query($selSections);
                $sections = $selSQ->fetch_assoc();

                // Get Teachers
                $selTeachers = "SELECT COUNT(*) as teachers FROM uTeachers WHERE school = $schoolID;";
                $selTQ = $this->db->query($selTeachers);
                $teachers = $selTQ->fetch_assoc();

                $json_string .= json_encode($results + $sections + $teachers) . ","; // Encode the results into JSON format.
            }

            echo rtrim($json_string, ","); // remove the last , mark and return the JSON data.
            echo "]"; // Close the JSON data off.

        }

    }

    function getPrincipalName($principalID) {
        // Clean SQL Injection
        $principalID = mysqli_real_escape_string($this->db, $principalID);
        //

        // Variables
        $sel = "SELECT * FROM uAccounts WHERE id = $principalID;";
        $selQ = $this->db->query($sel);
        //

        // Process
        if ($selQ->num_rows > 0) {
            $principal = $selQ->fetch_assoc();

            echo $principal['fname'] . " " . $principal['mname'] . " " . $principal['lname'];
        }
        //
    }

    function edit($origID, $schoolID, $schoolName, $municipality, $principalID) {
        // Clean SQL Injection
        $schoolID = mysqli_real_escape_string($this->db, $schoolID);
        $schoolName = mysqli_real_escape_string($this->db, $schoolName);
        $municipality = mysqli_real_escape_string($this->db, $municipality);
        $principalID = mysqli_real_escape_string($this->db, $principalID);
        //

        // Variables
        $schoolID = (int)$schoolID;
        $principalID = $principalID != null && $principalID != "" ? (int)$principalID : null;
            // Set query update
        if ($principalID != null && $principalID != "") {
            $edit = "UPDATE etcSchools SET id = $schoolID, schoolName = '$schoolName', municipality = '$municipality', principalID = $principalID WHERE id = $origID;";
        } else {
            $edit = "UPDATE etcSchools SET id = $schoolID, schoolName = '$schoolName', municipality = '$municipality', principalID = null WHERE id = $origID;";
        }
            //
        //

        // Process
        if ($this->db->query($edit)) { // call edit query
            return true;
        }

        return false;
        //
    }

    function delete($schoolID) {
        // Clean SQL Injection
        $schoolID = mysqli_real_escape_string($this->db, $schoolID);
        //
        
        // Variables
        $del = "DELETE FROM etcSchools WHERE id = $schoolID;";
        //

        // Process
        if ($this->db->query($del)) { // Delete the school
            // Delete all the sections
            // Delete all the materials
            // Unassign accounts
            
            // $delSections = "DELETE FROM etcSections WHERE school = $schoolID;";
            // if ($this->db->query($delSections)) {
            //     $unassignStudents = "UPDATE uStudents SET schoolID = NULL, sectionID = NULL WHERE schoolID = $schoolID;";
            //     if ($this->db->query($unassignStudents)) {
            //         $unassignTeachers = "UPDATE uTeachers SET schoolID = NULL;";
            //         if ($this->db->query($unassignTeachers)) {
            //             return true; // Success
            //         }
            //     }
            // }
            return true; // Success
        }
        //

        return false; // If it reaches here, it failed
    }

    //

}