<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php
    require_once("Email/tensaimailer.php");

    $mailer = new tensaimailer();
    // Send an email with the information
    $content = file_get_contents("../../email/confirmation.php"); // Get the email page from file
    $content = sprintf($content, "japan.roqueperez@gmail.com", "japan.roqueperez@gmail.com", "Admin", "Null"); // Fill up the special characters from the email with variable values.
    $mailStatus = $mailer->send("japan.roqueperez@gmail.com", "TENSAI Account Activation", $content);
    ?>
    
</body>
</html>