<?php
require_once('./connection.php');

$id = $_POST['id'];

$add_author = $pdo->prepare(
    'INSERT INTO book_authors (book_id, author_id) VALUES ( :id, :author_id)');

$add_author->execute([
    'id' => $id,
    'author_id' => $_POST['author_id']
]);

header('location: book.php?id=' . $id);