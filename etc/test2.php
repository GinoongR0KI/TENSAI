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
        
        <!-- Test -->
        <?php
            // Write on the file to set School ID / School Name
            $upload_folder = "files/";
            $filename = $_FILES['file']['name'];
            $uploaded_file = $upload_folder . basename($filename);

            if (file_exists($uploaded_file)) {
                echo 'The file already exist.<br/>';
            }

            if (move_uploaded_file($filename, $uploaded_file)) {
                echo 'File has been succesfully uploaded.<br/>';
            } else {
                echo 'Error in uploading file!<br/>';
            }
            
            $file = fopen($uploaded_file, "a") or die ("Unable to Open File!");
            $data = $_POST['schoolID'] . "\n";
            fwrite($file, $data);
            fclose($file);

            header("Location: test3.php");

        ?>

    </body>
</html>