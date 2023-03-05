<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="pl" lang="pl">
<head>
 <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
</head>
<BODY>
<h3> Menu </h3>


 <script type="text/javascript">
 let date = new Date().toJSON(); //przypisanie do zmiennej lokalnej "date" aktualniej daty oraz godziny
 let height = window.innerHeight; //przypisanie do zmiennej lokalnej "height" wysokości okna przeglądarki internetowej
 let width = window.innerWidth; //przypisanie do zmiennej lokalnej "width" szerokości okna przeglądarki internetowej
 let java = navigator.javaEnabled(); //przypisanie do zmiennej lokalnej "java" informacji o języku używanym przez gościa odwiedzającego stronę

 
      $.getJSON('http://ip-api.com/json', function(ip){ //użycie getJSON do załadowania danych z serwera
        var data = {
          ip: ip.query, //zakodowanie ip gościa odwiedzającego stronę
          browser: navigator.userAgent, //zakodowanie informacji o przeglądarce gościa odwiedzającego stronę
          date: date, // zakodowanie aktualnej daty gośćia odwiedzającego stronę
          height: screen.height, //zakodowanie wysokości ekranu gościa odwiedzającego stronę
          width: screen.width, //zakodowanie szerokości ekranu gościa odwiedzającego stronę
          wheight: height, //zakodowanie wysokości okna przeglądarki gościa odwiedzającego stronę
          wwidth: width, //zakodowanie szerokości ekranu gościa odwiedzającego stronę
          color: screen.colorDepth, //zakodowanie ilości kolorów ekranu gościa odwiedzającego stronę
          cookies: navigator.cookieEnabled, //zakodowanie zezwolenia na zapis ciasteczek w przeglądarce gościa odwiedzającego stronę
          java: java, //zakodowanie zezwolenia na uruchamianie apletów Javy w przeglądarce gościa odwiedzającego stronę
          language: navigator.language //zakodowanie informacji o języku przeglądarki gościa odwiedzającego stronę
          
        };

        $.ajax({ //funkcja ajax (dane wysyłane do serwera)
          url: 'index.php', //adres URL na który wysyłane jest żądanie
          type: 'post', //metoda jąką wysyłane są dane
          data: data //obiekt który jest wysyłany
        })
      })
    </script>

<?php 
session_start(); // zapewnia dostęp do zmienny sesyjnych w danym pliku (uruchomienie sesji)
if (!isset($_SESSION['loggedin'])) //jeśli sesja "loggedin" nie została uruchomiona
{
header('Location: logowanie.php'); //przejście do pliku "logowanie.php"
exit(); //kończy skrypt
}

$conn = mysqli_connect('localhost','nazwa_usera','hasło_usera','baza_usera'); //połączenie z bazą dancyh 
mysqli_query($conn, "SET NAMES 'utf8'");// ustawienie polskich znaków
if(isset($_POST["ip"])){ //jeśli został znaleziony adres ip to do zmiennych są przypisane dane, które są pobrane za pomocą metody "post"
  $ip = $_POST["ip"]; 
  $browser = $_POST["browser"];
  $date = $_POST["date"];
  $h = $_POST["height"] . "x" . $_POST["width"];
$w = $_POST["wheight"] . "x" . $_POST["wwidth"];
  $color = $_POST["color"];
  $cookies = $_POST["cookies"];
  $java = $_POST["java"];
  $language = $_POST["language"];


//zapisanie do bazy danych wszystkich danych gościa odwiedzającego stronę
  $query =  mysqli_query($conn, "INSERT INTO goscieportalu VALUES ('','$ip', '$date', '$browser', '$h', '$w','$color','$cookies','$java','$language')");
  mysqli_query($conn, $query);
}
?>
<br><a href="data.php">Odwiedzający stronę</a>
<br><a href="logout.php">Wyloguj</a><br> <!-- link z przekirowaniem do pliku "logout.php" -->
</BODY>
</HTML>