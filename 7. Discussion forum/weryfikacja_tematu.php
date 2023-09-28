<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="pl" lang="pl">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
</head>
<BODY>
<?php
session_start();
$user = $_SESSION['user'];

$conn = mysqli_connect('localhost', 'nazwa_usera', 'hasło_usera', 'baza_usera'); //połączenie z bazą danych
mysqli_query($conn, "SET NAMES 'utf8'"); // ustawienie polskich znaków


$name = $_POST['name'];
$description = $_POST['description'];
$time = date('Y-m-d H:i:s');

mysqli_query($conn, "SET NAMES 'utf8'"); // ustawienie polskich znaków
$dbname="00704474_zadanie7";



if (empty($_POST['name'])) {
    $_SESSION['error'] = "Nie udało się utworzyć temtu!";
    header("Location: dodawanie_tematu.php");
    die;
}
else{


    $rows = mysqli_query($conn, "INSERT INTO topic (id, title, description, datetime, author) VALUES ('', '$name', '$description','$time', '$user')") or die ("DB error: $dbname");



    if(isset($rows)){
        session_start();
        header("Location: forum.php");
    }
    else{
        $_SESSION['error'] = "Nie udało się utworzyć tematu!";
    }

}
?>

</body>
</html>
