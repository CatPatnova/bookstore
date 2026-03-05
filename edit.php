<?php
require_once('./connection.php');

$id = $_GET['id'];

// SELECT * FROM books WHERE id = :id

$stmt = $pdo->prepare(
    'SELECT * FROM books b
    WHERE id = :id;'
    );
$stmt->execute(['id' => $id]);
$book = $stmt->fetch();

$authors = $pdo->prepare('SELECT DISTINCT a.* FROM authors a
LEFT JOIN book_authors ba ON a.id = ba.author_id
WHERE ba.book_id != :id');
$authors->execute(['id' => $id]);

$current_authors = $pdo->prepare('SELECT a.* FROM authors a 
LEFT JOIN book_authors ba ON a.id = ba.author_id 
WHERE ba.book_id = :id');
$current_authors->execute(['id' => $id]);

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
        <input type="hidden" name="id" value="<?= $id; ?>"><br>
        <input type="text" name="title" value="<?= $book['title'] ?>"><br>
        <input type="text" name="price" value="<?= $book['price'] ?>"><br>
        <input type="text" name="language" value="<?= $book['language'] ?>"><br>
        <input type="text" name="summary" value="<?= $book['summary'] ?>"><br>
        <input type="submit" value="Salvesta">
    </form>
    <form action="add_author.php" method="post">
        <input type="hidden" name="id" value="<?= $id ?>">
        <select name="author_id">
            <option></option>
            <?php 
            while ($author = $authors->fetch()) { ?>
                <option name="id" value="<?= $author['id'] ?>">
                    <?= $author['first_name'] . ' ' . $author['last_name'] ?>
                </option>
            <?php } ?>
            <input type="submit" value="Lisa">
        </select>
    </form>
    <form action="delete_author.php" method="post">
        <input type="hidden" name="id" value="<?= $id ?>">
        <select name="author_id">
            <option></option>
            <?php
            while ($current_author = $current_authors->fetch()) { ?>
                <option name="id" value="<?= $current_author['id'] ?>">
                    <?= $current_author['first_name'] . ' ' . $current_author['last_name'] ?>
                </option>
            <?php } ?>
        </select>
        <input type="submit" value="Kustuta">
    </form>
</body>
</html>