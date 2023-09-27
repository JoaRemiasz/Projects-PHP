<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="pl" lang="pl">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
</head>
<BODY>

<?php
$conn = mysqli_connect('localhost', 'nazwa_usera', 'hasło_usera', 'baza_usera'); //połączenie z bazą danych
mysqli_query($conn, "SET NAMES 'utf8'"); // ustawienie polskich znaków
$rows = mysqli_query($conn, "SELECT * FROM songs");

?>
<h1>Dodawanie piosenek</h1>
<form action="upload_zad5.php" method="post" enctype="multipart/form-data">
    <label>Tytuł utworu: </label>
    <input type="text" name="title" id="title"><br>
    <label>Artysta: </label>
    <input type="text" name="musician" id="musician"><br>
    <label>Tekst piosenki: </label>
    <input type="text" name="text" id="text"><br>
    <label>Gatunek piosenki: </label>
    <select name="idmt">
        <option value="1">pop</option>
        <option value="2">rock</option>
        <option value="3">hip-hop</option>
        <option value="4">electronic dance</option>
        <option value="5">R&B</option>
        <option value="6">latin</option>
        <option value="7">country</option>
        <option value="8">metal</option>
        <option value="9">jazz</option>
        <option value="10">classic</option>
    </select><br>
    <label>Wybierz plik: </label>
    <input type="file" accept="audio/mp3" name="image" id="image" ><br>
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
            <TD>Musican</TD>
            <TD>Lyrics</TD>
            <TD>User</TD>
            <TD>Type of music</TD>
            <TD>Music</TD>
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
            <?php $idmt = $row[7];
            $typeName = mysqli_query($conn, "SELECT name FROM musictype WHERE idmt='$idmt';") or die ("DB error: $dbname");
            $rowType = mysqli_fetch_array ($typeName); ?>
            <td><?php echo $rowType[0] ?></td>
            <td>
                <audio controls autoplay muted src="<?php echo $row[5];?>"</audio>
            </td>
        </tr>


<?php } ?>
    </table>
</div>
<br><br>
<a href="logout.php">Wyloguj</a>

</body>
</html>


