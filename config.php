<?php
$host = 'sql109.infinityfree.com';
$dbname = 'if0_41956422_alexandria_db';
$username = 'if0_41956422';
$password = 'alexinfinity77';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
    die("Connection failed: " . $e->getMessage());
}
?>