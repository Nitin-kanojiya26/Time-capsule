<!DOCTYPE html>
<html>
<head>
    <title>Register</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<?php
session_start();
require 'db.php';

if (!isset($_SESSION['user_id'])) {
    header('Location: index.php');
    exit;
}

$user_id = $_SESSION['user_id'];

$stmt = $pdo->prepare("SELECT * FROM messages WHERE user_id = ?");
$stmt->execute([$user_id]);
$messages = $stmt->fetchAll();
?>

<h2>Welcome! <a href="write_message.php">Write Message</a> | <a href="logout.php">Logout</a></h2>

<h3>Your Messages:</h3>
<ul>
<?php foreach ($messages as $msg): ?>
    <li>
        <?php if (date('Y-m-d') >= $msg['reveal_date']): ?>
            <?= htmlspecialchars($msg['content']) ?> (Revealed)
        <?php else: ?>
            🔒 Locked until <?= $msg['reveal_date'] ?>
        <?php endif; ?>
    </li>
<?php endforeach; ?>
</ul>
