<?php

class reportManager {
    // Vars
    private $db;
    //

    // Built-in
    function __construct($db) {
        $this->db = $db;
    }
    //

    // Functions
    // function displayReports($search) {
    //     switch ($_SESSION['uType']) {
    //         case "Admin":
    //             $this->displayReports_Admin($search);
    //         break;
    //         default:
    //             $this->displayReports_School($search);
    //         break;
    //     }
    // }

    // function displayReports_School($search) {
    //     // Clean SQL Injection
    //     $search = mysqli_real_escape_string($this->db, $search);
    //     //

    //     // Vars
    //     if (!isset($_SESSION['sectionID'])) {return false;}
    //     $section = $_SESSION['sectionID'];
    //     //

    //     // Records have id, studentID, assessment ID, score, items, dateTaken
    //     // We get all the information of the student that has taken up an assessment
    //     // Get all the records that is related to a certain section / school.
    //     // Select * students from our school / section, get all their 

    //     // $selStudents = "SELECT * FROM uStudents WHERE section = $section;"; // get all the students who are a part of  the same section
    //     $selStudents = "SELECT uAccounts.id as id, fname, mname, lname FROM uAccounts, uStudents WHERE uStudents.id = uAccounts.id AND section = $section"; // get all students in same section

    //     // Searching
    //     if ($search != "" || $search != null) {
    //         $selStudents .= " AND (uAccounts.id LIKE '$search%' OR fname LIKE '$search%' OR mname LIKE '$search%' OR lname LIKE '$search%' OR email LIKE '$search%')";
    //     }
    //     $selStudents .= ";";
    //     //

    //     $selSQ = $this->db->query($selStudents);

    //     if ($selSQ->num_rows > 0) {
    //         $json_string = "";

    //         echo "[";

    //         while ($students = $selSQ->fetch_assoc()) {
    //             $studID = $students['id'];

    //             $selRecords = "SELECT recScores.*, matAssessments.title FROM recScores, matAssessments WHERE matAssessments.id = recScores.assessmentID AND recScores.studentID = $studID;"; // Get all records from one of the students that are part of the same section

    //             $selRQ = $this->db->query($selRecords);

    //             if ($selRQ->num_rows > 0) {

    //                 while ($records = $selRQ->fetch_assoc()) {

    //                     $json_string .= json_encode($records + $students) . ",";
    //                 }

    //             }
    //         }


    //         echo rtrim($json_string, ",");
    //         echo "]";
    //     }

    // }

    // function displayReports_Admin($search) {
    //     // Clean SQL Injection
    //     $search = mysqli_real_escape_string($this->db, $search);
    //     //

    //     $selStudents = "SELECT uAccounts.id as id, fname, mname, lname FROM uAccounts, uStudents WHERE uStudents.id = uAccounts.id";
    //     // Searching
    //     if ($search != "" || $search != null) {
    //         $selStudents .= " AND (uAccounts.id LIKE '$search%' OR fname LIKE '$search%' OR mname LIKE '$search%' OR lname LIKE '$search%' OR email LIKE '$search%')";
    //     }
    //     $selStudents .= ";";
    //     //

    //     $selSQ = $this->db->query($selStudents);

    //     if ($selSQ->num_rows > 0) {
    //         $json_string = "";

    //         echo "[";
    //         while ($students = $selSQ->fetch_assoc()) {
    //             $studID = $students['id'];

    //             $selRecords = "SELECT recScores.*, matAssessments.title FROM recScores, matAssessments WHERE matAssessments.id = recScores.assessmentID AND recScores.studentID = $studID;"; // Get all records from one of the students that are part of the same section

    //             $selRQ = $this->db->query($selRecords);

    //             if ($selRQ->num_rows > 0) {

    //                 while ($records = $selRQ->fetch_assoc()) {

    //                     $json_string .= json_encode($records + $students) . ",";
    //                 }

    //             }
    //         }
    //         echo rtrim($json_string, ",");
    //         echo "]";
    //     }
    // }

    function displayReports($userID) {
        // Clean SQL Injection
        $userID = mysqli_real_escape_string($this->db, $userID);
        //

        $selReports = "SELECT recScores.*, matAssessments.title FROM recScores, matAssessments WHERE studentID = $userID AND recScores.assessmentID = matAssessments.id";
        $selRQ = $this->db->query($selReports);

        if ($selRQ->num_rows > 0) {
            $json_string = "";

            echo "[";
            while ($records = $selRQ->fetch_assoc()) {
                $json_string .= json_encode($records) . ",";
            }
            echo rtrim($json_string, ",");
            echo "]";
        }
    }
        // Results
    
    // Admin Commands - Report Generation
    function reportSchools($search) {
        // This will return all the reports from that specific school

        $selReports = "SELECT * FROM etcSchools";
        // Insert code block here for searching function
        $selRQ = $this->db->query($selReports);

        if ($selRQ->num_rows > 0) {
            $json_string = "";

            echo "[";
            while ($schools = $selRQ->fetch_assoc()) {
                $json_string .= json_encode($schools) . ",";
            }
            echo rtrim($json_string, ",");
            echo "]";
        }
    }
    // -- Admin Commands - Report Generation

    // Principal Commands - Report Generation
    function reportSchool($schoolID) {
        // get school

        // SQL Injection
        $schoolID = mysqli_real_escape_string($this->db, $schoolID);
        //

        $selSchool = "SELECT * FROM etcSchools WHERE id = $schoolID;";
        $selSQ = $this->db->query($selSchool);

        if ($selSQ->num_rows > 0) {
            $json_string = "";

            echo "[";
            while ($school = $selSQ->fetch_assoc()) {
                $json_string .= json_encode($school) . ",";
            }
            echo rtrim($json_string, ",");
            echo "]";
        }
    }

    function reportSections($schoolID) {
        // get all sections from specific school

        // SQL Injection
        $schoolID = mysqli_real_escape_string($this->db, $schoolID);
        //

        $selSections = "SELECT * FROM etcSections WHERE schoolID = $schoolID";
        // Insert code block here for searching function
        $selSQ = $this->db->query($selSections);

        if ($selSQ->num_rows > 0) {
            $json_string = "";

            echo "[";
            while ($sections = $selSQ->fetch_assoc()) {
                $json_string .= json_encode($sections) . ",";
            }
            echo rtrim($json_string, ",");
            echo "]";
        }
    }
    // -- Principal Commands - Report Generation

    // Teachers Commands - Report Generation
    function reportSection($sectionID) {
        // select a specific section

        // SQL Injection
        $sectionID = mysqli_real_escape_string($this->db, $sectionID);
        //

        $selSection = "SELECT * FROM etcSections WHERE id = $sectionID";
        $selSQ = $this->db->query($selSection);

        if ($selSQ->num_rows > 0) {
            $json_string = "";

            echo "[";
            while ($section = $selSQ->fetch_assoc()) {
                $json_string .= json_encode($section) . ",";
            }
            echo rtrim($json_string, ",");
            echo "]";
        }
    }

    function reportStudentsAdmin($search) {
        // SQL Injection
        $search = mysqli_real_escape_string($this->db, $search);
        //

        $selStudents = "SELECT uAccounts.id, fname, mname, lname, gfname, gmname, glname, gemail, gcontact, school, section, bday, sex FROM uAccounts, uStudents WHERE (uAccounts.id = uStudents.id AND uAccounts.isActived == 1)";
        // Insert code block here for searching function
        if (!empty($search)) {
            $selStudents .= " AND (uAccounts.id LIKE '$search%' OR fname LIKE '%$search%' OR mname LIKE '%$search%' OR lname LIKE '%$search%' OR email LIKE '$search%')";
        }
        $selSQ = $this->db->query($selStudents);

        if ($selSQ->num_rows > 0) {
            $json_string = "";

            echo "[";
            while ($students = $selSQ->fetch_assoc()) {
                $json_string .= json_encode($students) . ",";
            }
            echo rtrim($json_string, ",");
            echo "]";
        }
    }

    function reportStudentsPrincipal($schoolID, $search) {
        // Get all the students from specific section

        // SQL Injection
        $schoolID = mysqli_real_escape_string($this->db, $schoolID);
        $search = mysqli_real_escape_string($this->db, $search);
        //

        $selStudents = "SELECT uAccounts.id, fname, mname, lname, gfname, gmname, glname, gemail, gcontact, school, section, bday, sex FROM uAccounts, uStudents WHERE (uAccounts.id = uStudents.id AND school = $schoolID  AND uAccounts.isActived == 1)";
        // Insert code block here for searching function
        if (!empty($search)) {
            $selStudents .= " AND (uAccounts.id LIKE '$search%' OR fname LIKE '%$search%' OR mname LIKE '%$search%' OR lname LIKE '%$search%' OR email LIKE '$search%')";
        }
        $selSQ = $this->db->query($selStudents);

        if ($selSQ->num_rows > 0) {
            $json_string = "";

            echo "[";
            while ($students = $selSQ->fetch_assoc()) {
                $json_string .= json_encode($students) . ",";
            }
            echo rtrim($json_string, ",");
            echo "]";
        }
    }

    function reportStudentsTeacher($sectionID, $search) {
        // Get all the students from specific section

        // SQL Injection
        $sectionID = mysqli_real_escape_string($this->db, $sectionID);
        $search = mysqli_real_escape_string($this->db, $search);
        //

        $selStudents = "SELECT uAccounts.id, fname, mname, lname, gfname, gmname, glname, gemail, gcontact, school, section, bday, sex FROM uAccounts, uStudents WHERE (uAccounts.id = uStudents.id AND section = $sectionID AND uAccounts.isActived == 1)";
        // Insert code block here for searching function
        if (!empty($search)) {
            $selStudents .= " AND (uAccounts.id LIKE '$search%' OR fname LIKE '%$search%' OR mname LIKE '%$search%' OR lname LIKE '%$search%' OR email LIKE '$search%')";
        }
        $selSQ = $this->db->query($selStudents);

        if ($selSQ->num_rows > 0) {
            $json_string = "";

            echo "[";
            while ($students = $selSQ->fetch_assoc()) {
                $json_string .= json_encode($students) . ",";
            }
            echo rtrim($json_string, ",");
            echo "]";
        }
    }
    // -- Teachers Commands - Report Generation

    // Students Commands - Report Generation

    // -- Students Commands - Report Generation


    // Adding

    function add($studentID, $assessID, $score, $items) {
        // Clean SQL Injection
        $studentID = mysqli_real_escape_string($this->db, $studentID);
        $assessID = mysqli_real_escape_string($this->db, $assessID);
        $score = mysqli_real_escape_string($this->db, $score);
        $items = mysqli_real_escape_string($this->db, $items);
        //

        $ins = "INSERT INTO recScores (studentID, assessmentID, score, highestPossible, dateTaken) VALUES ($studentID, $assessID, $score, $items, now());";
        if ($this->db->query($ins)) {
            return true;
        } else {
            return false;
        }
    }
    //

    // Processing
    function getPerformanceOverall($userID) {
        // Clean SQL Injection
        $userID = mysqli_real_escape_string($this->db, $userID);
        //

        $selRecords = "SELECT * FROM recScores WHERE studentID = $userID";
        $selRQ = $this->db->query($selRecords);

        if ($selRQ->num_rows > 0) {
            $overall = 0;
            while ($records = $selRQ->fetch_assoc()) {
                $overall += $records['score'] / $records['highestPossible'];
            }
            $overall /= $selRQ->num_rows;
            $overall = round($overall, 2) * 100;

            return [$overall, $selRQ->num_rows];
        } else {
            return [0, 0];
        }
    }

    function getPerformanceMonthly($userID) {
        // Clean SQL Injection
        $userID = mysqli_real_escape_string($this->db, $userID);
        //

        $selRecords = "SELECT * FROM recScores WHERE studentID = $userID AND dateTaken >= now() - INTERVAL 1 MONTH";
        $selRQ = $this->db->query($selRecords);

        if ($selRQ->num_rows > 0) {
            $monthly = 0;
            while ($records = $selRQ->fetch_assoc()) {
                $monthly += $records['score'] / $records['highestPossible'];
            }
            $monthly /= $selRQ->num_rows;
            $monthly = round($monthly, 2) * 100;

            return [$monthly, $selRQ->num_rows];
        } else {
            return ["Not Enough Data", "N/A"];
        }
    }

    function getPerformanceWeekly($userID) {
        // Clean SQL Injection
        $userID = mysqli_real_escape_string($this->db, $userID);
        //

        $selRecords = "SELECT * FROM recScores WHERE studentID = $userID AND dateTaken >= now() - INTERVAL 7 DAY";
        $selRQ = $this->db->query($selRecords);

        if ($selRQ->num_rows > 0) {
            $weekly = 0;
            while ($records = $selRQ->fetch_assoc()) {
                $weekly += $records['score'] / $records['highestPossible'];
            }
            $weekly /= $selRQ->num_rows;
            $weekly = round($weekly, 2) * 100;
            

            return [$weekly, $selRQ->num_rows];
        } else {
            return ["Not Enough Data", "N/A"];
        }
    }

    function getHighestAssessment($userID) {
        // Clean SQL Injection
        $userID = mysqli_real_escape_string($this->db, $userID);
        //

        $selRecords = "SELECT recScores.*, matAssessments.title as titleAssess, matLessons.title as titleLesson FROM recScores, matAssessments, matLessons WHERE studentID = $userID AND recScores.assessmentID = matAssessments.id AND matAssessments.lessonID = matLessons.id";
        $selRQ = $this->db->query($selRecords);

        if ($selRQ->num_rows > 0) {
            $highest = 0;
            $assessTitle = "N/A";
            $lessonTitle = "N/A";
            $lessonDate = "N/A";
            while ($records = $selRQ->fetch_assoc()) {
                $ave = $records['score'] / $records['highestPossible'];
                if ($highest < $ave) {
                    $highest = $ave;
                    $assessTitle = explode("|sepData|", $records['titleAssess'])[0];
                    $lessonTitle = explode("|sepData|", $records['titleLesson'])[0];
                    $lessonDate = $records['dateTaken'];
                }
            }

            $highest *= 100;
            $highest = round($highest, 2);

            if ($highest == 0) {
                return ["N/A", "N/A", "N/A", "N/A"];
            }

            return [$highest, $assessTitle, $lessonTitle, $lessonDate];
        } else {
            return ["N/A", "N/A", "N/A", "N/A"];
        }
    }

    function getLowestAssessment($userID) {
        // Clean SQL Injection
        $userID = mysqli_real_escape_string($this->db, $userID);
        //

        $selRecords = "SELECT recScores.*, matAssessments.title as titleAssess, matLessons.title as titleLesson FROM recScores, matAssessments, matLessons WHERE studentID = $userID AND recScores.assessmentID = matAssessments.id AND matAssessments.lessonID = matLessons.id";
        $selRQ = $this->db->query($selRecords);

        if ($selRQ->num_rows > 0) {
            $lowest = 101;
            $assessTitle = "N/A";
            $lessonTitle = "N/A";
            $lessonDate = "N/A";
            while ($records = $selRQ->fetch_assoc()) {
                $ave = $records['score'] / $records['highestPossible'];
                if ($lowest >= $ave) {
                    $lowest = $ave;
                    $assessTitle = explode("|sepData|", $records['titleAssess'])[0];
                    $lessonTitle = explode("|sepData|", $records['titleLesson'])[0];
                    $lessonDate = $records['dateTaken'];
                }
            }

            $lowest *= 100;
            $lowest = round($lowest, 2);

            return [$lowest, $assessTitle, $lessonTitle, $lessonDate];
        } else {
            return ["N/A","N/A","N/A", "N/A"];
        }
    }

        // Optionals

    function getStudentName($userID) {
        // Clean SQL Injection
        $userID = mysqli_real_escape_string($this->db, $userID);
        //

        $selStudent = "SELECT fname, mname, lname FROM uAccounts, uStudents WHERE uStudents.id = $userID AND uStudents.id = uAccounts.id";
        $selSQ = $this->db->query($selStudent);

        try {
            $student = $selSQ->fetch_assoc();

            return [$student['fname'],$student['mname'],$student['lname']];
        } catch (e) {
            return ['N/A', 'N/A', 'N/A'];
        }
    }

    function getSchoolName($userID) {
        // Clean SQL Injection
        $userID = mysqli_real_escape_string($this->db, $userID);
        //

        $selSchool = "SELECT schoolName FROM etcSchools, uStudents WHERE uStudents.id = $userID AND uStudents.school = etcSchools.id";
        $selSQ = $this->db->query($selSchool);

        if ($selSQ->num_rows > 0) {
            $name = "N/A";
            while ($school = $selSQ->fetch_assoc()) {
                $name = $school['schoolName'];
            }
            return $name;
        }
    }
    //
}