<?php
require 'db.php'; // Database connection
require 'send_email.php'; // Email sending function

// Debug: Show today's date
echo "Today is: " . date('Y-m-d');  // This will show today's date for debugging

// Use $today variable to get today's date
$today = date('Y-m-d');

// Fetch messages to send
$sql = "SELECT m.*, u.email, u.name 
        FROM messages m 
        JOIN users u ON m.user_id = u.id 
        WHERE m.reveal_date <= ? AND m.sent = 0";  // Use ? to bind $today

$stmt = $pdo->prepare($sql);
$stmt->execute([$today]);  // Bind $today to the query
$messages = $stmt->fetchAll();

if (count($messages) > 0) {
    foreach ($messages as $msg) {
        // Send email
        sendEmail($msg['email'], 'Your Time Capsule Message!', nl2br($msg['message']));

        // Mark the message as sent (sent = 1)
        $update_sql = "UPDATE messages SET sent = 1 WHERE id = ?";
        $update_stmt = $pdo->prepare($update_sql);
        $update_stmt->execute([$msg['id']]);
    }
    echo "Emails sent successfully!";
} else {
    echo "No messages to send today.";
}
?>
