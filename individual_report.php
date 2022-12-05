<!DOCTYPE html>
<html lang="en">
<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
    <link rel="stylesheet" href="css/style.min.css">
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TENSAI | StudName Report</title>
</head>
<body>
    <div class="container-fluid">

    <div class="row">
            <div class="col">
                <div class="report-header m-4">
                    <div class="d-flex flex-row position-relative shadow-sm p-3 mb-3 bg-body rounded">
                        <div class="report-title">
                            <h5>Performance Report</h5>
                        </div>
                        <div class="report-print position-absolute end-0 me-3 d-flex flex-row">
                        <button type="button" class="btn btn btn-button me-3"><a href="reports.php"><i class="bi bi-arrow-return-left"></i></a></button>
                        <button type="button" class="btn btn btn-button"><i class="bi bi-printer"></i></button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col m-3">
                <h3>[Student Name]</h3>
                <h5>[Student ID]</h5>
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
                            <span class="badge btn-palette3 rounded-pill"><h6>100%</h6></span>
                        </div>
                        <p class="mb-1">Some placeholder content in a paragraph.</p>
                    </div>
                </div>

                <div class="list-group list-group-horizontal">
                    <div class="list-group-item list-group-item-action">
                        <div class="d-flex w-100 justify-content-between">
                            <h5 class="mb-1">Monthly Performance</h5>
                            <span class="badge bg-palette3 rounded-pill"><h6>100%</h6></span>
                        </div>
                        <p class="mb-1">Times taken:</p>
                    </div>  

                    <div class="list-group-item list-group-item-action">
                        <div class="d-flex w-100 justify-content-between">
                            <h5 class="mb-1">Weekly Performance</h5>
                            <span class="badge bg-palette3 rounded-pill"><h6>100%</h6></span>
                        </div>
                        <p class="mb-1">Times taken:</p>
                    </div>  
                </div>

                
                <div class="list-group list-group-horizontal">
                    <div class="list-group-item list-group-item-action">
                        <div class="d-flex w-100 justify-content-between">
                            <h5 class="mb-1">Highest Assessment Performance</h5>
                            <span class="badge bg-palette3 rounded-pill"><h6>100%</h6></span>
                        </div>
                        <p class="mb-1">Lesson Name: </p>
                        <p class="mb-1">Assessment Title: </p>
                    </div>  

                    <div class="list-group-item list-group-item-action">
                        <div class="d-flex w-100 justify-content-between">
                            <h5 class="mb-1">Lowest Assessment Performance</h5>
                            <span class="badge bg-palette3 rounded-pill"><h6>100%</h6></span>
                        </div>
                        <p class="mb-1">Lesson Name: </p>
                        <p class="mb-1">Assessment Title: </p>
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
                        <th scope="col">#</th>
                        <th scope="col">Assessment Title</th>
                        <th scope="col">No. of Items</th>
                        <th scope="col">Score</th>
                        <th scope="col">Date Taken</th>
                        <th scope="col">Status</th>
                    </tr>
                </thead>
                <tbody>
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
</body>
</html>