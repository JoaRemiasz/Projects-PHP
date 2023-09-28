<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="pl" lang="pl">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">

    <style>
        .error
        {
            color:red;
            margin-top: 10px;
            margin-bottom: 10px;
        }

        .success
        {
            color:green;
            margin-top: 10px;
            margin-bottom: 10px;
        }
    </style>
</head>
<BODY>
<?php
session_start();
if (isset($_SESSION["locked"]))
{
    $difference = time() - $_SESSION["locked"];
    if ($difference > 30)
    {
        unset($_SESSION["locked"]);
        unset($_SESSION["login_attempts"]);
    }
}
?>
Formularz logowania
<form method="post" action="weryfikuj3.php"> <!-- formularz, metoda "post" wysyła dane do pliku "weryfikuj3.php" -->
    Login:<input type="text" name="user" maxlength="20" size="20"><br> <!-- utworzenie pola tekstowego typ_pola="text", nazwa_pola="user", maksymalna_dlugosc_znakow="20", wielkość_liter="20"  -->
    Hasło:<input type="password" name="pass" maxlength="20" size="20"><br> <!-- utworzenie pola tekstowego typ_pola="password", nazwa_pola="pass", maksymalna_dlugosc_znakow="20", wielkość_liter="20"  -->
    <?php
    if (isset($_SESSION['error'])) //jeśli sesja "error_user" została uruchomiona
    {
        echo '<div class="error">'.$_SESSION['error'].'</div>'; // wyświetlenie zawartości zmiennej sesji "error_user" używając klasy "error"
        unset($_SESSION['error']); //wyczyszczenie sesji "error_user
    }
    ?>
<?php
    if ($_SESSION["login_attempts"] > 2)
    {
    $_SESSION["locked"] = time();

        $link = mysqli_connect('localhost', 'nazwa_usera', 'hasło_usera', 'baza_usera'); //połączenie z bazą danych ('localhost','nazwa_usera','hasło_usera','baza_usera')
        mysqli_query($link, "SET NAMES 'utf8'"); // ustawienie polskich znaków
        $rows = mysqli_query($link, "SELECT * FROM break_ins ORDER BY id DESC");
        $row = mysqli_fetch_array($rows);
        ?>
        <p class="error">
            <?php echo "Błędne logowanie: "?><br>
            <?php echo "Data i godzina logowania: " . $row['datetime']?><br>
            <?php echo "IP Użytkownika: " . $row['ip']?><br>

        </p>
        <?php
    echo '<p class="error">Please wait for 30 seconds</p><br>';


    }
    else
    {

    ?>
        <input type="submit" value="Send"/> <!-- przycisk wysyłania formularza -->
    <?php
}
?>


</form>
</BODY>
</HTML>



