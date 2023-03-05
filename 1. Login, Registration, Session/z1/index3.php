<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="pl" lang="pl">
<head>
 <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
</head>
<BODY>
Formularz logowania
<form method="post" action="weryfikuj3.php"> <!-- formularz, metoda "post" wysyła dane do pliku "weryfikuj3.php" -->
 Login:<input type="text" name="user" maxlength="20" size="20"><br> <!-- utworzenie pola tekstowego typ_pola="text", nazwa_pola="user", maksymalna_dlugosc_znakow="20", wielkość_liter="20"  -->
 Hasło:<input type="password" name="pass" maxlength="20" size="20"><br> <!-- utworzenie pola tekstowego typ_pola="password", nazwa_pola="pass", maksymalna_dlugosc_znakow="20", wielkość_liter="20"  -->
 <input type="submit" value="Send"/> <!-- przycisk wysyłania formularza -->
</form>
</BODY>
</HTML>