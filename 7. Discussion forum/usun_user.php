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

        .table{

            background-color: gainsboro;
            margin: auto;
        }

    </style>
</head>
<body>
<header>
    <?php
    $user = $_SESSION['user'];
    if($user = 'admin'){?>
        <h1>USUWANIE UŻYTKOWNIKA</h1>

    <?php } ?>
</header>
<nav>
    <ul>

        <?php
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
        if($user = 'admin'){?>
            <li><a href="usun_user.php">Usuwanie użytkownika</a></li>
        <?php }?>
        <li><a href="logowanie.php">Zaloguj</a></li>
        <li><a href="rejestruj.php">Zarejestruj</a></li>
    </ul>
</nav>
<main>
    <section>

        <?php
        session_start();
        $conn = mysqli_connect('localhost', 'nazwa_usera', 'hasło_usera', 'baza_usera'); //połączenie z bazą danych
        mysqli_query($conn, "SET NAMES 'utf8'"); // ustawienie polskich znaków
        $rows = mysqli_query($conn, "SELECT * FROM users");
        $users = "SELECT username FROM users;";
        $result = mysqli_query($conn, $users);
        ?>
                <div class="thread">
                    <div class="forum">
                        <form action="usuwanie_user.php" method="post" enctype="multipart/form-data">
                            <h2>Usuwanie użytkownika z portalu: </h2>
                            <label>Użytkownik: </label>
                            <select id="users" name="users">
                                <?php while($r = $result-> fetch_array()){ ?>
                                    <option value="<?php echo $r[0];?>"</option><br>
                                    <?php echo $r[0];?>
                                    <?php
                                }
                                ?>
                            </select><br>
                            <input type="submit" value="Send" name="submit">

                            <?php
                            if (isset($_SESSION['success'])) //jeśli sesja "error_user" została uruchomiona
                            {
                                echo '<div class="success">'.$_SESSION['success'].'</div>'; // wyświetlenie zawartości zmiennej sesji "error_user" używając klasy "error"
                                unset($_SESSION['success']); //wyczyszczenie sesji "error_user
                            }
                            if (isset($_SESSION['error'])) //jeśli sesja "error_user" została uruchomiona
                            {
                                echo '<div class="error">'.$_SESSION['error'].'</div>'; // wyświetlenie zawartości zmiennej sesji "error_user" używając klasy "error"
                                unset($_SESSION['error']); //wyczyszczenie sesji "error_user
                            }
                            ?>

                        </form>
                    </div>

                </div>
                <a href="logout.php">Wyloguj</a>
            </section>
        </main>
        <br><br>


</BODY>
</html>