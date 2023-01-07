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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
    <link rel="stylesheet" href="../css/style.min.css">

    <link rel="manifest" href="../manifest.json">
    
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TENSAI | StudName Report</title>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script> <!-- This script is jsPDF library -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js" integrity="sha512-BNaRQnYJYiPSqHHDb58B0yaPfCu+Wgds8Gp/gU33kqBtgNS4tSPHuGibyoeqMV/TJlSKda6FXzoEyYGjTe+vXA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script> <!-- HTML2Canvas library -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/dompurify/2.4.1/purify.min.js" integrity="sha512-uHOKtSfJWScGmyyFr2O2+efpDx2nhwHU2v7MVeptzZoiC7bdF6Ny/CmZhN2AwIK1oCFiVQQ5DA/L9FSzyPNu6Q==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <script src="AJAX/reports.js"></script>
    <script src="../javascript/rower.js"></script>
    <script src="../javascript/toaster.js"></script>
</head>
<body>
    <!-- Toast -->
    <div aria-live="polite" aria-atomic="true" class="d-flex align-items-center">
        <div class="toast-container position-fixed" id="cont_toasts" style="bottom:1vh; right: 1vh; z-index:99">
            
        </div>
    </div>

    <!-- Toast -->

    <input type="hidden" value="<?php echo $lowestAssess[0] . ", " . $lowestAssess[1] . ", " . $lowestAssess[2] . ", " . $lowestAssess[3]; ?>">

    <div class="row">
        <div class="col">
            <div class="report-header m-4">
                <div class="d-flex flex-row position-relative shadow-sm p-3 mb-3 bg-body rounded">
                    <div class="report-title">
                        <h5>Performance Report</h5>
                    </div>
                    <div class="report-print position-absolute end-0 me-3 d-flex flex-row">
                    <!-- <button type="button" class="btn btn btn-button me-3"><a href="reports.php"><i class="bi bi-arrow-return-left"></i></a></button> -->
                    <b>Note:&nbsp;</b>You may close this tab after you're done viewing the report.&nbsp;
                    <button type="button" class="btn btn btn-button" onClick="downloadReport('<?php echo $fname . $lname; ?>')"><i class="bi bi-download"></i></button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="container-fluid" id="cont_report">

        <div class="row">
            <div class="col m-3">
                <h3><?php echo $fname . " " . $mname . " " . $lname; ?></h3>
                <h5>STUDENT ID: <?php echo $_GET['userID']; ?></h5>
            </div>
        </div>

        <div class="row">
            <div class="col">
                <div class="report-header m-4">
                    <div class="d-flex flex-row position-relative shadow-sm p-3 mb-3 bg-body rounded">
                        <div class="report-title">
                            <h5>Report Summary</h5>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col m-4">
                <div class="list-group">
                    <div class="list-group-item list-group-item-action">
                        <div class="d-flex w-100 justify-content-between">
                            <h5 class="mb-1">Overall Average</h5>
                            <span class="badge bg-secondary rounded-pill"><h6><?php echo $overallAve[0] . "%"; ?></h6></span>
                        </div>
                        <p class="mb-1">Total number of records: <?php echo $overallAve[1]; ?></p>
                    </div>
                </div>

                <div class="list-group list-group-horizontal">
                    <div class="list-group-item list-group-item-action">
                        <div class="d-flex w-100 justify-content-between">
                            <h5 class="mb-1">Monthly Performance</h5>
                            <span class="badge bg-secondary rounded-pill"><h6><?php echo $monthlyAve[0] == "Not Enough Data" ? $monthlyAve[0] : $monthlyAve[0] . "%"; ?></h6></span>
                        </div>
                        <p class="mb-1">Times taken: <?php echo $monthlyAve[1]; ?></p>
                    </div>  

                    <div class="list-group-item list-group-item-action">
                        <div class="d-flex w-100 justify-content-between">
                            <h5 class="mb-1">Weekly Performance</h5>
                            <span class="badge bg-secondary rounded-pill"><h6><?php echo $weeklyAve[0] == "Not Enough Data" ? $weeklyAve[0] : $weeklyAve[0] . "%"; ?></h6></span>
                        </div>
                        <p class="mb-1">Times taken: <?php echo $weeklyAve[1]; ?></p>
                    </div>  
                </div>

                
                <div class="list-group list-group-horizontal">
                    <div class="list-group-item list-group-item-action">
                        <div class="d-flex w-100 justify-content-between">
                            <h5 class="mb-1">Highest Assessment Performance</h5>
                            <span class="badge bg-secondary rounded-pill"><h6><?php echo $highestAssess[0] != "N/A" ? $highestAssess[0] . "%" : $highestAssess[0]; ?></h6></span>
                        </div>
                        <p class="mb-1">Lesson Name: <?php echo $highestAssess[2]; ?></p>
                        <p class="mb-1">Assessment Title: <?php echo $highestAssess[1]; ?></p>
                        <p class="mb-1">Date Taken: <?php echo $highestAssess[3]; ?></p>
                    </div>  

                    <div class="list-group-item list-group-item-action">
                        <div class="d-flex w-100 justify-content-between">
                            <h5 class="mb-1">Lowest Assessment Performance</h5>
                            <span class="badge bg-secondary rounded-pill"><h6><?php echo $lowestAssess[0] != "N/A" ? $lowestAssess[0] . "%" : $lowestAssess[0]; ?></h6></span>
                        </div>
                        <p class="mb-1">Lesson Name: <?php echo $lowestAssess[2]; ?></p>
                        <p class="mb-1">Assessment Title: <?php echo $lowestAssess[1]; ?></p>
                        <p class="mb-1">Date Taken: <?php echo $lowestAssess[3]; ?></p>
                    </div>  
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col">
                <div class="report-header m-4">
                    <div class="d-flex flex-row position-relative shadow-sm p-3 mb-3 bg-body rounded">
                        <div class="report-title">
                            <h5>Records</h5>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="table-container shadow-sm p-3 mb-5 bg-body rounded">
            <table class="table table-hover table-responsive-sm">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Assessment</th>
                        <th>Score</th>
                        <th>No. of Items</th>
                        <th>Date Taken</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody id="cont_scores">
                    <!--Sample Data-->
                    <tr>
                        <td>1</td>
                        <td>Assessment</td>
                        <td>10</td>
                        <td>0</td>
                        <td>2022-12-05</td>
                        <td>Failed</td>
                    </tr>
                </tbody>
            </table>
        </div>

    </div>
     <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-u1OknCvxWvY5kfmNBILK2hRnQC3Pr17a+RTT6rIHI7NnikvbZlHgTPOOmMi466C8" crossorigin="anonymous"></script>
     <script>getReports();</script>
</body>
</html>