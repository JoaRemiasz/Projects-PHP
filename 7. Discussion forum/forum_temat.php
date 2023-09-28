<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Forum Dyskusyjne</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }

        header {
            background-color: #333;
            color: #fff;
            padding: 20px;
        }

        nav ul {
            display: flex;
            list-style: none;
            margin: 0;
            padding: 0;
        }

        nav li {
            margin: 0 10px;
        }

        nav a {
            color: #333;
            text-decoration: none;
        }

        main {
            display: flex;
            justify-content: center;
            padding: 20px;
        }

        section {
            width: 80%;
        }

        .thread {
            border: 1px solid #ccc;
            margin-bottom: 20px;
            padding: 20px;
        }

        .thread h3 {
            margin: 0;
        }

        .form{
            border: 1px solid #ccc;
            margin-top: 5%;
            margin-bottom: 20px;
            padding: 20px;

        }

        .success
        {
            color:green;
            margin-top: 10px;
            margin-bottom: 10px;
        }

        .recipient{
            color:red;
            margin-top: 10px;
            margin-bottom: 10px;
        }

        .odp{
            margin-top: 10px;
            margin-bottom: 10px;
            margin-right: 10px;
            font-size: 15px;

        }

        .error
        {
            color:red;
            margin-top: 10px;
            margin-bottom: 10px;
        }
    </style>
</head>
<body>
<header>
    <h1>Forum Dyskusyjne</h1>
</header>
<nav>
    <ul>
        <?php
        session_start();
        $user = $_SESSION['user'];
        if (isset($_SESSION['loggedin'])){
        if($user == "admin"){?>
        <li><a href="menu_user.php">Menu admina</a></li>
        <?php }else{?>
        <li><a href="menu_user.php">Menu użytkownika</a></li>
        <?php }?>
        <?php }?>
        <li><a href="forum.php">Forum dyskusyjne</a></li>
        <?php if (isset($_SESSION['loggedin'])){?>
        <li><a href="dodawanie_tematu.php">Dodaj temat</a></li>
        <?php }
        if($user == "admin" and isset($_SESSION['loggedin'])){?>
        <li><a href="usun_user.php">Usuwanie użytkownika</a></li>
        <?php }?>
        <li><a href="logowanie.php">Zaloguj</a></li>
        <li><a href="rejestruj.php">Zarejestruj</a></li>
    </ul>
</nav>
<main>

<?php
session_start();
$user = $_SESSION['user'];
$conn = mysqli_connect('localhost', 'nazwa_usera', 'hasło_usera', 'baza_usera'); //połączenie z bazą danych
mysqli_query($conn, "SET NAMES 'utf8'"); // ustawienie polskich znakó

?>
    <section>
        <?php
        session_start();
        $user = $_SESSION['user'];
        $dbname="baza_usera";
        $id = $_GET['id'];
        $_SESSION['id']=$id;
        $user = $_GET['user'];
        $sql = "SELECT * FROM topic WHERE id=$id";
        $sql1 = "SELECT * FROM post WHERE topic_id=$id";

        $result = mysqli_query($conn, $sql);
        $rekord = mysqli_query($conn, $sql1);

        $current_url = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
        while ($r = mysqli_fetch_array($result)) {?>
            <div class="thread">
                <h3> <?php echo $r[1]; ?> </h3>
                <?php
                while ($p = mysqli_fetch_array($rekord)) {?>
                <div class="thread">
                    <?php if($p[5]!=''){?>
                    <h5 class="recipient"> <?php echo "<a href='posty_user.php?author=$p[4]'>$p[4]</a>" . ": Odpowiadanie użytkownikowi: " . $p[5]?> </h5>
                    <?php }?>
                    <h5> <?php echo "<a href='posty_user.php?author=$p[4]'>$p[4]</a>" . ": " . $p[1]; ?> </h5>
                    <?php
                    if((mime_content_type($p[2])) == ('directory')){
                    echo " ";
                    }
                    else{?>
                    <h5><?php echo "<a href='posty_user.php?author=$p[4]'>$p[4]</a>" . ": "; ?><img style="width: 15%" src="<?php echo $p[2]; ?>"</img></h5><br>
                    <?php }
                    if (isset($_SESSION['loggedin'])) {
                        echo "<a class='odp' href='forum_temat.php?id=$id&recipient=$p[4]'>Odpowiedz</a>";
                    }
                    $recipient = $_GET['recipient'];
                    if(isset($_GET['recipient'])) {
                        session_start();
                        $_SESSION['recipient'] = $recipient;
                    }
                    session_start();
                    $user = $_SESSION['user'];
                    if (isset($_SESSION['loggedin'])){
                    if($p[4] == $user or $user == "admin"){
                        echo "<a class='odp' href='usun_post.php?idu=$p[0]'><img style='width: 3%' src='https://cdn-icons-png.flaticon.com/512/39/39220.png'></a><br>";
                    }}
                  ?>
                </div>
                <?php }?>
            </div>
        <?php }?>
            <div class="form">
                <?php
                session_start();
                if(isset($_SESSION['loggedin'])){
                if(isset($_SESSION['recipient'])){?>
                <h5 class="success"><?php echo "Odpowiadasz użytkownikowi: ". $_SESSION['recipient'];?></h5>
                    <?php
                    echo "<a class='odp' href='forum_temat.php?id=$id'>Nie odpowiadaj</a><br>";
                    unset($_SESSION['recipient']);
                }?>
                <br><form  action="" method="post" enctype="multipart/form-data" >
                    <textarea id="post" name="post" rows="4" cols="50">Wpisz post tutaj</textarea><br>
                    <label>Wybierz plik: </label>
                    <input type="file" accept="image/jpeg" name="image" id="image"><br>
                    <input type="submit" value="Wyślij" name="submit">
                    <?php
                    if (isset($_SESSION['swear_words'])) //jeśli sesja "error_user" została uruchomiona
                        {
                        echo '<div class="error">'.$_SESSION['swear_words'].'</div>'; // wyświetlenie zawartości zmiennej sesji "error_user" używając klasy "error"
                            unset($_SESSION['swear_words']); //wyczyszczenie sesji "error_user
                         }
                    ?>
                </form>
                <?php }?>
            </div>

        <a href="logout.php">Wyloguj</a>
    </section>
</main><?php

session_start();
if(isset($_SESSION['loggedin'])){
    if ($_SERVER['REQUEST_METHOD'] === 'POST' and isset($_SESSION['recipient'])) {
        $recipient = $_GET['recipient'];
        session_start();
        $user = $_SESSION['user'];
        $fileName = $_FILES["image"]["name"];

        $conn = mysqli_connect('localhost', 'nazwa_usera', 'hasło_usera', 'baza_usera'); //połączenie z bazą danych
        mysqli_query($conn, "SET NAMES 'utf8'"); // ustawienie polskich znaków

        $target_file = "file/" . basename($fileName);
        move_uploaded_file($_FILES["image"]["tmp_name"], $target_file);

        $swear_words = array("cholera");

        $post = $_POST['post'];
        foreach ($swear_words as $swear_word) {
            if (preg_match("/$swear_word/i", $post)) {
                // Jeśli tak, zablokuj post i wyświetl komunikat o błędzie
                session_start();
                $_SESSION['swear_words'] = "Post zawiera niedozwolone słowa!";
                header('Location: ' . $_SERVER['REQUEST_URI']);
                exit;

            }
        }

        $time = date('Y-m-d H:i:s');
        $id = $_SESSION['id'];

        $dbname = "baza_usera";
        $rows = mysqli_query($conn, "INSERT INTO post (idu, post, filename, datetime,author,recipient, topic_id) VALUES ('', '$post', '$target_file', '$time','$user','$recipient', '$id')") or die ("DB error: $dbname");

        unset($_SESSION['recipient']);
        header('Location: ' . $_SERVER['REQUEST_URI']);

    }
}
{
if(isset($_SESSION['loggedin'])) {
    if ($_SERVER['REQUEST_METHOD'] === 'POST' and !isset($_SESSION['recipient'])) {
        session_start();
        $user = $_SESSION['user'];
        $fileName = $_FILES["image"]["name"];

        $conn = mysqli_connect('localhost', 'nazwa_usera', 'hasło_usera', 'baza_usera'); //połączenie z bazą danych
        mysqli_query($conn, "SET NAMES 'utf8'"); // ustawienie polskich znaków

        $target_file = "file/" . basename($fileName);
        move_uploaded_file($_FILES["image"]["tmp_name"], $target_file);

        $swear_words = array("cholera");

        $post = $_POST['post'];
        foreach ($swear_words as $swear_word) {
            if (preg_match("/$swear_word/i", $post)) {
                // Jeśli tak, zablokuj post i wyświetl komunikat o błędzie
                session_start();
                $_SESSION['swear_words'] = "Post zawiera niedozwolone słowa!";
                header('Location: ' . $_SERVER['REQUEST_URI']);
                exit;

            }
        }
        $time = date('Y-m-d H:i:s');
        $id = $_SESSION['id'];

        $dbname = "baza_usera";
        $rows = mysqli_query($conn, "INSERT INTO post (idu, post, filename, datetime,author,recipient, topic_id) VALUES ('', '$post', '$target_file', '$time','$user','$recipient', '$id')") or die ("DB error: $dbname");

        unset($_SESSION['recipient']);
        header('Location: ' . $_SERVER['REQUEST_URI']);

    }
}

}




?>
</body>
</html>