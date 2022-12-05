<!DOCTYPE html>
<html lang="en">
<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">
    <link rel="stylesheet" href="css/style.min.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TENSAI | Generate Report</title>
</head>
<body>
<div class="container-fluid">
        <div class="row flex-nowrap">
            <!--Navigation-->
            <div class="col-auto col-md-3 col-xl-2 px-sm-2 px-0 min-vw-20">
                <div class="d-flex flex-column align-items-center align-items-sm-start px-3 pt-2 m-3 rounded-2 min-vh-95" style="background-color: #4C3575;">
                    <ul class="nav nav-pills flex-column mb-sm-auto mb-0 align-items-center align-items-sm-start">
                        <!--Links-->
                        <li class="nav-item m-2">
                            <a class="nav-link" href="dashboard.php">Dashboard</a>
                        </li>
                        <li class="nav-item m-2">
                            <a class="nav-link" href="accounts.php">Accounts</a>
                        </li>
                        <li class="nav-item m-2">
                            <a class="nav-link" href="schools.php">School Management</a>
                        </li>
                        <li class="nav-item m-2">
                            <a class="nav-link" href="section.php">Section Management</a>
                        </li>
                        <li class="nav-item m-2">
                            <a class="nav-link" href="lessons.php">Lessons Management</a>
                        </li>
                        <li class="nav-item m-2">
                            <a class="nav-link" href="assessments.php">Assessment Management</a>
                        </li>
                        <li class="nav-item m-2">
                            <a class="nav-link active" href="reports.php">Generate Report</a>
                        </li>
                        <li class="nav-item m-2">
                            <a class="nav-link" href="login.php">Logout</a>
                        </li>
                    </ul>
                </div>
            </div>

            <!--Account Container-->
            <div class="col mt-5">
                <div class="row">
                    <div class="col mb-2">
                        <h3>Reports - [Section Name]</h3>
                    </div>
                </div>

                <div class="row mb-4 mt-4 me-5">
                    <div class="account-table d-flex flex-row position-relative shadow-sm p-3 mb-3 bg-body rounded">
                    <!--Search-->
                        <div class="col-5">
                            <div class="input-group mb-3 d-flex">
                                <input type="text" class="form-control" placeholder="Search . . ." aria-label="Search . . ." aria-describedby="searchBTN">
                                    <button class="btn btn-button" type="button" id="searchBTN">Search</button>
                            </div>
                        </div>
                        <div class="account-button position-absolute end-0 d-flex flex-row">
                            <div class="col-auto me-4">

                            <!--Sort-->
                                <div class="dropdown">
                                    <button class="btn btn-button dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                        Sort
                                    </button>
                                    <ul class="dropdown-menu p-2">
                                        <li>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" value="" id="flexCheckChecked" checked>
                                                    <label class="form-check-label" for="flexCheckChecked">
                                                    School
                                                    </label>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" value="" id="flexCheckChecked" checked>
                                                    <label class="form-check-label" for="flexCheckChecked">
                                                    Principal
                                                    </label>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" value="" id="flexCheckChecked" checked>
                                                    <label class="form-check-label" for="flexCheckChecked">
                                                    Teacher
                                                    </label>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" value="" id="flexCheckChecked" checked>
                                                    <label class="form-check-label" for="flexCheckChecked">
                                                    Student
                                                    </label>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="table-container shadow-sm p-3 mb-5 bg-body rounded">
                        <table class="table table-hover table-responsive-sm">
                            <thead>
                                <tr>
                                    <th scope="col">Student ID</th>
                                    <th scope="col">Last Name</th>
                                    <th scope="col">First Name</th>
                                    <th scope="col">Date Updated</th>
                                    <th scope="col gap-3">Let there be action buttons</th>
                                </tr>
                            </thead>
                            <tbody>
                                <!--Sample Data-->
                                <tr>
                                    <td>2022-001</td>
                                    <td>Takasaki</td>
                                    <td>Yuu</td>
                                    <td></td>
                                    <td>
                                        <div class="hover-button">
                                            <button type="button" class="btn btn-sm btn-button"><a href="individual_report.php"><i class="bi bi-eye"></i></a></button>                                        </div>
                                    </td>
                                </tr>
                                
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-u1OknCvxWvY5kfmNBILK2hRnQC3Pr17a+RTT6rIHI7NnikvbZlHgTPOOmMi466C8" crossorigin="anonymous"></script>
</body>
</html>