<?php

class accountManager {
    private $db;

    // Built-in
    function __construct($db) {
        $this->db = $db;
    }

    // Functions
    function displayAccounts_Admin($search) {
        // Clean SQL Injection
        $search = mysqli_real_escape_string($this->db, $search);
        //

        // Process
        $currID = $_SESSION['id'];
        $selAccounts = "SELECT * FROM uAccounts WHERE id != $currID";

            // Searching
        if ($search != null || $search != "") {
            $selAccounts .= " AND id LIKE '$search%' OR fname LIKE '$search%' OR mname LIKE '$search%' OR lname LIKE '$search%' OR email LIKE '$search%'";
        }
        $selAccounts .= ";";
            //

        $selAQ = $this->db->query($selAccounts);

        if ($selAQ->num_rows > 0) {
            $json_string = "";

            echo "[";
            while ($accounts = $selAQ->fetch_assoc()) {
                $json_string .= json_encode($accounts) . ","; // Encode all account records
            }
            echo rtrim($json_string, ",");
            echo "]";
        }
        //
    }

    function displayAccounts_Principal($search) {
        // Clean SQL Injection
        $search = mysqli_real_escape_string($this->db, $search);
        //

        // Process
        $schoolID = $_SESSION['schoolID'];
        $sectionID = $_SESSION['sectionID'];
        $selSchoolmates = "SELECT * FROM uTeachers, uStudents WHERE school = $schoolID"; // Finds accounts of students and teachers
        $selSQ = $this->db->query($selAccounts);

        $selAccounts = "SELECT uAccounts.id as id, fname, mname, lname, uType, dateCreated, isActivated, profID FROM uAccounts, uTeachers WHERE uAccounts.id = uTeachers.id";

            // Searching
        if ($search != null || $search != "") {
            $selAccounts .= " AND id LIKE '$search%' OR fname LIKE '$search%' OR mname LIKE '$search%' OR lname LIKE '$search%' OR email LIKE '$search%'";
        }
        $selAccounts .= ";";
            //

        $selAQ = $this->db->query($selAccounts);
        
        if ($selAQ->num_rows > 0) {
            $json_string = "";

            echo "[";
            while ($accounts = $selAQ->fetch_assoc()) {
                $json_string .= json_encode($accounts) . ",";

            }
            echo rtrim($json_string, ",");
            echo "]";
        }
        //
    }
}