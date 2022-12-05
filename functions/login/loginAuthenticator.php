<?php

class loginAuthenticator {

    // Class Variables
//
    private $db;
    // Class Variables

    // Built-in Functions
    function __construct($db) {
        $this->db = $db;
    }
    // Built-in Functions

    // Custom Functions

    function authenticate($email, $password) {
        $sel = "SELECT * FROM uAccounts WHERE email = '$email';";
        $dbquery = $this->db->query($sel);

        if ($dbquery->num_rows > 0) { // This checks if there are accounts with that email address.

            while ($results = $dbquery->fetch_assoc()) {

                if ($results['isActivated'] == true) {
                    if (password_verify($password, $results['password'])) { // Checks if the password matches here.
                        // If this is correct, create the sessions for the account.
                        echo "Login Successful";
                        $_SESSION['isLoggedTENSAI'] = true;
                        $_SESSION['id'] = $results['id'];
                        $_SESSION['email'] = $results['email'];
                        $_SESSION['uType'] = $results['uType'];
                        $_SESSION['fname'] = $results['fname'];
                        $_SESSION['mname'] = $results['mname'];
                        $_SESSION['lname'] = $results['lname'];
                        $_SESSION['dateCreated'] = $results['dateCreated'];
                        $_SESSION['isActivated'] = $results['isActivated'];
                        
                        // User Role specific sessions to include:
                        $uID = $results['id'];

                        switch ($_SESSION['uType']) {
                            case "Admin":
                            break;
                            case "Principal":
                                $selSchool = "SELECT * FROM etcSchools WHERE principalID = $uID;";
                                $selSQ = $this->db->query($selSchool);

                                $schoolID = null;

                                if ($selSQ->num_rows > 0) {$schools = $selSQ->fetch_assoc(); $schoolID = $schools['id']; echo $schools['id'];}

                                $_SESSION['schoolID'] = $schoolID; // sets the school ID from the extra query
                            break;
                            case "Teacher":
                                $selTeacher = "SELECT * FROM uTeachers WHERE id = $uID;";
                                $selTQ = $this->db->query($selTeacher);

                                if ($selTQ->num_rows > 0) {$teachers = $selTQ->fetch_assoc();}

                                $selSections = "SELECT * FROM etcSections WHERE advisorID = $uID;";
                                $selSQ = $this->db->query($selSections);

                                if ($selSQ->num_rows > 0) {$sections = $selSQ->fetch_assoc();}

                                $_SESSION['profID'] = $teachers['profID'];
                                $_SESSION['schoolID'] = $teachers['school'];
                                $_SESSION['sectionID'] = $sections['id'];
                            break;
                            case "Student":
                                $selStudent = "SELECT * FROM uStudents WHERE id = $uID;";
                                $selSQ = $this->db->query($selStudent);

                                if ($selSQ->num_rows > 0 ) {$students = $selSQ->fetch_assoc();}

                                $_SESSION['gfname'] = $students['gfname'];
                                $_SESSION['gmname'] = $students['gmname'];
                                $_SESSION['glname'] = $students['glname'];
                                $_SESSION['gcontact'] = $students['gcontact'];
                                $_SESSION['gemail'] = $students['gemail'];
                                $_SESSION['schoolID'] = $students['school'];
                                $_SESSION['section'] = $students['section'];
                                $_SESSION['bday'] = $students['bday'];
                                $_SESSION['sex'] = $students['sex'];
                            break;
                        }
    
                        // After setting the sessions, the user may now proceed to the system dashboard as an authorized user (role-dependent).
                        if ($_SESSION['uType'] != "Student") {
                            header("Location: dashboard.php");
                        } else {
                            header("Location: student.php");
                        }
                        
                        return true;
                        exit;
                    } else {
                        return "Login Failed: Wrong Password or Email.";
                    }

                } else { // The account is yet to be confirmed
                    return "This account needs to be confirmed. An email should be sent to $email.";
                }

                

            }

        } else { // If there is no account found
            return "Enter a valid email address";
        }

        $this->db->close();

    }




    // Custom Functions


}