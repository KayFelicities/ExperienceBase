<meta charset="UTF-8">
<?php
if(PHP_VERSION >= 6 || !get_magic_quotes_gpc()) 
{
    $_POST = array_map( 'addslashes', $_POST);
}

$username=$_POST["username"];
$password=$_POST['password'];
$nickname=$_POST['nickname'];
$sx_id=$_POST['sx_id'];
$department=$_POST['department1'].','.$_POST['department2'];
$remote_ip = $_SERVER["REMOTE_ADDR"];
$timenow = date('Y-m-d H:i:s');

require_once('config.php');
$con=mysqli_connect(HOST, USERNAME, PASSWORD);
mysqli_set_charset($con, "utf8");
mysqli_select_db($con, 'experience_base');
$insertsql= "INSERT INTO eb_users(username, password, nickname, sx_id, create_tm, create_ip, department)
             VALUES('$username', '$password', '$nickname', '$sx_id', '$timenow', '$remote_ip', '$department')";

if(!(mysqli_query($con, $insertsql)))
{
    echo mysqli_error($con);
}
else
{
    echo "<script>alert('注册成功，请登录');window.location.href='login.php'</script>";
}
mysqli_close($con);
?>