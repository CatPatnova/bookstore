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
    <img src="<?= $book['cover_path'] ?>">
    <h1>
        <?= $book['title']; ?>
    </h1>
    <h3>
        <?= $book['first_name'] . ' ' . $book['last_name']; ?>
    </h3>
    <br>
    <h2><?= $book['price']; ?></h2>
    <p><?=  $book['language']; ?></p>
    <p>
        <?= $book['summary']; ?>
    </p>

    <a href="edit.php?id=<?= $book['id'] ?>">Muuda</a>

    <a href="index.php">Tagasi</a>
    
</body>
</html>