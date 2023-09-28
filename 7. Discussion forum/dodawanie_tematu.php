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


        .error
        {
            color:red;
            margin-top: 10px;
            margin-bottom: 10px;
        }

        .success
        {
            color:green;
            margin-top: 10px;
            margin-bottom: 10px;
        }

        .forum{
            margin: auto;
            align-items: center;
            justify-content: center;
        }

    </style>
</head>
<body>
<header>
    <h1>DODAWANIE TEMATU</h1>
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
        <?php if($user == "admin"){?>
        <li><a href="usun_user.php">Usuwanie użytkownika</a></li>
        <?php }?>
        <li><a href="logowanie.php">Zaloguj</a></li>
        <li><a href="rejestruj.php">Zarejestruj</a></li>
    </ul>
</nav>

<?php
session_start();
?>
<main>
    <section>
<div class="thread">
    <div class="forum">
        <form action="weryfikacja_tematu.php" method="post" enctype="multipart/form-data">
            <h2>Tworzenie tematu na forum dyskusyjnym: </h2>
            <label>Tytuł: </label>
            <input type="text" name="name" id="name"><br>
            <label>Opis tematu: </label>
            <input width="200px" type="text" name="description" id="description"><br>
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