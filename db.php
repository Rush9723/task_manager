<?php
$host = 'localhost:3308';
$user = 'root';
$password = 'root';
$dbname = 'task_manager';

try {
    $conn = new PDO("mysql:host=$host;dbname=$dbname", $user, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Connection failed during database connection: " . $e->getMessage());
}
?>
