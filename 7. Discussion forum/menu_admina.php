<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="pl" lang="pl">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" http-equiv="refresh">
    <style>
        table, table * {border: 1px solid black}
    </style>
    <script src = "https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js">
    </script>
</head>
<BODY>
<h1>MENU ADMINA</h1>
<h3>Wizyty użytkowników na protalu.</h3> <!-- nagłówek na stronie -->
<a href="forum.php">Forum dyskusyjne.</a><br>

<form method="post"> <!-- formularz, metoda "post" -->
    <table border = 1> <!-- utworzenie tabelki, ustawienie obramowania tabelki 'border' -->
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

<br><a href="logout.php">Wyloguj</a><br> <!-- link z przekirowaniem do pliku "logout.php" -->


</BODY>
</HTML>