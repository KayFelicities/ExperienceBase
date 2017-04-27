<!DOCTYPE HTML>
<html>
<meta charset="UTF-8">
<link rel="stylesheet" href="style/css/smoke.css">
<script src="style/js/jquery.js"></script>
<script src="style/js/bootstrap.js"></script>
<script src="style/js/smoke.js"></script>
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

$result = mysqli_query($con, "SELECT * FROM eb_users WHERE username='$username'");
$row = mysqli_fetch_array($result);
if ($row['password'] == $password)
{
    setcookie("userid", $row['uid'], time()+24*60*60);
    echo ("欢迎您，".$row['nickname']);
    header("Refresh: 1; url=index.php");
}
else
{
    echo "<script>alert('用户名或密码错误');window.location.href='login.php'</script>";
}
mysqli_close($con);
?>

</body>
</html>
