<!DOCTYPE html>
<html>
<head>
    <title>Register</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<?php
require 'db.php';
require 'send_email.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $pass = password_hash($_POST['password'], PASSWORD_DEFAULT);

    $stmt = $pdo->prepare("INSERT INTO users (name, email, password) VALUES (?, ?, ?)");
    
    try {
        $stmt->execute([$name, $email, $pass]);

        // send welcome email
        sendEmail($email, 'Welcome to Time Capsule', "Hi $name! Thanks for joining.");

        header('Location: index.php');
        exit;
    } catch (PDOException $e) {
        echo "Error: Email already exists.";
    }
}
?>

<form method="POST">
    <h2>Register</h2>
    Name: <input type="text" name="name" required><br>
    Email: <input type="email" name="email" required><br>
    Password: <input type="password" name="password" required><br>
    <button type="submit">Register</button>
</form>
