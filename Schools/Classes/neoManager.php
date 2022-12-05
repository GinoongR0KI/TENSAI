<?php

class schoolManager {
    // Variables
    private $db;

    // Built-in
    function __construct($db) {
        $this->db = $db;
    }

    // Custom
    function displaySchools($search) {
        // Clean
        $search = mysqli_real_escape_string($this->db, $search);
        //

        $selSchools = "SELECT etcSchools.*, COUNT(etcSections.id) as sections, COUNT(uTeachers.id) as teachers FROM etcSchools, etcSections, uTeachers WHERE etcSections.schoolID = etcSchools.id AND uTeachers.school = etcSchools.id";
        // Search
        if (!empty($search)) {
            $selSchools .= " AND id LIKE '$search%' OR schoolName LIKE '$search%' OR municipality LIKE '$search%' OR principalID LIKE '$search%';";
        }
        //

        $selSQ = $this->db->query($selSchools);
        if ($selSQ->num_rows > 0) {
            $json_string = "";

            echo "[";
            while ($schools = $selSQ->fetch_assoc()) {
                $json_string .= json_encode($schools);
            }
            echo rtrim($json_string, ",");
            echo "]";
        }
    }
}

?>