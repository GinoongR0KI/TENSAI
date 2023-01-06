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
        if ($result = $logauth->authenticate($email, $pw)) {
            $error = $result;
        }
        //
    }
    //

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
    <link rel="stylesheet" href="css/style.min.css">
    <link rel="stylesheet" href="css/style.css">

    <link rel="manifest" href="../manifest.json">

    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TENSAI | Login</title>

    <script src="javascript/toaster.js"></script>
</head>
<body style="background-image: url('src/s1.png');">
    <!-- Toast -->
    <div aria-live="polite" aria-atomic="true" class="d-flex align-items-center">
        <div class="toast-container position-absolute" id="cont_toasts" style="position:fixed; bottom:1vh; right: 1vh">
            
        </div>
    </div>

    <!-- Toast -->

    <div class="container-fluid d-flex justify-content-center align-items-center">

        <!--Off canvas login-->
        <div class="offcanvas offcanvas-start" tab-index="-1" id="LogIn" aria-labelledby="LogIn">
            <div class="offcanvas-header">
                <h5 class="offcanvas-title">LOG IN TO TENSAI</h5>
                <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
            </div>
            <div class="offcanvas-body">
                <form method="POST">
                    <input class="form-control mb-3" name="email" type="text" placeholder="Email" aria-label="email"/>
                    <input class="form-control mb-3" name="password" type="password" placeholder="Password" aria-label="password"/>
                    <button name="submitLogin" type="submit" class="btn btn-button">LOGIN</a>
                </form>
            </div>
        </div>

        <!--Animated Background-->
        <div class="tensai-head d-flex justify-content-center align-items-center">
            <div class="color-overlay">
                <div class="tensai-text">
                    <h1>WELCOME TO <b>TENSAI</b></h1>
                    <!-- <h3>Technology-assisted Education via Networked-learning with Speech and Auditory Interplay</h3> -->
                    <a href="#" class="btn btn-outline-palette1 btn-lg d-flex justify-content-center align-items-center" data-bs-toggle="offcanvas" data-bs-target="#LogIn">GO TO TENSAI</a>
                    <a href="about.php" class="btn btn-outline-palette1 btn-lg d-flex justify-content-center align-items-center">ABOUT PAGE</a>
                </div>
            </div>
        </div>
    </div>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous"></script>
    <script>
        var error = "<?php if (isset($error)) {echo $error;} ?>";
        if (error != null && error != "") {
            generateToast("logError", "Notification", "Login", error);
        }
    </script>
</body>
</html>