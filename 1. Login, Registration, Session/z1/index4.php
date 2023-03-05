<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="pl" lang="pl">
<head>
 <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
</head>
<BODY>
<h3> Menu </h3>


<?php 
session_start(); // zapewnia dostęp do zmienny sesyjnych w danym pliku (uruchomienie sesji)
if (!isset($_SESSION['loggedin'])) //jeśli sesja "loggedin" nie została uruchomiona
{
header('Location: logowanie.php'); //przejście do pliku "logowanie.php"
exit(); //kończy skrypt
}
if (isset($_SESSION['loggedin'])) { //jeśli sesja "loggedin" została uruchomiona
   echo "Zalogowano!"; //wyświetlono komunikat "Zalogowano"
}
?>
<br><a href="logout.php">Wyloguj</a><br> <!-- link z przekirowaniem do pliku "logout.php" -->
</BODY>
</HTML>