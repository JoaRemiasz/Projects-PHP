<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
</head>
<body>
<?php
session_start();
$user = $_SESSION['user'];
$fileName = $_FILES["image"]["name"];

$conn = mysqli_connect('localhost', 'nazwa_usera', 'hasło_usera', 'baza_usera'); //połączenie z bazą danych
mysqli_query($conn, "SET NAMES 'utf8'"); // ustawienie polskich znaków

$target_file = "file/" . basename($fileName);
move_uploaded_file($_FILES["image"]["tmp_name"], $target_file);

$post = $_POST['post'];
$time = date('Y-m-d H:i:s');
$id = $_SESSION['id'];

$dbname="baza_usera";
$rows = mysqli_query($conn, "INSERT INTO post (idu, post, filename, datetime, id) VALUES ('', '$post', '$target_file', '$time', '$id')") or die ("DB error: $dbname");

?>

</body>
</html>