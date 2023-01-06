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

            // Updated Conditional Statement fit for Draft, Pending, and Published states and its variants
            $status = explode("/", $status);

            if ($status[0] == "Draft") {
                $updateLesson = "UPDATE matLessons SET title = '$pubDraftTitle', description = '$pubDraftDescription', dateUpdated = now() WHERE id = $lessonID;";
            } else if ($status[0] == "Published") {
                $updateLesson = "UPDATE matLessons SET title = '$pubDraftTitle', description = '$pubDraftDescription', dateUpdated = now(), state = 'Published/Draft' WHERE id = $lessonID;";
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

    function request($lessonID, $title, $description, $pageData) {
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

            // There are the states of Draft, Pending, and Published. With the addition of the variants Draft/Pending, Published/Draft, and Published/Pending.
            $status = explode("/", $status);

            if ($status[0] == "Draft") {
                $updateLesson = "UPDATE matLessons SET title = '$pubDraftTitle', description = '$pubDraftDescription', dateUpdated = now(), state = 'Draft/Pending' WHERE id = $lessonID;";
            } else if ($status[0] == "Published") {
                $updateLesson = "UPDATE matLessons SET title = '$pubDraftTitle', description = '$pubDraftDescription', dateUpdated = now(), state = 'Published/Pending' WHERE id = $lessonID;";
            } else {
                $updateLesson = "UPDATE matLessons SET title = '$pubDraftTitle', description = '$pubDraftDescription', dateUpdated = now(), state = 'Pending' WHERE id = $lessonID;";
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

    function publish($lessonID) {
        // Clean SQL Injection
        $lessonID = mysqli_real_escape_string($this->db, $lessonID);
        //

        $selLesson = "SELECT * FROM matLessons WHERE id = $lessonID;";
        $selLQ = $this->db->query($selLesson);

        $selPages = "SELECT * FROM matPages WHERE lessonID = $lessonID;";
        $selPQ = $this->db->query($selPages);

        if ($selLQ->num_rows > 0) {
            $lesson = $selLQ->fetch_assoc();
            $status = $lesson['state'];

            $pages = $selPQ->fetch_assoc();
            $sepPages = explode("|sepData|", $pages['content']);

            if ($status == "Pending" || $status == "Draft/Pending" || $status == "Published/Pending") {
                $sepTitle = explode("|sepData|", $lesson['title']);
                $sepDesc = explode("|sepData|", $lesson['description']);

                if (!empty($sepTitle[1])) {
                    $title = $sepTitle[1] . "|sepData|";
                } else {
                    $title = $sepTitle[0] . "|sepData|";
                }

                if (!empty($sepDesc[1])) {
                    $desc = $sepDesc[1] . "|sepData|";
                } else {
                    $desc = $sepDesc[0] . "|sepData|";
                }

                if (!empty($sepPages[1])) {
                    $content = $sepPages[1] . "|sepData|";
                } else {
                    $content = $sepPage[0] . "|sepData|";
                }

                // Set new values to title, description, and content of the lesson by transferring the Drafted data to the published data
                $updateLesson = "UPDATE matLessons SET title = '$title', description = '$desc', dateUpdated = now(), state = 'Published' WHERE id = $lessonID;";
                if ($this->db->query($updateLesson)) {
                    // Update the pages
                    $updatePages = "UPDATE matPages SET content = '$content' WHERE lessonID = $lessonID;";
                    if ($this->db->query($updatePages)) {
                        return true; // Successfully Published the title, description, and contents of the new lesson
                    }
                }
            }
        }

        return false;
    }

    function publish_obs($lessonID, $title, $description, $pageData) {
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