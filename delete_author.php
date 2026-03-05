<?php
require_once('./connection.php');

$id = $_POST['id'];

$removeAuthor = $pdo->prepare('DELETE FROM book_authors 
WHERE book_id = :id AND author_id = :author_id;');
$removeAuthor->execute([
    'id' => $id,
    'author_id' => $_POST['author_id']
]);

header('location: book.php?id=' . $id);