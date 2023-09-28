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

        </style>
</head>
<body>
<header>
    <h1>FORUM DYSKUSYJNE</h1>
</header>
<nav>
    <ul>
        <?php session_start();
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
    <section>
        <h2>Tematy</h2>
            <?php session_start();
            $user = $_SESSION['user'];
            $dbname="baza_usera";
            $conn = mysqli_connect('localhost', 'nazwa_usera', 'hasło_usera', 'baza_usera'); //połączenie z bazą danych
            mysqli_query($conn, "SET NAMES 'utf8'"); // ustawienie polskich znaków
            $rows = mysqli_query($conn, "SELECT * FROM topic;");
        while ($row = mysqli_fetch_array($rows)) {?>
        <div class="thread">
        <h3> <?php echo $row[1]; ?> </h3>
            <p><?php echo $row[2]; ?> </p>
            <p><?php echo $row[3]; ?> </p>
            <p><?php echo $row[4]; ?> </p>
            <?php
            $id = $row['id'];
            echo "<a href='forum_temat.php?id=$id'>Przejdź do tematu</a>";
            session_start();
            $user = $_SESSION['user'];
            if($user == "admin" and isset($_SESSION['loggedin'])) {
                echo "<a href='usun_temat_adm.php?id=$row[0]'><img style='width: 3%' src='https://cdn-icons-png.flaticon.com/512/39/39220.png'></a><br>";
            }else{
                echo "";
            }?>

        </div>
        <?php } ?>
        <br><a href="logout.php">Wyloguj</a><br> <!-- link z przekirowaniem do pliku "logout.php" -->
    </section>
</main>

</body>
</html>