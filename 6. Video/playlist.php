<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="pl" lang="pl">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<style>
    table {
        display: inline-block;
        margin-inside: 30%;
        margin-right: 10%;
    }

    .td_h3{
        background: #00ba37;
    }

    .td_h4{
        background: #1bd760;
    }
</style>

</head>
<BODY>

<?php
session_start();
$user = $_SESSION['user'];
$dbname="baza_usera";
$conn = mysqli_connect('localhost', 'nazwa_usera', 'hasło_usera', 'baza_usera'); //połączenie z bazą danych
mysqli_query($conn, "SET NAMES 'utf8'"); // ustawienie polskich znaków
$rows = mysqli_query($conn, "SELECT id FROM users where username='$user';");




?>
<h1>Wszystkie playlisty</h1>

<table border = 1 cellspacing = 0 cellpadding = 10>
    <tr>
        <td class="td_h3"><h3>MOJE PLAYLISTY</h3></td>
    </tr>
    <tr>
        <td class="td_h4"><h4>PRYWATNE PLAYLISTY</h4></td>
    </tr>
    <?php
    while ($row = mysqli_fetch_array($rows)) {
        $idu = $row[0];
        $userName = mysqli_query($conn, "SELECT name FROM playlistname where idu='$idu' and public = 0;") or die ("DB error: $dbname");
        $userName1 = mysqli_query($conn, "SELECT name FROM playlistname where idu='$idu' and public = 1;") or die ("DB error: $dbname");
        $playlist = mysqli_query($conn, "SELECT idpl,name FROM playlistname where idu='$idu' or public = 1") or die ("DB error: $dbname");

    }
    ?>
    <tr>
        <td>
            <?php
            while ($r = mysqli_fetch_array($userName)){?>

                <?php echo $r[0];?><br>

            <?php } ?>
        </td>
    </tr>
    <tr>
        <td class="td_h4"><h4>PUBLICZNE PLAYLISTY</h4></td>
    </tr>
    <tr>
        <td>
            <?php
            while ($r = mysqli_fetch_array($userName1)){?>
                <?php echo $r[0];?><br>
            <?php } ?>
        </td>
    </tr>
</table>


<table border = 1 cellspacing = 0 cellpadding = 10>
    <tr>
        <td class="td_h3"><h4>PULICZNE PLAYLISTY</h4></td>
    </tr>
    <?php
        $userName = mysqli_query($conn, "SELECT name FROM playlistname where public = 1;") or die ("DB error: $dbname");
    ?>
    <tr>
        <td>
            <?php
            while ($r = mysqli_fetch_array($userName)){?>
                <?php echo $r[0];?><br>
            <?php } ?>
        </td>
    </tr>
</table>

<table border = 1 cellspacing = 0 cellpadding = 10>
    <tr>
        <td class="td_h3"><h4>PRYWATNE PLAYLISTY</h4></td>
    </tr>
    <?php
    $rows = mysqli_query($conn, "SELECT id FROM users where username='$user';");
    while ($row = mysqli_fetch_array($rows)) {
        $idu = $row[0];
        $userName2 = mysqli_query($conn, "SELECT name FROM playlistname where idu='$idu' and public = 0;") or die ("DB error: $dbname");
    }
    ?>
    <tr>
        <td>
            <?php
            while ($r = mysqli_fetch_array($userName2)){?>
                <?php echo $r[0];?><br>
            <?php } ?>
        </td>
    </tr>
</table><br><br><br>


<a href="add_film_playlist.php">Dodaj film do playlisty.</a>

<form action="playlist_film_view.php" method="post" enctype="multipart/form-data">
    <h2>Wybierz playlistę, którą chcesz obejrzeć:</h2>
    <label for="list">Wybierz playliste:</label><br>
    <select id="list" name="list">
        <?php while($r = $playlist -> fetch_array()){ ?>
            <option value="<?php echo $r[0];?>"</option><br>
            <?php echo $r[1];?>
            <?php
        }
        ?>
    </select><br>
    <input type="submit" value="Send" name="submit">
</form>
<br><br><br>
<a href="logout.php">Wyloguj</a>

</BODY>
</html>



