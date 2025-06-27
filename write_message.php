<?php
session_start();
require 'db.php';
require 'send_email.php';

if (!isset($_SESSION['user_id'])) {
    header('Location: index.php');
    exit;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $content = $_POST['content'];
    $date = $_POST['reveal_date'];
    $user_id = $_SESSION['user_id'];

    // Insert the message into the database
    $stmt = $pdo->prepare("INSERT INTO messages (user_id, content, reveal_date, sent) VALUES (?, ?, ?, 0)");
    $stmt->execute([$user_id, $content, $date]);

    // Get the user's email to send the confirmation
    $stmtUser = $pdo->prepare("SELECT email, name FROM users WHERE id = ?");
    $stmtUser->execute([$user_id]);
    $user = $stmtUser->fetch();

    // Check if the reveal date is today
    $today = date('Y-m-d');
    if ($date == $today) {
        // Send the email immediately if the reveal date is today
        sendEmail($user['email'], 'Your Time Capsule Message', "Hi {$user['name']}, your message is saved and will be revealed today.");
        
        // Mark the message as sent (sent = 1)
        $update_sql = "UPDATE messages SET sent = 1 WHERE content = ?";
        $update_stmt = $pdo->prepare($update_sql);
        $update_stmt->execute([$content]);

        echo "Your message is revealed today, and an email has been sent!";
    } else {
        // If the reveal date is not today, send an email with the future reveal date
        sendEmail($user['email'], 'New Message Created', "Hi {$user['name']}, your message is saved and will be revealed on $date.");
        echo "Your message is saved and will be revealed on $date. An email confirmation has been sent.";
    }

    header('Location: dashboard.php');
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Write Time-Locked Message</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<form method="POST">
    <h2>Write Time-Locked Message</h2>
    Message: <textarea name="content" required></textarea><br>
    Reveal Date: <input type="date" name="reveal_date" required min="<?= date('Y-m-d') ?>"><br>
    <button type="submit">Save</button>
</form>
</body>
</html>
