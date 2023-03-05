<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="pl" lang="pl">
<HEAD>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
</HEAD>
<BODY>
<?php
 $user=$_POST['user']; //utworzenie zmiennej "user", która pobiera dane z formularza name=user
 $pass=$_POST['pass']; //utworzenie zmiennej "pass", która pobiera dane z formularza name=pass
 $link = mysqli_connect('localhost', 'nazwa_usera', 'hasło_usera', 'baza_usera'); //połączenie z bazą danych ('localhost','nazwa_usera','hasło_usera','baza_usera')
 if(!$link) 
 { 
     echo"Error: ". mysqli_connect_errno()." ".mysqli_connect_error(); //obsługa błędu (jeśli nie uda się połączyć z bazą wyświetli błąd)
 } 
 mysqli_query($link, "SET NAMES 'utf8'"); //ustawienie polskich znaków
 $result = mysqli_query($link, "SELECT * FROM users WHERE (username='$user') and (password='$pass')"); //zapytanie do bazy danych (sprawdzenie w tabeli "users" użytkowników)
 $rekord = mysqli_fetch_array($result);  //pobieranie wiersza z bazy danych
 if(!$rekord) //jeśli w bazie nie ma użytkownika
 {
 mysqli_close($link); //następuję zamknięcie z bazą danych
 echo "Blad nazwy użytkownika lub hasla"; //wyświetla błąd nazwy użytkownika lub hasła
 }
 else // w przeciwnym razie 
 {
 echo "Logowanie Ok. User: {$rekord['username']}. Hasło: {$rekord['password']}"; //wyświetla komunikat o poprawnym zalogowaniu
 }
?>
</BODY>
</HTML>
