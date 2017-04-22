<meta charset="UTF-8">
<?php
if(PHP_VERSION >= 6 || !get_magic_quotes_gpc()) 
{
    $_POST = array_map( 'addslashes', $_POST);
}


$title=$_POST["title"];
$editor=$_POST["editor"];
$extype1=$_POST["extype1"];
$extype2=$_POST["extype2"];
$tags=$_POST["tags"];
$remote_ip = $_SERVER["REMOTE_ADDR"];
$timenow = date("Y-m-d H:i:s");
$author = "guest";
if (!empty($_COOKIE["user"]))
{
    $author = $_COOKIE["user"];
}

require_once('config.php');
$con=mysqli_connect(HOST, USERNAME, PASSWORD);
mysqli_set_charset($con, "utf8");
mysqli_select_db($con, 'experience_base');
$insertsql= "INSERT INTO eb_contents(title, create_tm, author, content, extype1, extype2, tags, create_ip)
             VALUES('$title', '$timenow', '$author', '$editor', '$extype1', '$extype2', '$tags', '$remote_ip')";

if(!(mysqli_query($con, $insertsql)))
{
    echo mysqli_error($con);
}
else
{
    echo "<script>alert('提交成功');window.location.href='index.php'</script>";
}
mysqli_close($con);
?>