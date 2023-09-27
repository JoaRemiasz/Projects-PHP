<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="pl" lang="pl">
<HEAD>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
</HEAD>
<BODY>

<?php
function removeDir($path) {
    $dir = new DirectoryIterator($path);
    foreach ($dir as $fileinfo) {
        if ($fileinfo->isFile() || $fileinfo->isLink()) {
            unlink($fileinfo->getPathName());
        } elseif (!$fileinfo->isDot() && $fileinfo->isDir()) {
            removeDir($fileinfo->getPathName());
        }
    }
    rmdir($path);
}

session_start();
$user = $_SESSION['user'];
$dd = $_GET['dir'];
$dir = $_SESSION['dir'];
$d = $dir . "/" . $dd;


if(mime_content_type($d) == ('image/jpeg' or 'audio/mpeg' or 'video/mp4' or 'image/jpg' or 'image/png' or 'image/gif')){
    unlink($d);
}
if(mime_content_type($d) == 'directory'){
    removeDir($d);

}
header("Location: katalog.php");
?>
</BODY>
</html>
