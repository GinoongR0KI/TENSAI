<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Document</title>
    </head>

    <body>
        
        <a href="test.php">Go back to Account Applications</a>

        <br/><br/><br/>

        <h2>List of Schools Registered in the system:</h2>

        <ul>
            <!-- Test -->
            <?php
                // Read files and display emails
                $file = fopen("files/Test.txt", "r") or die ("Unable to open file!");
                while (!feof($file)) {
                    echo "<li>" . fgets($file) . "</li>";
                }
                fclose($file);
            ?>
        </ul>

    </body>
</html>