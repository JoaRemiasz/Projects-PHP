<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="pl" lang="pl">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
</head>
<BODY>
<?php
session_start();
$user = $_SESSION['user'];

$conn = mysqli_connect('localhost', 'nazwa_usera', 'hasło_usera', 'baza_usera'); //połączenie z bazą danych
mysqli_query($conn, "SET NAMES 'utf8'"); // ustawienie polskich znaków


$name = $_POST['name'];
$public = $_POST['public'];
$time = date('Y-m-d H:i:s');
$userName = mysqli_query($conn, "SELECT id FROM users where username='$user';");
$row = mysqli_fetch_array ($userName);
$idu = $row[0];

mysqli_query($conn, "SET NAMES 'utf8'"); // ustawienie polskich znaków
$dbname="00704474_zadanie5";

echo $public;


if (empty($_POST['name']) or ($public != '1' and $public != '0')) {
    $_SESSION['error'] = "Nie udało się utworzyć playlisty!";
    header("Location: add_playlist.php");
    die;
}
else{


$rows = mysqli_query($conn, "INSERT INTO playlistname (idpl, idu, name, public, datetime) VALUES ('', '$idu', '$name', '$public','$time')") or die ("DB error: $dbname");



if(isset($rows)){
    session_start();
    $_SESSION['success'] = "Playlista została utworzona!" . '<br>' . '<a href="playlist.php">Wszystkie Playlisty</a>';
}
else{
    $_SESSION['error'] = "Nie udało się utworzyć playlisty!";
}


header("Location: add_playlist.php");
}
?>

</body>
</html>
