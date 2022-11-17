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

    function edit($schoolID, $schoolName, $municipality, $principal) { // Should I still include some of these parameters?
        // Clean SQL Injection
        $schoolID = mysqli_real_escape_string($this->db, $schoolID);
        $schoolName = mysqli_real_escape_string($this->db, $schoolName);
        $municipality = mysqli_real_escape_string($this->db, $municipality);
        $principal = mysqli_real_escape_string($this->db, $principal);
        //

        // Process
        if ($principal != "" || $principal != null) { // checks if the $principal variable is set or not. (This variable can be null);
            $update = "UPDATE etcSchools SET schoolName = '$schoolName', municipality = '$municipality' WHERE id = $schoolID;";
        } else {
            $update = "UPDATE etcSchools SET schoolName = '$schoolName', municipality = '$municipality', principalID = $principal WHERE id = $schoolID;";
        }
        
        if ($this->db->query($update)) { // run the query
            return true; // The editing of the particular school is successful
        }

        return false; // The editing of the school failed.
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