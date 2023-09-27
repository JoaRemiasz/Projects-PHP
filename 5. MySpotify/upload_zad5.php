<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="pl" lang="pl">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
</head>
<BODY>
<?php
session_start();
$user = $_SESSION['user'];
$fileName = $_FILES["image"]["name"];

$conn = mysqli_connect('localhost', 'nazwa_usera', 'hasło_usera', 'baza_usera'); //połączenie z bazą danych
mysqli_query($conn, "SET NAMES 'utf8'"); // ustawienie polskich znaków

$target_file = "songs/" . basename($fileName);

move_uploaded_file($_FILES["image"]["tmp_name"], $target_file);

$title = $_POST['title'];
$musican = $_POST['musician'];
$text = $_POST['text'];
$idmt = $_POST['idmt'];
$time = date('Y-m-d H:i:s');
$userName = mysqli_query($conn, "SELECT id FROM users where username='$user';");
$row = mysqli_fetch_array ($userName);
$idu = $row[0];


mysqli_query($conn, "SET NAMES 'utf8'"); // ustawienie polskich znaków
$dbname="baza_usera";
$rows = mysqli_query($conn, "INSERT INTO songs (ids, title, musician, datetime, idu, filename, lyrics, idmt) VALUES ('', '$title', '$musican', '$time','$idu', '$target_file', '$text', '$idmt')") or die ("DB error: $dbname");

header("Location: select_zad5.php");

?>

</body>
</html>
