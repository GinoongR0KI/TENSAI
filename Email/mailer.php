<?php

// Include phpmailer files
require('../functions/PHPMailer/PHPMailer.php');
require('../functions/PHPMailer/SMTP.php');
require('../functions/PHPMailer/Exception.php');
// Define namespaces
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

// PHPMailer
$mailer = new PHPMailer();

try {
    // Server Settings
    // $mailer->SMTPDebug = 2;
    $mailer->isSMTP();
    $mailer->Host = "smtp.gmail.com";
    $mailer->SMTPAuth = true;
    $mailer->Username = "tensaimailer@gmail.com";
    $mailer->Password = "qvnnhconnbvbxyfq";
    $mailer->SMTPSecure = 'ssl';
    $mailer->Port = 465;

    // Recepients
    $mailer->setFrom('tensaimailer@gmail.com', 'RINA');

    $mailer->addAddress('mail.roqueperez@gmail.com'); // This defines the receiver of the email.

    // Content
    $body = file_exists('confirmation.php') ? file_get_contents('confirmation.php') : "No file exists";

    $mailer->isHTML(true);
    $mailer->Subject = "Email Registration";
    $mailer->Body = $body;
    $mailer->AltBody = strip_tags($body);

    $mailer->send();
    echo "Message Has Been Sent";
} catch (Exception $e) {
    echo "Message could not be sent!";
    echo "Mailer Error: " . $mailer->ErrorInfo;
}