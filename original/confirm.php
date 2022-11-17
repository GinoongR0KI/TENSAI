<?php // Some pre-processing could be put in here before this whole page loads.

    // Import some php scripts here
// 
    require_once("../../functions/dbConn.php");
    require_once("../../functions/security/redirector.php");

    $now = date_create(date("Y/m/d H:i:s", time()));
    $yesterday = date_sub($now, date_interval_create_from_date_string("1 days"));
    echo date_format($yesterday, "Y/m/d H:i:s");

    
    // Imported php scripts above...

    // Variables

    $redir = new redirector(); // This will help us keep unauthorized users out of a specific website or redirect them back to the index page.

    
    //

    // Submission Processing
    if (isset($_POST['upload'])) {
        //../../tester.php
        $files = $_FILES['inImage']['name'];
        $tempName = $_FILES['inImage']['tmp_name'];

        echo $files;
        echo "<br/>";
        echo $tempName;
        echo "<img src='$tempName' />";
    }
    //

    // Redirecting
    //$redir->out();
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

        <form method="POST" action="" enctype="multipart/form-data">
            <label for="inPass">Password: </label>
            <input name="inPass" id="inPass" type="text" placeholder="Password" />
            <label for="inPassConf">Confirm Password: </label>
            <input name="inPassConf" id="inPassConf" type="text" placeholder="Confirm Password" />

            <br />

            <div class="form-group">
                <label for="inImage">Profile Picture:</label>
                <input name="inImage" id="inImage" class="form-control" type="file" />
            </div>

            <br />

            <label for="">First Name:</label>
            <input type="text" />
            <label for="">Middle Name:</label>
            <input type="text" />
            <label for="">Last Name:</label>
            <input type="text" />

            <br />

            <button type="submit" name="upload">Save Information & Confirm Account</button>
        </form>

    </body>

</html>