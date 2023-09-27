<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="pl" lang="pl">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">

    <style>

        table {
            background-color: #CCFFCC;
            border: 1px solid #00CC00;

        }

        td {
            padding: 5px;
        }
    </style>
</head>
<BODY>

<?php
session_start();
$user = $_SESSION['user'];
$conn = mysqli_connect('localhost', 'nazwa_usera', 'hasło_usera', 'baza_usera'); //połączenie z bazą danych
mysqli_query($conn, "SET NAMES 'utf8'"); // ustawienie polskich znaków


$playlist = $_POST['list'];

$rows= mysqli_query($conn, "SELECT name FROM playlistname where idpl='$playlist';");
$result = mysqli_query($conn, "SELECT * FROM playlistdatabase where idpl='$playlist';");
$row = mysqli_fetch_array ($rows);


?>
<table border = 1 cellspacing = 0 cellpadding = 10>
    <tr>
        <td><h4>Playlist - <?php  echo $row[0] ?></h4></td>
    </tr>

    <tr>
        <td><h5>Tytuł</h5></td>
        <td><h5>Piosenka</h5></td>
    </tr>
    <tr>
        <?php
        while ($r = mysqli_fetch_array ($result)) {
            $ids = $r[2];
            $song = mysqli_query($conn, "SELECT title, filename FROM songs where ids='$ids';");
            $rowSong = mysqli_fetch_array($song); ?>
            <tr><td><?php echo $rowSong[0]; ?><br></td>
        <td><audio controls autoplay muted src="<?php echo $rowSong[1];?>"</audio><br></td>
            </tr>
        <?php }?>

    </tr>


</table>

<br><br>
<a href="logout.php">Wyloguj</a>




</BODY>
</html>
