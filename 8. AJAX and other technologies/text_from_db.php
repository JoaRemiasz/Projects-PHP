<?php
$dbhost="localhost"; $dbuser="nazwa_usera"; $dbpassword="hasło_usera"; $dbname="baza_usera";
$polaczenie = mysqli_connect($dbhost, $dbuser, $dbpassword, $dbname);
if (!$polaczenie)
{
    echo "SQL error 1." . PHP_EOL;
    echo "Errno: " . mysqli_connect_errno() . PHP_EOL;
    echo "Error: " . mysqli_connect_error() . PHP_EOL;
    exit;
}
header("Content-Type: text/event-stream");
while (!connection_aborted())
{
    $rezultat = mysqli_query($polaczenie, "SELECT * FROM ajax_from_db ORDER by id DESC Limit 1") or die ("SQL error 2: $dbname");
    while ($wiersz = mysqli_fetch_array ($rezultat))
    {
        $id = $wiersz[0];
        $text1 = $wiersz[1];
        $data = $wiersz[2];
    }
    echo 'data:'.$text1, "\n\n";
// flush the output buffer and send echoed messages to the browser
    while (ob_get_level() > 0) { ob_end_flush(); }
    flush();
    sleep(1); // Sleep for 1 seconds
}
mysqli_close($polaczenie);
?>
