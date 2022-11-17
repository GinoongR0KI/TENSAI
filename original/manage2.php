<!DOCTYPE html>
<html lang="en">
<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">    <meta charset="UTF-8">
    <link rel="stylesheet" href="../css/custom.min.css">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TENSAI - Account</title>
    <script>
        const myModal = document.getElementById('myModal')
        const myInput = document.getElementById('myInput')

        myModal.addEventListener('shown.bs.modal', () => {
        myInput.focus()
})
    </script>
</head>
<body>
    <div class="container-fluid">
        <div class="row">
            <!--Navigation-->
            <div class="col-2 bs-background">
                <ul class="nav nav-pills flex-column vh-100">
                    <li class="nav-item mt-4 mb-4">
                        <a class="nav-link" href="../dashboard.php"><i class="bi bi-house-fill"></i>Dashboard</a>
                    </li>
                    <li class="nav-item mb-4">
                        <a class="nav-link active" aria-current="page" href="manage.php"><i class="bi bi-person-lines-fill"></i>Account Management</a>
                    </li>
                    <li class="nav-item mb-4">
                        <a class="nav-link" href="lesson.php"><i class="bi bi-journal-text"></i>Lesson Management</a>
                    </li>
                    <li class="nav-item mb-4">
                        <a class="nav-link" href="assessment.php"><i class="bi bi-ui-checks"></i>Assessment Management</a>
                    </li>
                    <li class="nav-item mb-4">
                        <a class="nav-link" href="report.php"><i class="bi bi-bar-chart-line"></i>Report Generation</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="login.php"><i class="bi bi-box-arrow-left"></i>Logout</a>
                    </li>
                </ul>
            </div>

            <!--Main Container-->
            <div class="col">
                <h2 class="mt-5 mb-5">ACCOUNTS</h2>
                <div class="row mt-4 mb-4">

                    <!--Search-->
                    <div class="col">
                        <div class="hstack gap-3">
                            <input class="form-control me-auto" type="text" placeholder="Search . . ." aria-label="Search . . .">
                                <button type="button" class="btn btn-btncolor"><i class="bi bi-search"></i></button>
                        </div>
                    </div>

                    <!--Sort-->
                    <div class="col">
                        <div class="dropdown">
                            <button class="btn btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                Sort
                            </button>
                        </div>
                    </div>

                    <!--Upload-->
                    <div class="col">
                        <button type="button" class="btn btn-outline-primary">Upload</button>
                    </div>
                </div>
                <div class="row">

                    <!--Overlay Adding Section-->
                    <div class="col">
                        <button type="button" class="btn btn-outline-primary" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
                            Add Section
                        </button>
                    </div>
                </div>

                <!--Tables-->
                <table class="table table-hover mt-4">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Section Name</th>
                            <th scope="col"># of Pupils</th>
                            <th scope="col">Assigned Teacher</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!--Added section will appear here-->
                        <!--Sample Data-->
                        <tr>
                            <td>1</td>
                            <td>Nijigasaki</td>
                            <td>13</td>
                            <td>Kaoruko Mifune</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

                    <!--MODALS//OVERLAY-->
    
<!--Overlay Form //Section Adding-->
<!---->
<div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Add Section</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <input class="form-control mb-3" type="text" placeholder="School" aria-label="School" disabled> <!-- Section's School ID -->
                <div class="form-floating">
                    <input type="text" class="form-control mb-3" id="floatingInput" placeholder="Section Name"> <!-- This is where you type the section's name -->
                    <label for="floatingInput">Section Name</label>
                </div>
                <div class="form-floating mb-3">
                    <select class="form-select" id="floatingSelect" aria-label="Teacher"> <!-- This is where they will choose who will become the Advisor of the section -->
                    <option selected>Select a Teacher</option>
                    <option value="1">Yuu Takasaki</option> <!-- values of these options should be the name of the teachers themselves, maybe comes with their ids -->
                    <option value="2">Chisato Nishikagi</option>
                    <option value="3">Kaoruko Mifune</option>
                    </select>
                    <label for="floatingSelect">Teacher</label>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn" data-bs-dismiss="modal">CANCEL</button>
                <button type="button" class="btn btn-btncolor">CREATE</button>
            </div>
        </div>
        </div>
    </div>

<!--Overlay Form //Teacher Adding-->
<!--
<div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Add Teacher</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <input class="form-control mb-3" type="text" placeholder="School" aria-label="School" disabled>
                <div class="form-floating">
                    <input type="text" class="form-control mb-3" id="floatingInput" placeholder="Email">
                    <label for="floatingInput">Email</label>
                </div>
                <div class="form-floating mb-3">
                    <select class="form-select" id="floatingSelect" aria-label="User Type">
                    <option selected>Select Type</option>
                    <option value="1">Principal</option>
                    <option value="2">Teacher</option>
                    <option value="3">Student</option>
                    </select>
                    <label for="floatingSelect">User Type</label>
                </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn" data-bs-dismiss="modal">CANCEL</button>
                <button type="button" class="btn btn-btncolor">CREATE</button>
            </div>
        </div>
        </div>
    </div>
    -->

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous"></script>
</body>
</html>