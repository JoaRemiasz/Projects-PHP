<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="pl" lang="pl">
<head>
 <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
</head>
<BODY>
<form method="POST" action="add.php"><br>
Nick:
<input type="text" name="user" maxlength="10" size="10"><br>
Post: <br>
Text: <input type="text" name="post" maxlength="90" size="90"><br>
Foto: <input type="file" name="post" id="image" accept=".jpg .jpeg .png" value=""><br>
<input type="submit" name="submit" value="Send"/>
</form>


<?php
$dbhost="localhost"; $dbuser="nazwa_usera"; $dbpassword="hasło_usera"; $dbname="baza_usera";
$connection = mysqli_connect($dbhost, $dbuser, $dbpassword, $dbname);
//bład bazy danych 
if (!$connection)
{
echo " MySQL Connection error." . PHP_EOL;
echo "Errno: " . mysqli_connect_errno() . PHP_EOL;
echo "Error: " . mysqli_connect_error() . PHP_EOL;
exit;
}

//połączenie z bazą danych
$result = mysqli_query($connection, "Select * from messages") or die ("DB error: $dbname");
//wyświetlenie tabelki z wynikami z bazy danych
print "<TABLE CELLPADDING=5 BORDER=1>";
print "<TR><TD>id</TD><TD>Date/Time</TD><TD>User</TD><TD>Message</TD></TR>\n";

//wyświetlenie po kolei wierszy z bazy danych
while ($row = mysqli_fetch_array ($result))
{
$id = $row[0];
$date = $row[1];
$message= $row[2];
$user = $row[3];
print "<TR><TD>$id</TD><TD>$date</TD><TD>$user</TD><TD>$message</TD></TR>\n";
}
print "</TABLE>";

//zamknięcie połączenia z bazą danych
mysqli_close($connection);
?>
</BODY>
</HTML>