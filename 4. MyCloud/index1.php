<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="pl" lang="pl">
<head>
 <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
</head>
<BODY>


<?php
$conn = mysqli_connect('localhost','nazwa_usera','hasło_usera','baza_usera'); //połączenie z bazą danych
mysqli_query($conn, "SET NAMES 'utf8'"); // ustawienie polskich znaków
$rows = mysqli_query($conn, "SELECT * FROM users");

session_start();
if(isset($_SESSION['user'])){
    $target_dir = $_SESSION['user'];
}
?>

<form id="form" action="add1.php" method="post" autocomplete="off" enctype="multipart/form-data">
        <label for="name">Name : </label>
        <input type="text" name="name" id = "name" required value="<?php echo $target_dir ?>" readonly> <br>
        <label for="post">Post : </label>
        <input type="text" name="post" id ="post" value=""> <br>
    <label for="image">Image : </label>
        <input type="file" name="image" id = "image" accept=".jpg, .jpeg, .gif, .mp3, .mp4" value=""> <br> <br>
    <label for="recipient">Adresat:</label>
        <select id="recipient" name="recipient">
            <?php while($r = $rows -> fetch_array()){ ?>
                <option value="<?php echo $r[1];?>"</option>
                <?php echo $r[1];?>
                <?php
            }
            ?>
        </select>
        <button type = "submit" name = "submit">Submit</button>
</form>
<?php

$dbhost="localhost"; $dbuser="nazwa_usera"; $dbpassword="hasło_usera"; $dbname="baza_usera";
$connection = mysqli_connect($dbhost, $dbuser, $dbpassword, $dbname);
//bład bazy danych
if (!$connection)
{
echo " MySQL Connection error." . PHP_EOL;
echo "Errno: " . mysqli_connect_errno() . PHP_EOL;
echo "Error: " . mysqli_connect_error() . PHP_EOL;
exit;
}

//połączenie z bazą danych
$result = mysqli_query($connection, "Select * from messages Order by id Desc") or die ("DB error: $dbname");
//wyświetlenie tabelki z wynikami z bazy danych
?>
<div id="load_mes">
<table  border = 1 cellspacing = 0 cellpadding = 10>
<TR>
    <TD>ID</TD>
    <TD>Date/Time</TD>
    <TD>User</TD>
    <TD>Recipient</TD>
    <TD>Post</TD>
    <TD>File</TD>
</TR>


<?php

session_start();

while ($row = mysqli_fetch_array ($result)){




    if(((($row[5] == $_SESSION['user']) or ($row[4] == $_SESSION['user'])) and $_SESSION['user'] != 'admin')){
        if (mime_content_type($row[3]) != ('directory') or $row[2] != ""){?>
    <tr>
        <td><?php echo $row[0]; ?></td>
        <td><?php echo $row[1]; ?></td>
        <td><?php echo $row[4]; ?></td>
        <td><?php echo $row[5]; ?></td>
        <td><?php echo $row[2]; ?></td>
        <td><?php

            if((mime_content_type($row[3])) == ('directory')){
                echo " ";
             }
            else{
            if(mime_content_type($row[3]) == ('audio/mpeg')){?>
                <audio controls autoplay muted src="<?php echo $row[3];?>"</audio>
            <?php }

            if(mime_content_type($row[3]) == ('video/mp4')){ ?>
                <video controls autoplay muted width="250" src="<?php echo $row[3]; ?>"</video>
            <?php }
            if(mime_content_type($row[3]) == ('image/jpeg' or 'image/jpg' or 'image/png' or 'image/gif')){?>
                <img src="<?php echo $row[3]; ?>"/>
            <?php }
            }
            ?>


        </td>
    </tr>
        <?php
        }
    }
    if ($_SESSION['user'] == 'admin' and ((mime_content_type($row[3]) != ('directory')) or $row[2] != "" )){ ?>
        <tr>
            <td><?php echo $row[0]; ?></td>
            <td><?php echo $row[1]; ?></td>
            <td><?php echo $row[4]; ?></td>
            <td><?php echo $row[5]; ?></td>
            <td><?php echo $row[2]; ?></td>
            <td><?php
                if(mime_content_type($row[3]) == ('directory')){
                    echo " ";
                }
                else{
                    if(mime_content_type($row[3]) == ('audio/mpeg')){?>
                        <audio controls autoplay muted src="<?php echo $row[3];?>"</audio>
                    <?php }

                    if(mime_content_type($row[3]) == ('video/mp4')){ ?>
                        <video controls autoplay muted width="250" src="<?php echo $row[3]; ?>"</video>
                    <?php }
                    if(mime_content_type($row[3]) == ('image/jpeg' or 'image/jpg' or 'image/png' or 'image/gif')){?>
                        <img src="<?php echo $row[3]; ?>"/>
                    <?php }
                }
                ?>
            </td>

        </tr>
        <?php
    }


}
?>
</table>
</div>
<?php
mysqli_close($connection);

?>
</BODY>
</HTML>
<script type="text/javascript">
    $(document).ready(function (){
        $("#submit").on("click", function (){
            $.ajax({ //funkcja ajax (dane wysyłane do serwera)
                url: 'add1.php', //adres URL na który wysyłane jest żądanie
                type: 'post', //metoda jąką wysyłane są dane
                data:{
                    name: $("#name"),
                    post: $("#post"),
                    image: $("#image"),
                    recipient: $("#recipient")
                },
                dataType: "text",
                success:function (data){

                }
            });
        });
        setInterval(function (){
            $("#load_mes").load("index1.php").fadeIn("slow");
        }, 1000);

    });

</script>
