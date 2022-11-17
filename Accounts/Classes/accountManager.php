<?php

class accountManager {
    
    private $db;

    function __construct($db) {
        $this->db = $db;
    }

    // function displayAccounts($search) { // This function is to be used for an AJAX call; also a dynamic script capable of using a search filter.

    //     // Clean SQL Injection
    //     $search = mysqli_real_escape_string($this->db, $search);
    //     //

    //     // Admins = SELECT * and will only filter if it's been used
    //     // As for Principals and Teachers, they will have to be limited by their school
    //     // To get the school, the Principal must provide the school ID he is assigned to which is a select query on the etcSchools table to find his id.
    //     // The Teachers can be found through the uTeachers table provided that there is a schoolID.

    //     $sel = "SELECT * FROM uAccounts";

    //     $uID = $_SESSION['id'];
    //     $sel .= " WHERE uType != 'Admin' AND id != $uID";
    //     if ($search != null && $search != "") {
    //         $sel .= " AND id LIKE '$search%' OR fname LIKE '$search%' OR mname LIKE '$search%' OR lname LIKE '$search%' OR email LIKE '$search%'";
    //     }

    //     if ($_SESSION['uType'] != "Admin") {
    //         $schoolID = $_SESSION['schoolID'];
    //         $selStudents = "SELECT * FROM uStudents WHERE school = $schoolID;";
    //         $selSQ = $this->db->query($selStudents);

    //         if ($selSQ->num_rows > 0) {
    //             while ($students = $selSQ->fetch_assoc()) {
    //                 $studentID = $students['id'];
    //                 $sel .= " OR id = $studentID";
    //             }
    //         }

    //         $selTeachers = "SELECT * FROM uTeachers WHERE school = $schoolID;";
    //         $selTQ = $this->db->query($selTeachers);

    //         if ($selTQ->num_rows > 0) {
    //             while($teachers = $selTQ->fetch_assoc()) {
    //                 $teacherID = $teachers['id'];
    //                 $sel .= " OR id = $teacherID";
    //             }
    //         }
    //         // switch ($_SESSION['uType']) {
    //         //     case "Principal":
                    
    //         //     break;
    //         //     case "Teacher":
    //         //     break;
    //         // }
    //     }

    //     $sel .= " ORDER BY uType DESC";
    //     $sel .= ";";

    //     $dbquery = $this->db->query($sel);

    //     if ($dbquery->num_rows > 0) {

    //         $json_string = ""; // Instantiate the JSON string

    //         echo "["; // beginning of the JSON data

    //         while ($results = $dbquery->fetch_assoc()) {
    //             $json_string .= json_encode($results) . ","; // Encode the results into JSON format.
    //         }
    //         echo rtrim($json_string, ","); // remove the last , mark and return the JSON data.
    //         echo "]"; // Close the JSON data off.
    //     }
    // }

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

        $selAccounts = "SELECT uAccounts.id as id, fname, mname, lname, email, uType, dateCreated, isActivated FROM uAccounts, uTeachers WHERE uAccounts.id = uTeachers.id AND school = $schoolID";

            // Searching
        if ($search != null || $search != "") {
            $selAccounts .= " AND (uAccounts.id LIKE '$search%' OR fname LIKE '$search%' OR mname LIKE '$search%' OR lname LIKE '$search%' OR email LIKE '$search%')";
        }
        $selAccounts .= ";";
            //

        $selAQ = $this->db->query($selAccounts);
        
        if ($selAQ->num_rows > 0) {
            $json_string = "";

            echo "[";
            while ($accounts = $selAQ->fetch_assoc()) {
                $json_string .= json_encode($accounts) . ",";

            }
            echo rtrim($json_string, ",");
            echo "]";
        }
        //
    }

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

    function delete($email) {
        // Clean SQL Injection
        $email = mysqli_real_escape_string($this->db, $email);
        //

        // variables
        $sel = "SELECT * FROM uAccounts WHERE email = '$email';";

        $id = null;
        $utype = null;

        $delete = "DELETE FROM uAccounts WHERE email = '$email';";
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