<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="pl" lang="pl">
<head>
 <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
</head>
<BODY>
<?php
session_start(); // uruchomienie sesji
session_unset(); //wyczyszczenie sesji
header('Location: logowanie.php'); //przejście do pliku "logowanie.php"
?>
</BODY>
</HTML>