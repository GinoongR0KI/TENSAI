<?php

// Include phpmailer files
require('../../functions/phpmailer/PHPMailer.php');
require('../../functions/phpmailer/SMTP.php');
require('../../functions/phpmailer/Exception.php');

// Define namespaces
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

class tensaimailer {

    // Class Variables
    private $headers;
    //

    // Built-in Functions
    function __construct() {

    }
    //

    // Custom Functions

    function send($to, $subject, $content) {
        $mailer = new PHPMailer();

        try {
            // Server Settings
            $mailer->SMTPDebug = 2;
            $mailer->isSMTP();
            $mailer->Host = "smtp.gmail.com";
            $mailer->SMTPAuth = true;
            $mailer->Username = "tensaimailer@gmail.com";
            $mailer->Password = "eygikfeszzfwgfxq";
            $mailer->SMTPSecure = 'ssl';
            $mailer->Port = 465;
        
            // Recepients
            $mailer->setFrom('tensaimailer@gmail.com', 'RINA');
        
            $mailer->addAddress($to); // This defines the receiver of the email.
        
            // Content
            $mailer->isHTML(true);
            $mailer->Subject = $subject;
            $mailer->Body = $content;
            $mailer->AltBody = strip_tags($content);
        
            $mailer->send();
            return "Message Has Been Sent";
        } catch (Exception $e) {
            return "Mailer Error: " . $mailer->ErrorInfo;
        }
    }

    function setNormal() {
        $this->headers = "From: tensaimailer@gmail.com";

        return $this->headers;
    }

    function setHTML() {
        $this->headers = "From: tensaimailer@gmail.com \r\n";
        $this->headers .= "MIME-Version: 1.0 \r\n";
        $this->headers .= "Content-type:text/html;charset=UTF-8 \r\n";

        return $this->headers;
    }

    //

}

?>