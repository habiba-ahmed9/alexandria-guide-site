<?php
require_once 'config.php';

$name = $_POST['name'] ?? '';
$email = $_POST['email'] ?? '';
$subject = $_POST['subject'] ?? '';
$message = $_POST['message'] ?? '';

if (empty($name) || empty($email) || empty($subject) || empty($message)) {
    echo 'All fields are required';
    exit;
}

try {
    $stmt = $pdo->prepare("INSERT INTO contact_messages (name, email, subject, message) VALUES (?, ?, ?, ?)");
    $stmt->execute([$name, $email, $subject, $message]);
    echo 'success';
} catch(PDOException $e) {
    echo 'Database error: ' . $e->getMessage();
}
?>