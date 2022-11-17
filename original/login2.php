<?php

    // Import PHP scripts here
    require_once("functions/dbConn.php"); // db connection
    require_once("functions/login/loginAuthenticator.php"); // Login authenticator script
    require_once("functions/security/redirector.php"); // used for creating sessions
    //

    // Variables
    $error = null; // This will display all errors found in this login form.
    
    $redir = new redirector();
    $logauth = new loginAuthenticator($db);
    //

    // Redirecting
    if (isset($_SESSION['isLoggedTENSAI'])) {
        if ($_SESSION['uType'] != "Student") {
            $redir->logged("dashboard.php");
        } else {
            $redir->logged("student.php");
        }
        
    }
    

    //

    // Submission Processing
    if (isset($_POST['submitLogin'])) {
        // Clean Inputs
        $email = mysqli_real_escape_string($db, $_POST['email']);
        $pw = mysqli_real_escape_string($db, $_POST['password']);
        //

        // Process
        $logauth->authenticate($email, $pw);
        //
    }
    //

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
    <link rel="stylesheet" href="css/custom.min.css">
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TENSAI - Login</title>
</head>
<body>
    <div class="container-fluid">

    <!--Off canvas login-->
        <div class="offcanvas offcanvas-start" tab-index="-1" id="offcanvasExample" aria-labelledby="offcanvasExampleLabel">
            <div class="offcanvas-header">
                <h5 class="offcanvas-title">LOG IN TO TENSAI</h5>
                <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
            </div>
            <div class="offcanvas-body">
                <form action="" method="POST">
                    <input class="form-control" name="email" type="text" placeholder="Email" aria-label="email"/>
                    <input class="form-control" name="password" type="password" placeholder="Password" aria-label="password"/>

                    <button name="submitLogin" type="submit" class="btn btn-palette2">
                        <a href="">LOG IN</a><!--//TEST href to dashboard.php-->
                    </button>
                </form>
            </div>
        </div>



        <div class="row">
            <div class="col">
                Container
                <button class="btn btn-palette2" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasExample" aria-controls="offcanvasExample">
                    GO TO TENSAI
                </button>
            </div>
            
        </div>
    </div>


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous"></script>
</body>
</html>