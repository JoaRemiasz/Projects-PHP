<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="pl" lang="pl">
<HEAD>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
</HEAD>
<a href="create.php"><img style="width: 35px" style="height:35px" src="icon/createIcon.jpg"></a>
<a href="select.php"><img style="width: 35px" style="height:35px" src="icon/upload.jpg"></a>

<BODY>


 <table class="table">
  <thead>
    <tr>
      <th scope="col">Directory Name</th>
      <th scope="col">Size</th>
        <th></th>
    </tr>
  </thead>
  <tbody>
  <?php
        // simple security - do not allow the file browser to get out of this root directory
        // SET THIS FOR YOUR SYSTEM
  session_start();
        $user = $_SESSION['user'];
        $rootDirectory = '/z4/' . $user;


        if ($_GET && $_GET['dir']) $dir = $rootDirectory . $_GET['dir'];
        else $dir = $rootDirectory;
        $dir = realpath($dir) ;

          if (strpos($dir, $rootDirectory) === false ) $dir = $rootDirectory ;
        if (strpos($dir, $rootDirectory) !== 0 ) $dir = $rootDirectory ;
        $folders= new DirectoryIterator($dir);

        session_start();
        $_SESSION['dir'] = $dir;

        if(isset($_GET['dir'])){?>
    <a href="undo.php"><img style="width: 35px" style="height:35px" src="icon/cof.jpg"></a>
<?php
        }


        while($folders->valid()){

            $myPath = str_replace($rootDirectory, '', $folders->getPath()) . "/" . $folders->current();
            $myItem = "<a href='".$_SERVER['PHP_SELF']."?dir={$myPath}'>{$folders->current()}</a>" ;

            if ($folders->isFile()) $myItem = $folders->current();
    ?>
<tr>
    <td><?php if($folders != "." and $folders != ".."){
        echo $myItem; } ?></td>
    <td><?php if($folders != "." and $folders != ".."){
        echo $folders->getSize();}?></td>
    <td><?php if($folders != "." and $folders != "..") {
        echo "<a href='$folders'></a><a href='delete.php?dir=$folders'><img style='width: 35px' style='height:35px' src='icon/del.png'></a>";
        } ?>
    </td>
    <td><?php if($folders != "." and $folders != "..") {
            echo "<a href='$folders'></a><a href='download.php?dir=$folders'><img style='width: 35px' style='height:35px' src='icon/pob.jpg'></a>";
        } ?>
    </td>
</tr>
<?php
$folders->next();
} ?>
</tbody>
</table>



</BODY>
</HTML>