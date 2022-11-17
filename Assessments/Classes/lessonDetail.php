<?php

class lessonDetail {
    // Vars
    private $db;
    //

    // Built-in
    function __construct($db) {
        $this->db = $db;
    }
    //

    // Functions
    function getAvailableLessons() {
        $teacherID = $_SESSION['id'];
        $selLessons = "SELECT * FROM matLessons WHERE teacherID = $teacherID;";
        $selLQ = $this->db->query($selLessons);

        if ($selLQ->num_rows > 0) {
            $json_string = "";

            echo "[";

            while ($lessons = $selLQ->fetch_assoc()) {
                $json_string .= json_encode($lessons) . ",";
            }
            echo rtrim($json_string, ",");
            echo "]";

        }
    }
    //
}