<?php
require_once('./connection.php');

$id = $_POST['id'];

header('location: book.php?id=' . $id);