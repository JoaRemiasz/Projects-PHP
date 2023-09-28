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

session_start();
$text = $_POST['text'];
$time = date('Y-m-d H:i:s');

if (empty($_POST['text'])) {
    $_SESSION['error'] = "Wypełnij pole!";
    header("Location: dodawanie_tematu.php");
    die;
}
else{
    $rows = mysqli_query($polaczenie, "INSERT INTO ajax_from_db (id, text1, datetime) VALUES ('', '$text','$time')") or die ("DB error: $dbname");

    if(isset($rows)){
        session_start();
        header("Location: formularz.php");
    }
    else{
        $_SESSION['error'] = "Nie udało się dodać rekordu do bazy danych!";
    }
}
?>
