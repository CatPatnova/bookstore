<?php
require_once('./connection.php');

$id = $_GET['id'];

// SELECT * FROM books WHERE id = :id

$stmt = $pdo->prepare(
    'SELECT b.*, a.first_name , a.last_name FROM books b
    LEFT JOIN book_authors ba ON b.id = ba.book_id
    LEFT JOIN authors a ON ba.author_id = a.id
    WHERE b.id = :id;'
    );
$stmt->execute(['id' => $id]);
$book = $stmt->fetch();

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h3>Muuda: <?= $book['title']; ?></h3>
    <form action="update.php" method="post">
        <input type="hidden" name="id" value="<?= $id; ?>">
        <input type="text" name="title" value="<?= $book['title'] ?>">
        <input type="text" name="price" value="<?= $book['price'] ?>">
        <input type="text" name="summary" value="<?= $book['summary'] ?>">
        <input type="text" name="author" value="<?= $book['first_name'] . ' ' . $book['last_name']; ?>">
        <input type="submit" value="Salvesta">
    </form>
    
</body>
</html>