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
        // Clean
        $search = mysqli_real_escape_string($this->db, $search);
        //

        $selSchools = "SELECT * FROM etcSchools";
        // Search
        if (!empty($search)) {
            $selSchools .= " WHERE id LIKE '$search%' OR schoolName LIKE '$search%' OR municipality LIKE '$search%' OR principalID LIKE '$search%';";
        }
        // echo $selSchools;
        //

        $selSQ = $this->db->query($selSchools);
        if ($selSQ->num_rows > 0) {
            $json_string = "";

            echo "[";
            while ($schools = $selSQ->fetch_assoc()) {
                $schoolID = $schools['id']; // Use for getting information

                $selSectionsCount = "SELECT COUNT(*) as sections FROM etcSections WHERE schoolID = $schoolID;";
                $selSCQ = $this->db->query($selSectionsCount);
                $sectionsCount = $selSCQ->fetch_assoc();
                
                $selTeachersCount = "SELECT COUNT(*) as teachers FROM uTeachers WHERE school = $schoolID;";
                $selTCQ = $this->db->query($selTeachersCount);
                $teachersCount = $selTCQ->fetch_assoc();


                $json_string .= json_encode($schools + $sectionsCount + $teachersCount) . ",";
            }
            echo rtrim($json_string, ",");
            echo "]";
        }
    }
    function displaySchools_obs($search) {

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

    function schoolExists($schoolID) {
        $sel = "SELECT * FROM etcSchools WHERE id = $schoolID";

        $dbquery = $this->db->query($sel);

        if ($dbquery->num_rows > 0) {
            return true; // There is a school that exists with the same school ID
        }

        return false; // There are no school that exists with the school ID, yet.
    }

    function create($schoolID, $schoolName, $municipality, $principal) {
        // Clean SQL Injection
        $schoolID = mysqli_real_escape_string($this->db, $schoolID);
        $schoolName = mysqli_real_escape_string($this->db, $schoolName);
        $municipality = mysqli_real_escape_string($this->db, $municipality);
        $principal = mysqli_real_escape_string($this->db, $principal);
        //

        // process
        if (!$this->schoolExists($schoolID)) { // Check if there are no duplicate records from the database that currently exists.
            if ($principal != "" && $principal != null) { // checks if the $principal variable is set or not. (This variable can be null);
                $ins = "INSERT INTO etcSchools (id, schoolName, municipality, principalID) VALUES ($schoolID, '$schoolName', '$municipality', $principal);";
            } else {
                $ins = "INSERT INTO etcSchools (id, schoolName, municipality) VALUES ($schoolID, '$schoolName', '$municipality');";
            }
            
            if ($this->db->query($ins)) { // run the query
                return true; // The creation of a new school is successful
            }
        }

        return false; // The creation of a new school failed.
        //
    }

    function edit($origID, $schoolID, $schoolName, $municipality, $principal) { // Should I still include some of these parameters?
        // Clean SQL Injection
        $origID = mysqli_real_escape_string($this->db, $origID);
        $schoolID = mysqli_real_escape_string($this->db, $schoolID);
        $schoolName = mysqli_real_escape_string($this->db, $schoolName);
        $municipality = mysqli_real_escape_string($this->db, $municipality);
        $principal = mysqli_real_escape_string($this->db, $principal);
        //

        // Process
        $principal = $principal != null && $principal != "" ? (int)$principal : null;
        if ($principal != "" && $principal != null) { // checks if the $principal variable is set or not. (This variable can be null);
            $update = "UPDATE etcSchools SET id = $schoolID, schoolName = '$schoolName', municipality = '$municipality', principalID = $principal WHERE id = $origID;";
        } else {
            $update = "UPDATE etcSchools SET id = $schoolID, schoolName = '$schoolName', municipality = '$municipality', principalID = null WHERE id = $origID;";
        }
        
        if ($this->db->query($update)) { // run the query
            return true; // The editing of the particular school is successful
        }

        return false; // The editing of the school failed.
        //
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

    function delete($schoolID) { // This function must be called after prompting the user to confirm their decision.
        // Clean SQL Injection
        $schoolID = mysqli_real_escape_string($this->db, $schoolID);
        //

        // Process
        $del = "DELETE FROM etcSchools WHERE id = $schoolID;";

        if ($this->db->query($del)) { // Perform a delete query removing the school with the specified school ID.
            return true; // Indicates that this is a success
        }

        return false; // Indicates that this is a failed attempt to delete the data.
        //
    }

    function assign($schoolID, $principal) { // This function is supposedly to be used to assign a principal account for the school. (renders obsolete because of the edi() function)
        // Clean SQL Injection
        //
    }
    //

}