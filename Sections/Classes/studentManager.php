<?php

class studentManager {

    // Vars
    private $db;
    //

    // Built-in
    function __construct($db) {
        $this->db = $db;
    }
    //

    // Functions
    function displayStudents($search) {
        // Clean SQL Injection
        $search = mysqli_real_escape_string($this->db, $search);
        //

        //
        $schoolID = $_SESSION['schoolID'];
        $sectionID = $_SESSION['sectionID'];
        $sel = "SELECT * FROM uStudents WHERE school = '$schoolID' AND (section IS NULL OR section = $sectionID);"; // initial selection of student information
        $selQ = $this->db->query($sel);
        //

        // Process
        if ($selQ->num_rows > 0) {
            $json_string = "";

            echo "[";
            while ($students = $selQ->fetch_assoc()) {
                $studentID = $students['id'];

                $selGenInfo = "SELECT * FROM uAccounts WHERE id = $studentID AND isActivated = 1";
                if ($search != null && $search != "") {
                    $selGenInfo .= " AND (id LIKE '$search%' OR email LIKE '$search%' OR fname LIKE '%$search%' OR mname LIKE '%$search%' OR lname LIKE '%$search%')";
                }
                $selGenInfo .= ";";

                $selGIQ = $this->db->query($selGenInfo); // general info selection

                if ($selGIQ->num_rows > 0) {
                    
                    while($results = $selGIQ->fetch_assoc()) {

                        $json_string .= json_encode($results + $students) . ",";

                    }
                    
                }
            }

            echo rtrim($json_string, ",");
            echo "]";
        }
        //
    }

    function saveStudent($values) {
        // Clean SQL Injection
        $values = mysqli_real_escape_string($this->db, $values);
        //

        //
        $elements = explode(".|.", $values); // get separate element's data
        $success = 0;
        //

        // Process
        for ($i = 0; $i < count($elements)-1; $i++) {
            $result = explode(",", $elements[$i]); // get id and checked data from the element
            $studentID = $result[0]; // get student ID
            $isChecked = $result[1]; // get if this is toggled or not

            // echo $isChecked;
            echo is_bool($isChecked);

            $sectionID = $_SESSION['sectionID'];

            if ($isChecked == "true" || $isChecked == 1) {
                $update = "UPDATE uStudents SET section = $sectionID WHERE id = $studentID;";
            } else {
                $update = "UPDATE uStudents SET section = NULL WHERE id = $studentID;";
            }

            if ($this->db->query($update)) {
                $success ++;
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