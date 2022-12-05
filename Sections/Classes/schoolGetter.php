<?php

class schoolGetter {

    // Variables
    private $db;
    //

    // Built-in Functions
    function __construct($db) {
        $this->db = $db;
    }
    //

    // Custom Functions
    function getID($uType) {
        $uID = $_SESSION['id'];

        if ($uType != "Admin") {
            switch ($uType) {
                case "Principal":
                    $sel = "SELECT id FROM etcSchools WHERE principalID = $uID;"; // This uses the session id from the account to check the table for schools
                break;
                case "Teacher":
                    $sel = "SELECT school FROM uTeachers WHERE id = $uID;";
                break;
                case "Student":
                    $sel = "SELECT school FROM uStudents WHERE id = $uID;";
                break;
            }

            $selQ = $this->db->query($sel);

            if ($selQ->num_rows > 0) {
                $results = $selQ->fetch_assoc();

                switch ($uType) {
                    case "Principal":
                        echo $results['id'];
                    break;

                    default:
                        echo $results['schoolID'];
                    break;
                }
            }
        }

    }

    //

}