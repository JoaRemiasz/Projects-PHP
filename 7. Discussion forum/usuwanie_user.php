<?php
session_start();
$user = $_SESSION['user'];
$conn = mysqli_connect('localhost', 'nazwa_usera', 'hasło_usera', 'baza_usera')); //połączenie z bazą danych
mysqli_query($conn, "SET NAMES 'utf8'"); // ustawienie polskich znakó


$users = $_POST['users'];
$dbname = "baza_usera";
$sql = "DELETE FROM users WHERE username='$users';" or die ("DB error: $dbname");
$rekord = mysqli_query($conn, $sql);
$rekord;
session_start();
header('Location: usun_user.php');


?>