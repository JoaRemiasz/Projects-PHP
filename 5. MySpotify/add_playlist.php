<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="pl" lang="pl">
<head>

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
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
</head>
<BODY>

<?php
$conn = mysqli_connect('localhost', 'nazwa_usera', 'hasło_usera', 'baza_usera'); //połączenie z bazą danych
mysqli_query($conn, "SET NAMES 'utf8'"); // ustawienie polskich znaków
$rows = mysqli_query($conn, "SELECT * FROM songs");
session_start();
?>

<form action="create_playlist.php" method="post" enctype="multipart/form-data">
    <h2>Tworzenie playlisty</h2>
    <label>Nazwa playlisty: </label>
    <input type="text" name="name" id="name"><br>
    <input type="radio" id="public" name="public" value="1">
    <label for="public">Public</label><br>
    <input type="radio" id="public" name="public" value="0">
    <label for="public">Private</label><br>
    <input type="submit" value="Send" name="submit">

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

<br><br>
<a href="logout.php">Wyloguj</a>

</BODY>
</html>