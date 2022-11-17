<?php

// This script should run daily from the web server.
// This is to rid of expiring codes, as well as deletion of accounts, and materials in the system.
require_once("dbConn.php");

// Variables
$errors = [];
$sel = "SELECT * FROM etcDeletion;";
//

$dbquery = $db->query($sel); // Selection query to get all logs from the deletion table.

if ($dbquery->num_rows > 0) {

    while ($results = $dbquery->fetch_assoc()) {

        // Get the important column values from the previous query.
        $logID = $results['id'];
        $table = $results['fromTable'];
        $relID = $results['relID'];
        $expiry = $results['dateExpiry'];
        //

        if ($expiry >= date("Y/m/d H:i:s")) { // Checks if the log is expired today.
            $del = "DELETE FROM $table WHERE id = $relID;"; // creates a deletion query

            if (!$db->query($del)) { // Checks if the query has been a failure
                array_push($errors, $db->error); // Adds the error in the array.
            }

            $del = "DELETE FROM etcDeletion WHERE id = $logID;"; // Creates a deletion query for the deletion logs
            $db->query($del); // executes the logs deletion query.
        }

    }

}

echo "Deletion Executed with " . count($errors) . " error(s)."; // Displays how many errors has been made.

$db->close();