<?php // Some pre-processing could be put in here before this whole page loads.

    // Import some php scripts here
// 
    require_once("functions\dbConn.php");
    require_once("functions\login\loginAuthenticator.php");
    require_once("functions\security\\redirector.php");

    
    // Imported php scripts above...

    // Variables
    $error = null; // This will display errors from logging in.

    $redir = new redirector(); // This will help us keep unauthorized users out of a specific website or redirect them back to the index page.
    $logAuth = new loginAuthenticator($db); // This is to be used to login the system.

    
    //

    // Submission Processing
    if (isset($_POST['submitLogin'])) { // This is to check whether the form has been submitted.
        // Clean the inputs
        $email = mysqli_real_escape_string($db, $_POST['email']);
        $pw = mysqli_real_escape_string($db, $_POST['password']);
        //

        // Authenticate the inputs
        $logAuth->authenticate($email, $pw);
        //
        
    }
    //

    // Redirecting
    //$redir->logged();
    //

?>

<!DOCTYPE html>

<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        
        <!-- Bootstrap -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.5/dist/umd/popper.min.js" integrity="sha384-Xe+8cL9oJa6tN/veChSP7q+mnSPaj5Bcu9mPX5F5xIGE0DVittaqT5lorf0EI7Vk" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.min.js" integrity="sha384-ODmDIVzN+pFdexxHEHFBQH3/9/vQ9uori45z4JjnFsRydbmQbmL5t1tQ0culUzyK" crossorigin="anonymous"></script>
        <!-- Bootstrap -->

        <!-- Font Awesome 5 -->
        <script src="https://kit.fontawesome.com/8a969bbba5.js" crossorigin="anonymous"></script>
        <!-- Font Awesome 5 -->

        <!-- Javascript -->
        <script src="" defer></script> <!-- This should hold the login ajax js -->
        <!-- Javascript -->

        <title>Document</title>
    </head>

    <body>

        <form class="row" method="POST" action="">
            <div class="row">
                <label for="email" class="col-1">Email: </label>
                <input class="col-3" type="text" name="email" placeholder="Enter your email here" REQUIRED />
            </div>

            <div class="row">
                <label for="email" class="col-1">Password: </label>
                <input class="col-3" type="password" name="password" placeholder="Enter your password here" REQUIRED />
            </div>

            <div>
                <button class="col-2" type="submit" name="submitLogin"><i class="fa-solid fa-right-to-bracket"></i></button>
                <br><a class="col" href="forgotpassword.php">Forgot Password</a>
            </div>

        </form>

    </body>

</html>