<?php

if (session_status() === PHP_SESSION_NONE) {session_start();}

require_once("../functions/dbConn.php");
require_once("Classes/reportManager.php");

// Initialize
$manager = new reportManager($db);

$student = $manager->getStudentName($_GET['userID']);
$fname = $student[0];
$mname = $student[1];
$lname = $student[2];
$school = $manager->getSchoolName($_GET['userID']);

$overallAve = $manager->getPerformanceOverall($_GET['userID']);
$monthlyAve = $manager->getPerformanceMonthly($_GET['userID']);
$weeklyAve = $manager->getPerformanceWeekly($_GET['userID']);

$highestAssess = $manager->getHighestAssessment($_GET['userID']);
$lowestAssess = $manager->getLowestAssessment($_GET['userID']);

?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>School Report</title>

        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
        <link rel="stylesheet" href="../css/custom.min.css">
        <link rel="stylesheet" href="../css/style.css">

        <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script> <!-- This script is jsPDF library -->
        <script src="https://html2canvas.hertzen.com/dist/html2canvas.min.js"></script> <!-- HTML2Canvas library -->
        <script src="AJAX/reports.js"></script>
        <script src="../javascript/rower.js"></script>
        <script src="../javascript/toaster.js"></script>
        
    </head>
    <body>
        <!-- Toast -->
        <div aria-live="polite" aria-atomic="true" class="d-flex align-items-center">
            <div class="toast-container position-absolute" id="cont_toasts" style="position:fixed; bottom:1vh; right: 1vh">
                
            </div>
        </div>

        <!-- Toast -->

        <div class="container-fluid">
            <div class="row flex-nowrap">

            </div>

            <div class="col">
                <div id="cont_report">
                    <h1 class="row bg-palette3">Performance Report</h1>
                    <h3>Student Name: <?php echo "$fname $mname $lname"; ?></h3>
                    <h3>School Name: <?php echo $school; ?></h3>

                    <hr>

                    <div class="row" id="perf_overall">
                        <p><b>Overall Average:</b> <?php echo $overallAve[0] . "%"; ?></p>
                        <p>Times Taken: <?php echo $overallAve[1]; ?></p>
                    </div>

                    <div class="row">
                        <div class="col" id="perf_monthly">
                            <p><b>Monthly Performance:</b> <?php echo $monthlyAve[0] . "%"; ?></p>
                            <p>Times Taken: <?php echo $monthlyAve[1]; ?></p>
                        </div>

                        <div class="col" id="perf_weekly">
                            <p><b>Weekly Performance:</b> <?php echo $weeklyAve[0] . "%"; ?></p>
                            <p>Times Taken: <?php echo $weeklyAve[1]; ?></p>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col">
                            <p><b>Highest Assessment Performance:</b> <?php echo $highestAssess[0]; ?></p>
                            <p>Assessment Title: <?php echo $highestAssess[1]; ?></p>
                            <p>Part of: <?php echo $highestAssess[2]; ?></p>
                        </div>
                        <div class="col">
                            <p><b>Lowest Assessment Performance:</b> <?php echo $lowestAssess[0]; ?></p>
                            <p>Assessment Title: <?php echo $lowestAssess[1]; ?></p>
                            <p>Part of: <?php echo $lowestAssess[2]; ?></p>
                        </div>
                    </div>

                    <table class="table table-hover mt-4">
                        <thead>
                            <th>#</th>
                            <th>Assessment</th>
                            <th>Score</th>
                            <th>Items</th>
                            <th>Date Taken</th>
                            <th>Status</th>
                        </thead>
                        <tbody id="cont_scores">
                            <tr>
                                <td>1</td>
                                <td>Test</td>
                                <td>10</td>
                                <td>20</td>
                                <td>11-07-2022 9:41pm</td>
                                <td>Passed</td>
                            </tr>

                            <tr>
                                <td>1</td>
                                <td>Test</td>
                                <td>10</td>
                                <td>20</td>
                                <td>11-07-2022 9:41pm</td>
                                <td>Passed</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <hr>

        Save Current Report: <button onClick="downloadReport()">Download</button>
        <p>You may close this tab once done viewing.</p>
        <script>getReports();</script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous"></script>

    </body>
</html>