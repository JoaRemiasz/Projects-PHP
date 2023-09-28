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
            font-size: 15px;

        }
    </style>
</head>
<body>
<header>
    <h1>POSTY UŻYTKOWNIKA</h1>
</header>
<nav>
    <ul><?php
        session_start();
        $user = $_SESSION['user'];
        if($user == "admin"){?>
            <li><a href="menu_user.php">Menu admina</a></li>
        <?php }else{?>
        <li><a href="menu_user.php">Menu użytkownika</a></li>
        <?php }?>
        <li><a href="forum.php">Forum dyskusyjne</a></li>
        <li><a href="dodawanie_tematu.php">Dodaj temat</a></li>
        <?php
        if($user == "admin"){?>
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
        $author = $_GET['author'];
        $dbname = "baza_usera";
        $sql1 = "SELECT * FROM post WHERE author='$author'" or die ("DB error: $dbname");

        $rekord = mysqli_query($conn, $sql1);

                while ($p = mysqli_fetch_array($rekord)) {?>
                    <div class="thread">
                        <h5> <?php echo $p[4] . ": " . $p[1]; ?> </h5>
                        <?php
                        if((mime_content_type($p[2])) == ('directory')){
                            echo " ";
                        }
                        else{?>
                            <h5><?php echo $p[4] . ": "; ?><img style="width: 15%" src="<?php echo $p[2]; ?>"</img></h5><br>
                        <?php }
                        ?>
                    </div>
                <?php }

        session_start();
        $id = $_GET['id'];
        $id = $_SESSION['id'];
        echo "<a href='forum_temat.php?id=$id'>Wróć</a>"
        ?>

    </section>
</main>
</body>
</html>
