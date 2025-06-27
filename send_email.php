<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// Updated paths based on your folder structure
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';
require 'PHPMailer/src/Exception.php';

function sendEmail($to, $subject, $body) {
    $mail = new PHPMailer(true);
    try {
        $mail->isSMTP();
        $mail->Host       = 'smtp.gmail.com';
        $mail->SMTPAuth   = true;
        $mail->Username   = 'kanojiyanitin870@gmail.com';     // YOUR Gmail
        $mail->Password   = 'xuajrugsvpwusugm';        // YOUR App Password
        $mail->SMTPSecure = 'tls';
        $mail->Port       = 587;

        $mail->setFrom('kanojiyanitin870@gmail.com', 'Time Capsule'); // FROM name
        $mail->addAddress($to); // TO email

        $mail->isHTML(true);
        $mail->Subject = $subject;
        $mail->Body    = $body;

        $mail->send();
        echo "Email sent successfully.";
    } catch (Exception $e) {
        echo "Email failed to send. Error: {$mail->ErrorInfo}";
    }
}
?>
