<?php

class accountDetail {
    // Variables
    private $db;
    //

    // Built-In Functions
    function __construct($db) {
        $this->db = $db;
    }
    //

    // Process
    function getAvailablePrincipals() {
        $selPrincipals = "SELECT * FROM uAccounts WHERE uType = 'Principal' AND isActivated = 1";
        $selPQ = $this->db->query($selPrincipals);
        // echo $selPrincipals;

        if ($selPQ->num_rows > 0) {
            $json_string = "";

            echo "[";
            while ($results = $selPQ->fetch_assoc()) {
                $principalID = $results['id'];
                $sel = "SELECT * FROM etcSchools WHERE principalID = $principalID;";
                // echo $sel;
                $selQ = $this->db->query($sel); // Check if the principal is already assigned to a school

                // $json_string .= json_encode($results) . ",";
                if ($selQ->num_rows == 0) {
                    $json_string .= json_encode($results) . ",";
                }
            }
            echo rtrim($json_string, ",");
            echo "]";
        }
    }
    //
}