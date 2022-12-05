<?php

class accountManager {
    
    private $db;

    function __construct($db) {
        $this->db = $db;
    }

    function displayAccounts($search) {
        $role = $_SESSION['uType'];
        switch ($role) {
            case "Admin":
                $this->displayAccounts_Admin($search);
            break;

            default:
                $this->displayAccounts_School($search);
            break;
        }
    }

    function displayAccounts_Admin($search) { // This is from the neo
        // Clean SQL Injection
        $search = mysqli_real_escape_string($this->db, $search);
        //

        // Process
        $currID = $_SESSION['id'];
        $selAccounts = "SELECT * FROM uAccounts WHERE id != $currID";

            // Searching
        if ($search != null || $search != "") {
            $selAccounts .= " AND (id LIKE '$search%' OR fname LIKE '$search%' OR mname LIKE '$search%' OR lname LIKE '$search%' OR email LIKE '$search%')";
        }
        $selAccounts .= ";";
            //

        $selAQ = $this->db->query($selAccounts);

        if ($selAQ->num_rows > 0) {
            $json_string = "";

            echo "[";
            while ($accounts = $selAQ->fetch_assoc()) {
                $json_string .= json_encode($accounts) . ","; // Encode all account records
            }
            echo rtrim($json_string, ",");
            echo "]";
        }
        //
    }

    function displayAccounts_School($search) {
        // Clean SQL Injection
        $search = mysqli_real_escape_string($this->db, $search);
        //

        // Process
        $uID = $_SESSION['id'];
        $schoolID = $_SESSION['schoolID'];

        // Get accounts from same school including teachers and students account
        $selTeachers = "SELECT uAccounts.id as id, fname, mname, lname, email, uType, dateCreated, isActivated FROM uAccounts, uTeachers WHERE uAccounts.id = uTeachers.id AND school = $schoolID";
        $selStudents = "SELECT uAccounts.id as id, fname, mname, lname, email, uType, dateCreated, isActivated FROM uAccounts, uStudents WHERE uAccounts.id = uStudents.id AND school = $schoolID";

            // Searching
        if ($search != null || $search != "") {
            $selTeachers .= " AND (uAccounts.id LIKE '$search%' OR fname LIKE '%$search%' OR mname LIKE '%$search%' OR lname LIKE '%$search%' OR email LIKE '$search%')";
            $selStudents .= " AND (uAccounts.id LIKE '$search%' OR fname LIKE '%$search%' OR mname LIKE '%$search%' OR lname LIKE '%$search%' OR email LIKE '$search%')";
        }
            //

        $selTQ = $this->db->query($selTeachers);
        $selSQ = $this->db->query($selStudents);

        $json_string = "";

        echo "[";
        if ($selTQ->num_rows > 0) {
            while ($teachers = $selTQ->fetch_assoc()) {
                $json_string .= json_encode($teachers) . ",";
            }
        }
        if ($selSQ->num_rows > 0) {
            while ($students = $selSQ->fetch_assoc()) {
                $json_string .= json_encode($students) . ",";
            }
        }
        echo rtrim($json_string, ",");
        echo "]";

        //
    }

    // TERMINATION
    function terminate($accID) {
        // Clean SQL Injection
        $accID = mysqli_real_escape_string($this->db, $accID);
        //

        // Variables
        $selAccount = "SELECT * FROM uAccounts WHERE id = $accID";
        $selAQ = $this->db->query($selAccount);

        $id = null;
        $uType = null;
        $email = null;

        $terminate = "UPDATE uAccounts SET isActivated = 0 WHERE id = $accID";
        //

        // Process
        if ($selAQ->num_rows > 0) {
            $account = $selAQ->fetch_assoc(); // Get details from here
            $id = $account['id'];
            $uType = $account['uType'];
            $email = $account['email'];
        }

        if ($this->db->query($terminate)) {
            if ($uType != null || $uType != "") {
                switch($uType) {
                    case "Principal":
                        $unassign = "UPDATE etcSchools SET principalID = NULL WHERE principalID = $id;";
                    break;
                    case "Teacher":
                        $del = "DELETE FROM uTeachers WHERE id = $id;";
                    break;
                    case "Student":
                        $del = "DELETE FROM uStudents WHERE id = $id;";
                    break;
                }

                if (isset($del)) {$this->db->query($del);}
                if (isset($unassign)) {$this->db->query($unassign);}
            }

            $delCode = "DELETE FROM etcCodes WHERE email = '$email';";
            $this->db->query($delCode); // delete codes from this email

            return true;
        } else {
            return false;
        }
        //
    }

    // GETTER

    function getAccountDetails($email) {
        // Clean SQL Injection
        $email = mysqli_real_escape_string($this->db, $email);
        //

        // Variables
        $sel = "SELECT id, uType FROM uAccounts WHERE email = '$email';";
        $selQ = $this->db->query($sel);
        //

        // Process
        if ($selQ->num_rows > 0) {
            while ($result = $selQ->fetch_assoc()) {
                $accID = $result['id'];
                switch ($result['uType']) {
                    case "Teacher":
                        $sel = "SELECT * FROM uTeachers WHERE id = $accID;";
                    break;
                    case "Student":
                        $sel = "SELECT * FROM uStudents WHERE id = $accID;";
                    break;
                }
                $dbQ = $this->db->query($sel);

                if ($dbQ-> num_rows > 0) {
                    $json_string = ""; // Instantiate the JSON string

                    echo "["; // beginning of the JSON data
        
                    while ($results = $dbQ->fetch_assoc()) {
                        $json_string .= json_encode($results) . ","; // Encode the results into JSON format.
                    }
                    echo rtrim($json_string, ","); // remove the last , mark and return the JSON data.
                    echo "]"; // Close the JSON data off.
                }
            }
        }
        //
    }

    function edit($email, $fname, $mname, $lname) {
        // Clean SQL Injection
        $email = mysqli_real_escape_string($this->db, $email);
        $fname = mysqli_real_escape_string($this->db, $fname);
        $mname = mysqli_real_escape_string($this->db, $mname);
        $lname = mysqli_real_escape_string($this->db, $lname);
        //

        // Variables
        $edit = "UPDATE uAccounts SET fname = '$fname', mname = '$mname', lname = '$lname' WHERE email = '$email';";
        //

        // Process
        if ($this->db->query($edit)) {
            return true;
        }

        return false;
        //
    }

    function editTeacher($email, $fname, $mname, $lname, $profID, $schoolID) {
        // Clean SQL Injection
        $email = mysqli_real_escape_string($this->db, $email);
        $fname = mysqli_real_escape_string($this->db, $fname);
        $mname = mysqli_real_escape_string($this->db, $mname);
        $lname = mysqli_real_escape_string($this->db, $lname);
        $profID = mysqli_real_escape_string($this->db, $profID);
        $schoolID = mysqli_real_escape_string($this->db, $schoolID);
        //

        // Variables
        $sel = "SELECT * FROM uAccounts WHERE email = '$email';";
        $selQ = $this->db->query($sel);

        $editGen = "UPDATE uAccounts SET fname = '$fname', mname = '$mname', lname = '$lname' WHERE email = '$email';";
        if ($selQ->num_rows > 0) {
            while ($result = $selQ->fetch_assoc()) {
                $id = $result['id'];
                $schoolID = $schoolID != null && $schoolID != "" ? $schoolID : null;
                if ($schoolID != null && $schoolID != "") {
                    $editTeach = "UPDATE uTeachers SET profID = $profID, school = $schoolID WHERE id = $id;";
                } else {
                    $editTeach = "UPDATE uTeachers SET profID = $profID, school = null WHERE id = $id;";
                }
            }
        }
        //

        // Process
        if ($this->db->query($editGen)) {
            if ($this->db->query($editTeach)) {
                echo "true";
                exit;
            } else {
                echo "false";
                exit;
            }
        }

        echo "false";
        //
    }

    function editStudent($email, $fname, $mname, $lname, $bday, $sex, $gfname, $gmname, $glname, $gcontact, $gemail) {
        // Clean SQL Injection
        $email = mysqli_real_escape_string($this->db, $email);
        $fname = mysqli_real_escape_string($this->db, $fname);
        $mname = mysqli_real_escape_string($this->db, $mname);
        $lname = mysqli_real_escape_string($this->db, $lname);
        $bday = mysqli_real_escape_string($this->db, $bday);
        $sex = mysqli_real_escape_string($this->db, $sex);
        $gfname = mysqli_real_escape_string($this->db, $gfname);
        $gmname = mysqli_real_escape_string($this->db, $gmname);
        $glname = mysqli_real_escape_string($this->db, $glname);
        $gcontact = mysqli_real_escape_string($this->db, $gcontact);
        $gemail = mysqli_real_escape_string($this->db, $gemail);
        //

        // Variables
        $sel = "SELECT * FROM uAccounts WHERE email = '$email';";
        $selQ = $this->db->query($sel);

        $editGen = "UPDATE uAccounts SET fname = '$fname', mname = '$mname', lname = '$lname' WHERE email = '$email';";
        if ($selQ->num_rows > 0) {
            while ($result = $selQ->fetch_assoc()) {
                $id = $result['id'];
                $editStud = "UPDATE uStudents SET gfname = '$gfname', gmname = '$gmname', glname = '$glname', gemail = '$gemail', gcontact = $gcontact, bday = '$bday', sex = '$sex' WHERE id = $id;";
            }
        }
        //

        // Process
        if ($this->db->query($editGen)) {
            if ($this->db->query($editStud)) {
                echo "true";
                exit;
            } else {
                echo "false";
                exit;
            }
        }

        echo "false";
        //
    }

    function delete($accID) {
        // Clean SQL Injection
        $accID = mysqli_real_escape_string($this->db, $accID);
        //

        // variables
        $sel = "SELECT * FROM uAccounts WHERE id = $accID;";

        $id = null;
        $utype = null;

        $delete = "DELETE FROM uAccounts WHERE id = $accID;";
        //

        // Process
            // Get the values of the email account
        $selQuery = $this->db->query($sel);
        if ($selQuery->num_rows > 0) {
            while ($results = $selQuery->fetch_assoc()) {
                $id = $results['id']; // use this to find data related to this account.
                $utype = $results['uType']; // use this to find which data to look for.
            }
        }

        if ($this->db->query($delete)) {
            if ($utype != null || $utype != "") {
                switch ($utype) {
                    case "Principal":
                        $unassign = "UPDATE etcSchools SET principalID = NULL WHERE principalID = $id;";
                    break;
                    case "Teacher":
                        $del = "DELETE FROM uTeachers WHERE id = $id;";
                    break;
                    case "Student":
                        $del = "DELETE FROM uStudents WHERE id = $id;";
                    break;
                }
                if (isset($del)) {$this->db->query($del);}
                if (isset($unassign)) {$this->db->query($unassign);}
            }

            $del = "DELETE FROM etcCodes WHERE email = '$email';";
            $this->db->query($del); // delete codes from this email
            
            // $del = "DELETE FROM etcDeletion WHERE relID = $id AND fromTable = 'uAccounts';";
            // $this->db->query($del); // delete deletion requests with this account's limit

            return true;
        }

        return false;
        //
    }

    function delete_cancel($id) {
        // We update the account status back to Active and delete the log from the deletion table.

        $update = "UPDATE uAccounts SET status = 'Active';";
        $delete = "DELETE FROM etcDeletion WHERE relID = $id AND fromTable = 'uAccounts';";
    }

    function getID($email) {
        $sel = "SELECT id FROM uAccounts WHERE email = '$email';";
        $selQuery = $this->db->query($sel);

        if ($selQuery->num_rows > 0) {
            while ($result = $selQuery->fetch_assoc()) {return $result['id'];} // get the user ID
        }

        return false; // failed to retrieve user ID;
    }

}