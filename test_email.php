<?php
require 'send_email.php';

// Replace with test values
$to = 'recipient_email@example.com';
$subject = 'Test Email';
$body = '<p>This is a test email!</p>';

sendEmail($to, $subject, $body);
?>
