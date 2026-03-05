<?php

require_once('./connection.php');

$id = $_GET['id'];

// SELECT * FROM books WHERE id = :id

$stmt = $pdo->prepare(
    'SELECT b.* FROM books b
    WHERE b.id = :id;'
    );
$stmt->execute(['id' => $id]);
$book = $stmt->fetch();

$authors = $pdo->prepare(
    'SELECT a.* FROM authors a 
    LEFT JOIN book_authors ba ON a.id = ba.author_id 
    WHERE ba.book_id = :id'
);
$authors->execute(['id' => $id]);



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
        <?php
        while ($author = $authors->fetch()) { ?>
            <p><?= $author['first_name'] . ' ' . $author['last_name']; ?></p>
        <?php } ?>
    </h3>
    <br>
    <h2><?= $book['price']; ?></h2>
    <p><?= $book['language']; ?></p>
    <p><?= $book['summary']; ?></p>

    <a href="edit.php?id=<?= $book['id'] ?>">Muuda</a>

    <a href="index.php">Tagasi</a>
    
</body>
</html>