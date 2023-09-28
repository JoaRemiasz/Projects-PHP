
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
session_start();
$user = $_SESSION['user'];
$conn = mysqli_connect('localhost', 'nazwa_usera', 'hasło_usera', 'baza_usera'); //połączenie z bazą danych
mysqli_query($conn, "SET NAMES 'utf8'"); // ustawienie polskich znaków
$rows = mysqli_query($conn, "SELECT id FROM users where username='$user';");


?>
<h1>Dodawanie filmu do playlisty:</h1>
<form action="create_film_playlist.php" method="post" enctype="multipart/form-data">
    <label for="playlist">Wybierz playliste:</label><br>
    <?php
    while ($row = mysqli_fetch_array($rows)) {
    $idu = $row[0];
    $userName = mysqli_query($conn, "SELECT idpl,name FROM playlistname where idu='$idu'");
    }?>
    <select id="playlist" name="playlist">
        <?php while($r = $userName -> fetch_array()){ ?>
            <option value="<?php echo $r[0];?>"</option><br>
            <?php echo $r[1];?>
            <?php
        }
        ?>
    </select><br>


    <label for="film">Wybierz film:</label><br>
    <?php
        $songs = mysqli_query($conn, "SELECT idf,title FROM film");
    ?>
    <select id="film" name="film">
        <?php while($r = $songs-> fetch_array()){ ?>
            <option value="<?php echo $r[0];?>"</option><br>
            <?php echo $r[1];?>
            <?php
        }
        ?>
    </select><br>
    <br><input type="submit" value="Send" name="submit">
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