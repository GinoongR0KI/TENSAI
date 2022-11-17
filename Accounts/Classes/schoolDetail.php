<?php

// This functions will be used to retrieve all the school data of those without an assigned school.

class schoolDetail {

    // Variables
    private $db;
    //

    // Built-in Functions
    function __construct($db) {
        $this->db = $db;
    }
    //

    // Functions
    function getAvailableSchools() {
        // Select Query
        $sel = "SELECT * FROM etcSchools WHERE principalID IS NULL ORDER BY schoolName ASC;"; // This will select schools that has no principals yet.
        //

        $dbquery = $this->db->query($sel);

        if ($dbquery->num_rows > 0) {
            $json_string = "";

            echo "[";
            while ($results = $dbquery->fetch_assoc()) {
                $json_string .= json_encode($results) . ",";
            }
            echo rtrim($json_string, ",");
            echo "]";
        }
    }
    //

}