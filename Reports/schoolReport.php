<?php
include_once("../functions/dbConn.php");
include_once("Classes/reportManager.php");

if (session_status() === PHP_SESSION_NONE) {session_start();}

$manager = new reportManager($db);

if (!isset($_SESSION['schoolID'])) {
    echo "<h1>You have no set School, yet.</h1>";
    echo "<a href='manage.php'>Go Back</a>";
    exit;
}
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
        
    </head>
    <body>

        <div class="container-fluid">
            <div class="row flex-nowrap">

            </div>

            <div class="col">
                <div id="cont_report">
                    <h1>School Report</h1>
                    <h3>School Name: <i id="txt_schoolName"><?php echo $_GET['schoolID']; ?></i></h3>

                    <p>Overall Average:</p>

                    <p>Monthly Performance</p>
                    <p>Weekly Performance</p>
                </div>
            </div>
        </div>

        

        <button onClick="downloadReport()">Download</button>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous"></script>

    </body>
</html>