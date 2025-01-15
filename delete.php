<?php
require 'db.php';
$id = $_GET['id'];
$conn->prepare("DELETE FROM tasks WHERE id = :id")->execute(['id' => $id]);
header('Location: index.php');
?>
