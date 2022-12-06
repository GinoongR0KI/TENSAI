<?php

if(session_status() === PHP_SESSION_NONE) {session_start();} // Checks and activates the session
require_once("../../Email/tensaimailer.php");

class registration {

    private $db;

    function __construct($db) {
        $this->db = $db;
    }

    function createAccount($email, $schoolID) {
        // Find if account exists
        // Insert new account if it does not
        // send an email

        // SQL Injection Prevention
        $email = mysqli_real_escape_string($this->db,$email);
        $uType = null;
        $schoolID = mysqli_real_escape_string($this->db, $schoolID);
        //

        if ($email == null || $email == "") {return false;} // Check if the email is filled up
        if ($schoolID == null || $schoolID == "null") {return false;}

        if (!$this->accountExists($email)) {
            // Insert a new account here
            switch ($_SESSION['uType']) { // Determine which user type this account will be based on the user type of the account that created it
                case "Admin":
                    $uType = "Principal";
                break;
                case "Principal":
                    $uType = "Teacher";
                    $schoolID = $_SESSION['schoolID'];
                break;
                case "Teacher":
                    $uType = "Student";
                    $schoolID = $_SESSION['schoolID'];
                break;
            }
            $ins = "INSERT INTO uAccounts (email, uType, dateCreated, isActivated) VALUES ('$email', '$uType', now(), 0);";
            
            if ($this->db->query($ins)) {
                // Successfully Created a new account
                // Create other account information if necessary
                // Create a new confirmation code for this new account
                // Create an instance of email.php to be able to send email

                $accID = $this->getID($email);

                switch ($uType) {
                    case "Principal":
                        if ($schoolID != null) {
                            $assign = "UPDATE etcSchools SET principalID = $accID WHERE id = $schoolID;";
                            $this->db->query($assign); // assigns this account to the school record
                        }
                    break;
                    case "Teacher":
                        $ins = "INSERT INTO uTeachers (id, school) VALUES ($accID, $schoolID);";
                        $this->db->query($ins); // create new log in teachers table
                    break;
                    case "Student":
                        $ins = "INSERT INTO uStudents (id, school) VALUES ($accID, $schoolID);";
                        $this->db->query($ins); // create new log in students table
                    break;
                }

                $code = $this->createCode($email);

                if ($code != null || $code != "" || $code != false) {
                    $mailer = new tensaimailer(); // Create an emailer instance

                    // Send an email with the information
                    $content = file_get_contents("../../Email/confirmation.php"); // Get the email page from file
                    $content = sprintf($content, $email, $email, $uType, $code); // Fill up the special characters from the email with variable values.
                    $mailer->send($email, "TENSAI Account Activation", $content); // Sends the email to the receiver.

                    return true; // Account has been created successfully, as well as the email was sent
                }
                
            }
        }

        // Failed to Create new account
        return false;
    }

    function accountExists($email) {
        $sel = "SELECT email FROM uAccounts WHERE email = '$email'";
        $dbquery = $this->db->query($sel);

        if ($dbquery->num_rows > 0) {
            // There is an account found
            return true;
        }

        return false; // If it reaches here, then there is no account found with the same email.
    }

    function getID($email) {
        $sel = "SELECT id FROM uAccounts WHERE email = '$email';";
        $selQuery = $this->db->query($sel);

        if ($selQuery->num_rows > 0) {
            while ($result = $selQuery->fetch_assoc()) {return $result['id'];} // get the user ID
        }

        return false; // failed to retrieve user ID;
    }

    function getType($email) {
        $sel = "SELECT uType FROM uAccounts WHERE email = '$email';";
        $selQuery = $this->db->query($sel);

        if ($selQuery->num_rows > 0) {
            $result = $selQuery->fetch_assoc();
            return $result['uType'];
        }

        return false;
    }

    function createCode($email) {
        $selAcc = "SELECT id FROM uAccounts WHERE email = '$email';";
        $dbquery = $this->db->query($selAcc);

        if ($dbquery->num_rows > 0) {
            while ($results = $dbquery->fetch_assoc()) {
                $id = $results['id'];
            }
        }

        $code = "10SAI|$id|" . date("Y/m/d H:i:s"); // Value to encrypt as the key.
        $code = md5($code); // Encrypts the confirmation key.

        $create = "INSERT INTO etcCodes (code, email, purpose, dateCreated, dateExpiry, status) VALUES ('$code', '$email', 'Confirmation', now(), DATE_ADD(now(), INTERVAL 24 hour), 'Active');";
        if ($this->db->query($create)) {
            // Successful creation
            return $code;
        }

        return false; // The code creation failed at this point.
    }

}