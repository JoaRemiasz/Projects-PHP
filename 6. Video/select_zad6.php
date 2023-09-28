<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="pl" lang="pl">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
</head>
<BODY>

<?php
$conn = mysqli_connect('localhost', 'nazwa_usera', 'hasło_usera', 'baza_usera'); //połączenie z bazą danych
mysqli_query($conn, "SET NAMES 'utf8'"); // ustawienie polskich znaków
$rows = mysqli_query($conn, "SELECT * FROM film");

?>
<h1>Dodawanie filmów</h1>
<form action="upload_zad6.php" method="post" enctype="multipart/form-data">
    <label>Tytuł filmu: </label>
    <input type="text" name="title" id="title"><br>
    <label>Reżyser: </label>
    <input type="text" name="director" id="director"><br>
    <label>Napisy: </label>
    <input type="text" name="subtitles" id="subtitles"><br>
    <label>Gatunek filmu: </label>
    <select name="idft">
        <option value="1">dokument</option>
        <option value="2">reportaż</option>
        <option value="3">publicystyka</option>
        <option value="4">film akcji</option>
        <option value="5">sci-fi</option>
        <option value="6">horror</option>
        <option value="7">familijny</option>
        <option value="8">przyrodniczy</option>
        <option value="9">koncert</option>
        <option value="10">anonimowy</option>
        <option value="11">inny</option>
    </select><br>
    <label>Wybierz plik: </label>
    <input type="file" accept="video/mp4" name="image" id="image" ><br>
    <input type="submit" value="Send" name="submit">
</form>

<a href="add_playlist.php">Stwórz playlistę</a><br>

<?php
session_start();
$dbname="baza_usera";

?>
<br><div id="load_mes">
    <table  border = 1 cellspacing = 0 cellpadding = 10>
        <TR>
            <TD>ID</TD>
            <TD>Date/Time</TD>
            <TD>Title</TD>
            <TD>Director</TD>
            <TD>Subtitles</TD>
            <TD>User</TD>
            <TD>Type of film</TD>
            <TD>Film</TD>
        </TR>
<?php
while ($row = mysqli_fetch_array($rows)){?>
        <tr>
            <td><?php echo $row[0];?></td>
            <td><?php echo $row[3];?></td>
            <td><?php echo $row[1];?></td>
            <td><?php echo $row[2];?></td>
            <td><?php echo $row[6];?></td>
            <?php $idu = $row[4];
            $userName = mysqli_query($conn, "SELECT username FROM users where id='$idu';") or die ("DB error: $dbname");
            $rowUser = mysqli_fetch_array ($userName);?>
            <td><?php echo $rowUser[0] ?></td>
            <?php $idft = $row[7];
            $typeName = mysqli_query($conn, "SELECT name FROM filmtype WHERE idft='$idft';") or die ("DB error: $dbname");
            $rowType = mysqli_fetch_array ($typeName); ?>
            <td><?php echo $rowType[0] ?></td>
            <td>
                <video controls autoplay muted width="250" src="<?php echo $row[5]; ?>"</video>
            </td>
        </tr>


<?php } ?>
    </table>
</div>
<br><br>
<a href="logout.php">Wyloguj</a>

</body>
</html>


