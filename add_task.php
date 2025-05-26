<?php
include 'db.php';
$title = $_POST['title'];
$description = $_POST['description'];
$due_date = $_POST['due_date'];

$stmt = $conn->prepare("INSERT INTO tasks (title, description, due_date) VALUES (?, ?, ?)");
$stmt->bind_param("sss", $title, $description, $due_date);
$stmt->execute();
header("Location: index.php");
?>
