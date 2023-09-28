<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="pl" lang="pl">
<HEAD>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
</HEAD>
<BODY>
<?php
$user = htmlentities ($_POST['user'], ENT_QUOTES, "UTF-8"); //utworzenie zmiennej "user", która pobiera dane z formularza name=user i konwertuje wszystkie groźne znaki (‘, #, *) na encje HTML.
$pass = htmlentities ($_POST['pass'], ENT_QUOTES, "UTF-8");  //utworzenie zmiennej "pass", która pobiera dane z formularza name=pass i konwertuje wszystkie groźne znaki (‘, #, *) na encje HTML.
$link = mysqli_connect('localhost', 'nazwa_usera', 'hasło_usera', 'baza_usera'); //połączenie z bazą danych ('localhost','nazwa_usera','hasło_usera','baza_usera')

if(!$link)
{
    echo"Błąd: ". mysqli_connect_errno()." ".mysqli_connect_error(); //obsługa błędu (jeśli nie uda się połączyć z bazą wyświetli błąd)
}
mysqli_query($link, "SET NAMES 'utf8'"); // ustawienie polskich znaków
$result = mysqli_query($link, "SELECT * FROM users WHERE username='$user'"); //zapytanie do bazy danych (sprawdzenie w tabeli "users" użytkowników)
$rekord = mysqli_fetch_array($result); //pobieranie wiersza z bazy danych


if(!$rekord) //jeśli w bazie nie ma użytkownika
{
    mysqli_close($link); //następuję zamknięcie z bazą danych
    session_start();
    $_SESSION["login_attempts"] += 1;
    $_SESSION["error"]="Błędne dane";
    $ipaddress = $_SERVER["REMOTE_ADDR"];
    function ip_details($ip) {
        $json = file_get_contents ("https://www.iplocate.io/api/lookup/{$ip}");
        $details = json_decode ($json);
        return $details;
    }
    $details = ip_details($ipaddress);
    $ip = $details -> ip;
    $date = date('Y-m-d H:i:s');

    $link = mysqli_connect(('localhost', 'nazwa_usera', 'hasło_usera', 'baza_usera'); //połączenie z bazą danych ('localhost','nazwa_usera','hasło_usera','baza_usera')
    $query =  mysqli_query($link, "INSERT INTO break_ins VALUES ('','$date','$ip')");
    mysqli_query($link, $query);

    header('Location: index3.php'); //przejście do pliku "index3.php"
}
else //w przeciwnym razie
{
    if($rekord['password']==$pass) //jeśli hasło zgadza się z tym z bazy danych
    {
        session_start(); //uruchomienie sesji
        $_SESSION['loggedin'] = true; //utworzenie zmiennej pod nazwą "loggedin", której przypisujemy "true
        $_SESSION['user'] = $user;

        ?>
        <?php
        $ipaddress = $_SERVER["REMOTE_ADDR"];
        function ip_details($ip) {
            $json = file_get_contents ("https://www.iplocate.io/api/lookup/{$ip}");
            $details = json_decode ($json);
            return $details;
        }
        $details = ip_details($ipaddress);
        $ip = $details -> ip;
        $date = date('Y-m-d H:i:s');

//zapisanie do bazy danych wszystkich danych gościa odwiedzającego stronę
        $link = mysqli_connect('localhost', 'nazwa_usera', 'hasło_usera', 'baza_usera'); //połączenie z bazą danych ('localhost','nazwa_usera','hasło_usera','baza_usera')
        $query =  mysqli_query($link, "INSERT INTO goscieportalu VALUES ('','$ip','$date', '$user')");
        mysqli_query($link, $query);

        header('Location: index4.php');
    }
    else //w przeciwnym razie
    {
        mysqli_close($link); //następuję zamknięcie z bazą danych
        session_start();
        $_SESSION["login_attempts"] += 1;
        $_SESSION["error"]="Błędne dane";

        $ipaddress = $_SERVER["REMOTE_ADDR"];
        function ip_details($ip) {
            $json = file_get_contents ("https://www.iplocate.io/api/lookup/{$ip}");
            $details = json_decode ($json);
            return $details;
        }
        $details = ip_details($ipaddress);
        $ip = $details -> ip;
        $date = date('Y-m-d H:i:s');

        $link = mysqli_connect('localhost', 'nazwa_usera', 'hasło_usera', 'baza_usera'); //połączenie z bazą danych ('localhost','nazwa_usera','hasło_usera','baza_usera')
        $query =  mysqli_query($link, "INSERT INTO break_ins VALUES ('','$date','$ip')");
        mysqli_query($link, $query);
        header('Location: index3.php'); //przejście do pliku "index3.php"
    }
}
?>
</BODY>
</HTML>