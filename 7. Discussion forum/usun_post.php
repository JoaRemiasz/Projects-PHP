<?php
session_start();
$user = $_SESSION['user'];
$conn = mysqli_connect('localhost', 'nazwa_usera', 'hasło_usera', 'baza_usera'); //połączenie z bazą danych
mysqli_query($conn, "SET NAMES 'utf8'"); // ustawienie polskich znakó


$idu = $_GET['idu'];
$dbname = "baza_usera";
$sql = "DELETE FROM post WHERE idu=$idu" or die ("DB error: $dbname");
$rekord = mysqli_query($conn, $sql);
$rekord;
session_start();
$id = $_SESSION['id'];
$url = "forum_temat.php?id=$id";
unset($_SESSION['id']);
header('Location: ' . $url);


?>