
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="pl" lang="pl">
<HEAD>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
</HEAD>
<BODY>
<?php
session_start();
$dir = "/z4/" . $_SESSION['user'] . "/" . $_POST['name'];
mkdir("$dir", 0777);
header("Location:katalog.php");
?>
</BODY>
</html>

