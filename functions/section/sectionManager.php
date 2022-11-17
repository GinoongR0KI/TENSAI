<?php

class sectionManager {

    private $db;

    function __construct($db) {
        $this->db = $db;
    }

    function create($sectName, $schoolID, $advisor) {

        // Clear SQL Injections
        $sectName = mysqli_real_escape_string($this->db, $sectName);
        $schoolID = mysqli_real_escape_string($this->db, $schoolID);
        $advisor = mysqli_real_escape_string($this->db, $advisor);
        //

        // Process
        if ($advisor != "" || $advisor != null) {
            $ins = "INSERT INTO etcSections (sectionName, schoolID) VALUES ('$sectName', $schoolID);";
        } else {
            $ins = "INSERT INTO etcSections (sectionName, schoolID, advisorID) VALUES ('$sectName', $schoolID, $advisor);";
        }

        if ($db->query($ins)) {
            return true; // Indicate that the query has been successful
        }

        return false; // Indicate that the query has failed to create a new section.
        //
    }

    function edit($sectID, $sectName, $advisor) {
        
        // Clear SQL Injections
        $sectID = mysqli_real_escape_string($this->db, $sectID);
        $sectName = mysqli_real_escape_string($this->db, $sectName);
        $advisor = mysqli_real_escape_string($this->db, $advisor);
        //

        // Process
        if ($advisor != "" || $advisor != null) { // Check if the advisorID has been given a value
            $update = "UPDATE etcSections SET sectionName = '$sectName' WHERE id = '$sectID';"; // Perform an update ithout doing anything with the advisor column
        } else {
            $update = "UPDATE etcSections SET sectionName = '$sectName', advisorID = $advisor WHERE id = '$sectID';"; // Perform an update to assign an advisor.
        }

        if ($this->db->query($update)) {
            return true; // This indicates that the edit is successful.
        }

        return false; // This indicates tht the edit has failed.
        //

    }

    function delete($sectID) {

        // Clear SQL Injections
        $sectID = mysqli_real_escape_string($this->db, $sectID);
        //

        $del = "DELETE FROM etcSections WHERE id = '$sectID';"; // Deletes the value with the ID

        if ($db->query($del)) { // execute the delete query
            return true; // Indicate that the query was successful
        }

        return false; // Indicate the query has failed to delete the data.

    }

}