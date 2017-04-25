<meta charset="UTF-8">
<?php
if(PHP_VERSION >= 6 || !get_magic_quotes_gpc())
{
    $_POST = array_map( 'addslashes', $_POST);
}



$content=$_POST["editor"];
$remote_ip = $_SERVER["REMOTE_ADDR"];
$timenow = date("Y-m-d H:i:s");
$author_id = 0;
if (!empty($_COOKIE["uid"]))
{
    $author_id = $_COOKIE["uid"];
}

require_once('config.php');
$con=mysqli_connect(HOST, USERNAME, PASSWORD);
mysqli_set_charset($con, "utf8");
mysqli_select_db($con, 'experience_base');
$insertsql= "UPDATE eb_others 
            SET content='$content',modify_user='$author_id',modify_ip='$remote_ip',modify_tm='$timenow'
            WHERE name='about'";

if(mysqli_query($con, $insertsql))
{
    echo "<script>window.location.href='about.php'</script>";
}
else
{
    echo mysqli_error($con);
}
mysqli_close($con);
?>