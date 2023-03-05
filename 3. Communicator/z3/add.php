<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="pl" lang="pl">
<HEAD>
 <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
</HEAD>
<BODY>

<?php
 $user = htmlentities ($_POST['user'], ENT_QUOTES, "UTF-8"); //utworzenie zmiennej "user", która pobiera dane z formularza name=user i konwertuje wszystkie groźne znaki (‘, #, *) na encje HTML. 
 $pass = htmlentities ($_POST['pass'], ENT_QUOTES, "UTF-8");  //utworzenie zmiennej "pass", która pobiera dane z formularza name=pass i konwertuje wszystkie groźne znaki (‘, #, *) na encje HTML. 
 $pass1 = htmlentities ($_POST['pass1'], ENT_QUOTES, "UTF-8");  //utworzenie zmiennej "pass1", która pobiera dane z formularza name=pass i konwertuje wszystkie groźne znaki (‘, #, *) na encje HTML. 
 
 $link = mysqli_connect('localhost','nazwa_usera','hasło_usera','baza_usera');//połączenie z bazą danych ('localhost','nazwa_usera','hasło_usera','baza_usera')
 if(!$link) 
 { 
     echo"Błąd: ". mysqli_connect_errno()." ".mysqli_connect_error(); //obsługa błędu (jeśli nie uda się połączyć z bazą wyświetli błąd)
}
 mysqli_query($link, "SET NAMES 'utf8'"); // ustawienie polskich znaków
 $verification = mysqli_query($link, "SELECT * FROM users WHERE username='$user'"); //zapytanie do bazy danych (sprawdzenie w tabeli "users" użytkowników)
 $rekord = mysqli_fetch_array($verification); //pobieranie wiersza z bazy danych
$OK=true; //zmienna o nazwie "OK" z przypisaną wartością "true"
 if($rekord) //jeśli w bazie jest nazwa użytkownika
 {
session_start(); //uruchomienie sesji 
mysqli_close($link); //następuję zamknięcie z bazą danych
$_SESSION['error_user']="Istnieje już użytkownik o takim nicku!"; //utworzenie zmiennej pod nazwą "error_user", której przypisujemy wartość w formie tekstu
$OK=false; //przypisanie zmiennej "OK" wartości false
header('Location: rejestruj.php'); //przejście do pliku "rejestruj.php"
}

if ($pass!=$pass1) //jeśli pass i pass1 nie będą równe 
{
    session_start(); //uruchomienie sesji
     mysqli_close($link); //następuję zamknięcie z bazą danych
    $_SESSION['error_pass']="Podane hasła nie są identyczne!"; //utworzenie zmiennej pod nazwą "error_pass", której przypisujemy wartość w formie tekstu
    $OK=false; //przypisanie zmiennej "OK" wartości false
    header('Location: rejestruj.php'); //przejście do pliku "rejestruj.php"

}

if($OK==true) //jeśli zmienna "OK" będzie miała wartość "true"
{
session_start(); //uruchomienie sesji
    $curdir = getcwd();
    mkdir($curdir ."/$user", 0777);
    $result = mysqli_query($link, "INSERT INTO users (username, password) VALUES ('$user', '$pass')"); //zapytanie dodające użytkownika do bazy danych
    $result; //uruchomienie zapytania
    $_SESSION['reservation']="Rezerwacja przebiegła pomyślnie!";  //utworzenie zmiennej pod nazwą "reservation", której przypisujemy wartość w formie tekstu
    header('Location: rejestruj.php'); //przejście do pliku "rejestruj.php"  
}
else // w przeciwnym razie
{
    session_start(); //uruchomienie sesji
     mysqli_close($link); //następuję zamknięcie z bazą danych
    $_SESSION['error_reservation']="Błąd przy rezerwacji!"; //utworzenie zmiennej pod nazwą "error_reservation", której przypisujemy wartość w formie tekstu
    header('Location: rejestruj.php'); //przejście do pliku "rejestruj.php"
}



?>

</BODY>
</HTML>