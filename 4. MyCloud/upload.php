<?php
session_start();
$user = $_SESSION['user'];

$fileName = $_FILES["image"]["name"];

$dir = $_SESSION['dir'];

$target_file = $dir . "/" . basename($fileName);
move_uploaded_file($_FILES["image"]["tmp_name"], $target_file);
unset($_SESSION['dir']);
header("Location: katalog.php");


?>