<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="pl" lang="pl">
<HEAD>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
</HEAD>
<BODY>

<?php
session_start();
$user = $_SESSION['user'];
$dd = $_GET['dir'];
$dir = $_SESSION['dir'];
$d = $dir . "/" . $dd;

if(!empty($_GET['dir']))
{
    $filename = basename($_GET['dir']);
    $filepath = $dir . "/" . $filename;

    if(!empty($filename) && file_exists($filepath)){

//Define Headers
        header("Cache-Control: public");
        header("Content-Disposition: attachment; filename=$filename");
        header("Content-Transfer-Emcoding: binary");
        header("Content-Type: image/jpeg");
        readfile($filepath);
        exit;

    }
    else{
        echo "This File Does not exist.";
    }
}
header("Location: katalog.php");
?>
</BODY>
</html>
