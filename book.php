<?php

require_once('./connection.php');

$id = $_GET['id'];

// SELECT * FROM books WHERE id = :id

$stmt = $pdo->prepare('SELECT * FROM books WHERE id = :id');
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
    <h1>
        <?= $book['title']; ?>
    </h1>
    <br>
    <h2><?= $book['price']; ?></h2>
    <p>
        <?= $book['summary']; ?>
    </p>
    <p>
        <?= $book[''] ?>
    </p>

</body>
</html>