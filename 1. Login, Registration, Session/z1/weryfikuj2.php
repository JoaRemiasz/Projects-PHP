<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="pl" lang="pl">
<HEAD>
 <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
</HEAD>
<BODY>
<?php
 $user = htmlentities ($_POST['user'], ENT_QUOTES, "UTF-8");  //utworzenie zmiennej "user", która pobiera dane z formularza name=user i konwertuje wszystkie groźne znaki (‘, #, *) na encje HTML. 
 $pass = htmlentities ($_POST['pass'], ENT_QUOTES, "UTF-8");  //utworzenie zmiennej "pass", która pobiera dane z formularza name=pass i konwertuje wszystkie groźne znaki (‘, #, *) na encje HTML. 
 $link = mysqli_connect('localhost', 'nazwa_usera', 'hasło_usera', 'baza_usera'); //połączenie z bazą danych ('localhost','nazwa_usera','hasło_usera','baza_usera')
 if(!$link) 
 { 
     echo"Błąd: ". mysqli_connect_errno()." ".mysqli_connect_error(); //obsługa błędu (jeśli nie uda się połączyć z bazą wyświetli błąd)
}
 mysqli_query($link, "SET NAMES 'utf8'"); //ustawienie polskich znaków
 $result = mysqli_query($link, "SELECT * FROM users WHERE username='$user'"); //zapytanie do bazy danych (sprawdzenie w tabeli "users" użytkowników)
 $rekord = mysqli_fetch_array($result); //pobieranie wiersza z bazy danych
 if(!$rekord) //jeśli w bazie nie ma użytkownika
 {
 mysqli_close($link); //następuję zamknięcie z bazą danych
 echo "Brak użytkownika o takim loginie !"; //wyświetla błąd nazwy użytkownika 
 }
 else //w przeciwnym razie 
 { 
 if($rekord['password']==$pass) //jeśli hasło zgadza się z tym z bazy danych
 {
 echo "Logowanie Ok. User: {$rekord['username']}. Hasło: {$rekord['password']}"; //wyświetla komunikat o poprawnym zalogowaniu
 }
 else
 {
 mysqli_close($link); //następuję zamknięcie z bazą danych
 echo "Błąd w haśle !"; //wyświetla błąd nazwy hasła
 }
 }
?>
</BODY>
</HTML>