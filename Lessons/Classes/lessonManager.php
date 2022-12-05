<?php

class lessonManager {
    // Vars
    private $db;
    //

    // Built-in
    function __construct($db) {
        $this->db = $db;
    }
    //

    //Functions
    function displayLessons($search) {
        // Clean SQL Injection
        $search = mysqli_real_escape_string($this->db, $search);
            // Process Search
        $preSearch = explode("'", $search);
        $search = "";
        for ($i = 0; $i < count($preSearch); $i++) {
            if ($i + 1 >= count($preSearch)) {
                $search .= $preSearch[$i];
            } else {
                $search .= $preSearch[$i] . "'";
            }
        }
            //
        //

        // Admin = see all lessons from all schools
        switch ($_SESSION['uType']) {
            case "Admin":
                $selLessons = "SELECT * FROM matLessons";
                if ($search != null && $search != "") {
                    $selLessons .= " WHERE (id LIKE '$search%' OR title LIKE '%$search%' OR description LIKE '%$search%')";
                }
                $selLessons .= ";";

                $selLQ = $this->db->query($selLessons);

                if ($selLQ->num_rows > 0) {
                    $json_string = "";

                    echo "[";
                    while($results = $selLQ->fetch_assoc()) {
                        $json_string .= json_encode($results) . ",";
                    }
                    echo rtrim($json_string, ",");
                    echo "]";
                }
            break;

            case "Principal":

                // We have to get all the teacher accounts that is associated with the same schoolID
                // This is to get the teacher's id in order to query for the specific lessons from the teachers

                $schoolID = $_SESSION['schoolID'];
                $selTeachers = "SELECT * FROM uTeachers WHERE school = $schoolID"; // select teacher to get some info
                $selTQ = $this->db->query($selTeachers);

                if ($selTQ->num_rows > 0) {
                    $json_string = "";

                    echo "[";
                    while($resultsT = $selTQ->fetch_assoc()) {
                        $tID = $resultsT['id'];
                        $selLessons = "SELECT * FROM matLessons WHERE teacherID = $tID"; // select all the materials from that teacher
                        if ($search != null && $search != "") {
                            $selLessons .= " AND (id LIKE '$search%' OR title LIKE '%$search%' OR description LIKE '%$search%')";
                        }
                        $selLessons .= ";";
                        $selLQ = $this->db->query($selLessons);

                        if ($selLQ->num_rows > 0) {
                            while ($lessons = $selLQ->fetch_assoc()) {
                                $json_string .= json_encode($lessons) . ",";
                            }
                        }
                    }
                    echo rtrim($json_string, ",");
                    echo "]";
                }

                //$selLesson = "SELECT * FROM matLessons WHERE "
            break;

            case "Teacher":
                $uID = $_SESSION['id'];
                $selLessons = "SELECT * FROM matLessons WHERE teacherID = $uID";
                if ($search != null && $search != "") {
                    $selLessons .= " AND (id LIKE '$search%' OR title LIKE '%$search%' OR description LIKE '%$search%')";
                }
                $selLessons .= ";";
                $selLQ = $this->db->query($selLessons);

                if ($selLQ->num_rows > 0) {
                    $json_string = "";

                    echo "[";
                    while($results = $selLQ->fetch_assoc()) {
                        $json_string .= json_encode($results) . ",";
                    }
                    echo rtrim($json_string, ",");
                    echo "]";
                }
            break;
        }


        // Principals = can only see from his school

        // Teachers = can only see their own creation
    }

    function create($title, $desc, $teacherID) {
        $ins = "INSERT INTO matLessons (title, description, dateCreated, dateUpdated, state, teacherID) VALUES ('$title', '$desc', now(), now(), 'Draft', $teacherID);";

        if ($this->db->query($ins)) { // creates a new lesson
            $lessonID = $this->db->insert_id;
            $page = "INSERT INTO matPages (content, lessonID, state) VALUES ('|sepData|', $lessonID, 'Draft');"; // Insert a record to the mat Pages table as you create a lesson (makes one page).
            if ($this->db->query($page)) { // Creates a new page in the lesson
                return true;
            }
        }

        return false;
    }

    function edit() {

    }

    function delete($lessonID) {

        $delLesson = "DELETE FROM matLessons WHERE id = $lessonID;"; // deletes from the lessons table
        if ($this->db->query($delLesson)) {
            $delPages = "DELETE FROM matPages WHERE lessonID = $lessonID;"; // deletes all pages related to that lesson
            if ($this->db->query($delPages)) {
                return true;
            }
        }

        return false;
    }
    //

}