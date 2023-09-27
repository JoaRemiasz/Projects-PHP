
<?php
session_start();


if (isset($_SESSION['user'])) {
    $target_dir = $_SESSION['user'];
}
$fileName = $_FILES["image"]["name"];

$target_file = $target_dir . "/" . basename($fileName);

    move_uploaded_file($_FILES["image"]["tmp_name"], $target_file);

    $time = date('H:i:s', time());



    $dbhost = "localhost";
    $dbuser = 'nazwa_usera';
    $dbpassword = 'hasło_usera';
    $dbname = 'baza_usera';
    $connection = mysqli_connect($dbhost, $dbuser, $dbpassword, $dbname);


    $query = "INSERT INTO messages (post, message, user, recipient) VALUES ('".$_POST['post']."','$target_file', '".$_POST['name']."', '".$_POST['recipient']."')";
    mysqli_query($connection, $query);

    header('Location: index1.php');

?>
