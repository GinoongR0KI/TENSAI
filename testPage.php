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
    
    $content = file_get_contents("Email/confirmation.php");
    $content = sprintf($content, "japan.roqueperez@gmail.com", "japan.roqueperez@gmail.com", "Admin", "Null");
    $mailStatus = $mailer->send("japan.roqueperez@gmail.com", "TENSAI Account Activation", $content);
    ?>
    
</body>
</html>