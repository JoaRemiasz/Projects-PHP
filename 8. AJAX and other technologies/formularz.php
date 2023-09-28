<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="pl" lang="pl">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
</head>
<BODY>
Dodawanie do tabeli nowych rekordów:
<form method="post" action="dodaj.php">
    Text:<input type="text" name="text" maxlength="20" size="20"><br>
    <input type="submit" value="Send"/> <!-- przycisk wysyłania formularza -->
    <?php
    if (isset($_SESSION['success'])) //jeśli sesja "error_user" została uruchomiona
    {
        echo '<div class="success">'.$_SESSION['success'].'</div>'; // wyświetlenie zawartości zmiennej sesji "error_user" używając klasy "error"
        unset($_SESSION['success']); //wyczyszczenie sesji "error_user
    }
    if (isset($_SESSION['error'])) //jeśli sesja "error_user" została uruchomiona
    {
        echo '<div class="error">'.$_SESSION['error'].'</div>'; // wyświetlenie zawartości zmiennej sesji "error_user" używając klasy "error"
        unset($_SESSION['error']); //wyczyszczenie sesji "error_user
    }
    ?>
</form>
</BODY>
</HTML>