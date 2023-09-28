<?php
session_start();
$user = $_SESSION['user'];
$conn = mysqli_connect('localhost', 'nazwa_usera', 'hasło_usera', 'baza_usera'); //połączenie z bazą danych
mysqli_query($conn, "SET NAMES 'utf8'"); // ustawienie polskich znakó


$id = $_GET['id'];
$dbname = "baza_usera";

$sql1 = "DELETE t, p FROM topic AS t
LEFT JOIN post AS p ON t.id = p.topic_id
WHERE t.id = $id";
$rekord1 = mysqli_query($conn, $sql1);


    $rekord1;




header('Location: forum.php');

?>