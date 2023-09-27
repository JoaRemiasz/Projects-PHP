<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="pl" lang="pl">
<head>
 <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<style>
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
	</style>
</head>

<BODY>
<?php
session_start(); //uruchomienie sesji
?>
Formularz rejestracji
<form method="post" action="add.php"> <!-- formularz metoda "post" wysyła dane do pliku "add.php" -->
 Login:<input type="text" name="user" maxlength="20" size="20"><br> <!-- utworzenie pola tekstowego typ_pola="text", nazwa_pola="user", maksymalna_dlugosc_znakow="20", wielkość_liter="20"  -->
		<?php
			if (isset($_SESSION['error_user'])) //jeśli sesja "error_user" została uruchomiona
            {

                echo '<div class="error">' . $_SESSION['error_user'] . '</div>'; // wyświetlenie zawartości zmiennej sesji "error_user" używając klasy "error"

            }
		?>
 Hasło:<input type="password" name="pass" maxlength="20" size="20"><br> <!-- utworzenie pola tekstowego typ_pola="password", nazwa_pola="pass", maksymalna_dlugosc_znakow="20", wielkość_liter="20"  -->
 Powtórz hasło:<input type="password" name="pass1" maxlength="20" size="20"><br> <!-- utworzenie pola tekstowego typ_pola="password", nazwa_pola="pass1", maksymalna_dlugosc_znakow="20", wielkość_liter="20"  -->
     	<?php
			if (isset($_SESSION['error_pass'])) //jeśli sesja "error_pass" została uruchomiona
			{
				echo '<div class="error">'.$_SESSION['error_pass'].'</div>'; // wyświetlenie zawartości zmiennej sesji "error_pass" używając klasy "error"
				unset($_SESSION['error_pass']); //wyczyszczenie sesji "error_user"
			}
		?>	
<input type="submit" value="Send"/> <!-- przycisk wysyłania formularza -->
		<?php
			if (isset($_SESSION['reservation'])) //jeśli sesja "reservation" została uruchomiona
			{
				echo '<div class="success">'.$_SESSION['reservation'].'</div>'; // wyświetlenie zawartości zmiennej sesji "reservation" używając klasy "success"
                echo '<a href="index3.php">Zaloguj się</a>'; //wyświetlenie linku z przejściem do pliku "index3.php"
				unset($_SESSION['reservation']); //wyczyszczenie sesji "reservation"
			}
		?>
	    <?php
			if (isset($_SESSION['error_reservation'])) //jeśli sesja "error_reservation" została uruchomiona
			{
				echo '<div class="error">'.$_SESSION['error_reservation'].'</div>'; // wyświetlenie zawartości zmiennej sesji "error_reservation" używając klasy "error"
				unset($_SESSION['error_reservation']); //wyczyszczenie sesji "error_reservation"
			}
		?>
</form>

</BODY>
</HTML>