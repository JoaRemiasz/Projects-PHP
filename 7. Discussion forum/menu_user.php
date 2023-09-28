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
    session_start();
    $user = $_SESSION['user'];
    if($user == "admin"){?>
        <h1>MENU ADMINA</h1>
    <?php }else{?>
        <h1>MENU UŻYKOWNIKA</h1>
    <?php } ?>
</header>
<nav>
    <ul><?php
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
    <section>
        <h3>Wizyty użytkowników na protalu.</h3> <!-- nagłówek na stronie -->
        <div class="thread">
<form method="post"> <!-- formularz, metoda "post" -->
    <table border = 1 class="table"> <!-- utworzenie tabelki, ustawienie obramowania tabelki 'border' -->
        <tr> <!-- utworzenie pierwszego wiersza tabelki -->
            <!-- przypisanie komórek tabeli 'td' -->
            <td>Data</td>
            <th>Adres IP</th>
            <th>Lokalizacja</th>
            <th>Współrzędne</th>
            <th>Mapy Google'a</th>
            <th>Użytkownik</th>
        </tr>

        <?php
        $conn = mysqli_connect('localhost', 'nazwa_usera', 'hasło_usera', 'baza_usera'); //połączenie z bazą danych
        mysqli_query($conn, "SET NAMES 'utf8'"); // ustawienie polskich znaków
        $rows = mysqli_query($conn, "SELECT * FROM goscieportalu"); //przypisanie do zmiennej $rows wszystkich wyników z tabelki w bazie "goscieporatlu"
        ?>

        <?php

        //użycie skryptu umożliwiającego przybliżoną geolokalizację, skrypt utworzony w oparciu o format JSON
        function ip_details($ip) {
            $json = file_get_contents ("https://www.iplocate.io/api/lookup/{$ip}");
            $details = json_decode ($json);
            return $details;
        }
        //użycie skryptu umożliwiającego przybliżoną geolokalizację, skrypt utworzony w oparciu o format JSON


        while($r = $rows -> fetch_array()){
            //wyświetlenie za pomocą "while" wszystkich wierszy z bazy danych "gościeporatlu"
            //przypisanie do zmiennej "details", ip z bazy danych gości odwiedzających stronę
            //aby móc wyświetlić dane geolokalizacyjne za pomocą funkcji "ip_details"

            $details = ip_details($r[1]);
            ?>
            <tr> <!-- utworzenie wiersza tabelki -->
                <td><?php echo $r[2] ?></td> <!-- przypisanie do pierwszej komórki wiersza datę z bazy danych -->
                <td><?php echo $details -> ip; ?></td> <!-- przypisanie do drugiej komórki wiersza ip gościa odwiedzającego stronę -->
                <td><?php echo $details -> country_code. ', '; ?> <!-- przypisanie do trzeciej komórki wiersza kraju, regionu oraz miasta uzyskanych z ip gościa  -->
                    <?php echo $details -> country . ', '; ?>
                    <br><?php echo  $details -> city ;?></br>
                </td>
                <td><?php echo $details -> latitude . "," .
                        $details -> longitude
                    ;?></td> <!-- przypisanie do czwartej komórki wiersza współrzędnych lokalizacyjnych gościa-->
                <td><?php $loc = $details -> ip ?>
                    <a href='https://www.google.pl/maps/place/$loc'>LINK</a> <!-- przypisanie do piątej komórki wiersza linku z lokazlizacją gościa -->
                </td>
                <td style="width: 200px;"><!-- ustawienie możliwej szerokości dla danej komórki wiersza -->
                    <?php  echo $r[3]?> <!-- przypisanie do szóstej komórki wiersza informacji o przeglądarce używanej przez gościa z bazy danych-->
                </td>

            </tr>
        <?php  } ?>
    </table>
</form>
        </div>
        <br><a href="logout.php">Wyloguj</a><br> <!-- link z przekirowaniem do pliku "logout.php" -->
    </section>
</main>



</BODY>
</HTML>