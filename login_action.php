<!DOCTYPE HTML>
<html>
<meta charset="UTF-8">
<body>
<?php
if(PHP_VERSION >= 6 || !get_magic_quotes_gpc()) 
{
    $_POST = array_map( 'addslashes', $_POST);
}

$username=$_POST["username"];
$password=$_POST['password'];
$remote_ip = $_SERVER["REMOTE_ADDR"];
$timenow = date('Y-m-d H:i:s');

require_once('config.php');
$con=mysqli_connect(HOST, USERNAME, PASSWORD);
mysqli_set_charset($con, "utf8");
mysqli_select_db($con, 'experience_base');

print_r($username);
$result = mysqli_query($con, "SELECT * FROM eb_users WHERE username='$username'");
$row = mysqli_fetch_array($result);
if ($row['password'] == $password)
{
    setcookie("user", $username, time()+3600);
    echo "<script>alert('欢迎您，$username');window.location.href='index.php'</script>";
}
else
{
    echo "<script>alert('用户名或密码错误');window.location.href='login.php'</script>";
}
mysqli_close($con);
?>

</body>
</html>
