<?php

class pageManager {
    // Vars
    private $db;
    //

    // Built-In
    function __construct($db) {
        $this->db = $db;
    }
    //

    // Functions
    function displayPages($lessonID) {
        // Clean SQL Injection
        $lessonID = mysqli_real_escape_string($this->db, $lessonID);
        //

        //
        
        $sel = "SELECT * FROM matPages WHERE lessonID = $lessonID;";
        $selQ = $this->db->query($sel);
        //

        // Process
        if ($selQ->num_rows > 0) { // there is a page from this lesson
            // It should only have 1 record. We are going to make a long string to save the pages data, and the decoding can happen in javascript side.
            $json_string = "";

            echo "[";
            while ($page = $selQ->fetch_assoc()) {
                $json_string .= json_encode($page) . ",";
            }
            echo rtrim($json_string, ",");
            echo "]";
        }
        //
    }

    function displayLesson($lessonID) {
        // Clean SQL Injection
        $lessonID = mysqli_real_escape_string($this->db, $lessonID);
        //

        $sel = "SELECT * FROM matLessons WHERE id = $lessonID;";
        $selQ = $this->db->query($sel);

        if ($selQ->num_rows > 0) {
            $json_string = "";

            echo "[";
            while ($lesson = $selQ->fetch_assoc()) {
                $json_string .= json_encode($lesson) . ",";
            }
            echo rtrim($json_string, ",");
            echo "]";
        }
    }

    function save($lessonID, $title, $description, $pageData) {
        // Every lesson must have a record already made in the matPages table, so we must do updates
        $selLesson = "SELECT * FROM matLessons WHERE id = $lessonID;";
        $selLQ = $this->db->query($selLesson);

        if ($selLQ->num_rows > 0) {
            $lesson = $selLQ->fetch_assoc();
            $status = $lesson['state']; // get current lesson status

            // Version Control
            $publishedTitle = $lesson['title'];
            $publishedDescription = $lesson['description'];

            $sepTitle = explode("|sepData|", $publishedTitle);
            $pubDraftTitle = $sepTitle[0] . "|sepData|" . $title; // get the published data, and overwrite the draft data. Title

            $sepDescription = explode("|sepData|", $publishedDescription);
            $pubDraftDescription = $sepDescription[0] . "|sepData|" . $description; // get the published data, and overwrite the drafts; Description
            //

            if ($status == "Published") { // Check if the document has already been published
                $updateLesson = "UPDATE matLessons SET title = '$pubDraftTitle', description = '$pubDraftDescription', dateUpdated = now(), state = 'Published/Draft' WHERE id = $lessonID;";
            } else { // Otherwise, if it's not, the default should be 'Draft'; therefore, there is no need to update the status. Same goes when it's also in 'Published/Draft' status.
                $updateLesson = "UPDATE matLessons SET title = '$pubDraftTitle', description = '$pubDraftDescription', dateUpdated = now() WHERE id = $lessonID;";
            }
            
            if ($this->db->query($updateLesson)) { // Update the record for the general information of the lesson
                $selPages = "SELECT * FROM matPages WHERE lessonID = $lessonID;";
                $selPQ = $this->db->query($selPages);

                if ($selPQ->num_rows > 0) {
                    $page = $selPQ->fetch_assoc();

                    // Version Control
                    $publishedPages = $page['content'];

                    $sepPages = explode("|sepData|", $publishedPages);
                    $pubDraftPages = $sepPages[0] . "|sepData|" . $pageData; // get the published data, and overwrite the drafts. Pages
                    //

                    $updatePage = "UPDATE matPages SET content = '$pubDraftPages' WHERE lessonID = $lessonID;";

                    if ($this->db->query($updatePage)) {
                        return true;
                    }

                }

            }

        }

        return false;

    }

    function publish($lessonID, $title, $description, $pageData) {
        // Clean SQL Injection
        $title = mysqli_real_escape_string($this->db, $title);
        $description = mysqli_real_escape_string($this->db, $description);
        //

        // Save the lesson information
        $selLesson = "SELECT * FROM matLessons WHERE id = $lessonID;";
        $selLQ = $this->db->query($selLesson); // Select lesson if it exists

        if ($selLQ->num_rows > 0) {
            $lesson = $selLQ->fetch_assoc();
            $status = $lesson['state']; // get the status of the lesson

            // Format Versions
            $title = $title . "|sepData|"; // title will be saved as this, overwriting the draft data; "moving" the draft data to the published section

            $description = $description . "|sepData|"; // same thing done here as with the title
            //

            if ($status == "Published") { // If the status is already in Published state, there is no need to update the state
                $updateLesson = "UPDATE matLessons SET title = '$title', description = '$description', dateUpdated = now() WHERE id = $lessonID;";
            } else { // Otherwise, it will be set to Published along with the data
                $updateLesson = "UPDATE matLessons SET title = '$title', description = '$description', dateUpdated = now(), state = 'Published' WHERE id = $lessonID;";
            }

            if ($this->db->query($updateLesson)) { // Saves the lesson's general information
                $pages = $pageData . "|sepData|"; // sets the data as published, "moving" to published section.

                $updatePage = "UPDATE matPages SET content = '$pages' WHERE lessonID = $lessonID;";
                if ($this->db->query($updatePage)) { // Overwrite everything in the content column of a page record
                    return true;
                }
            }

        }
        //

        return false;
    }

    //
}