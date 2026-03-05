<?php
require_once('./connection.php');

$id = $_POST['id'];

// Andmesbaasi päringud - UPDATE
$stmt = $pdo->prepare(
    'UPDATE books SET 
    title = :title, 
    price = :price,
    language = :language, 
    summary = :summary 
    WHERE id = :id ');
$stmt->execute([
    'title' => $_POST['title'],
    'price' => $_POST['price'],
    'language' => $_POST['language'],
    'summary' => $_POST['summary'],
    'id' => $id
]);

header('location: book.php?id=' . $id);