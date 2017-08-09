<!DOCTYPE HTML>
<html>
<meta name="renderer" content="webkit"> 
<meta charset="UTF-8">
<title>经验共享平台</title>
<link rel="bookmark" type="image/x-icon" href="img/+1.ico" />
<link rel="shortcut icon" href="img/+1.ico">
<link rel="icon" href="img/+1.ico">
<link rel="stylesheet" href="style/css/bootstrap.css">
<script src="style/js/jquery.js"></script>
<script src="style/js/bootstrap.js"></script>

<!--notify-->
<link rel="stylesheet" href="style/css/animate.css">
<script src="style/js/bootstrap-notify.js"></script>

<body>
  <div class="container" style="width: 60%; margin-top: 20px;">
<?php
if(PHP_VERSION >= 6 || !get_magic_quotes_gpc()) 
{
    $_POST = array_map( 'addslashes', $_POST);
}

$username=$_POST["username"];
$password=$_POST['password'];
$nickname=$_POST['nickname'];
$lasturl=$_POST['lasturl'];
$sx_id=$_POST['sx_id'];
$department=$_POST['department1'].','.$_POST['department2'];
$remote_ip = $_SERVER["REMOTE_ADDR"];
$timenow = date('Y-m-d H:i:s');

require_once('config.php');
$con=mysqli_connect(HOST, USERNAME, PASSWORD);
mysqli_set_charset($con, "utf8");
mysqli_select_db($con, 'experience_base');

$result = mysqli_query($con, "SELECT nickname FROM eb_signup WHERE sx_id='$sx_id'");
$row = mysqli_fetch_array($result);
if (!$row)
{?>
    <div class="alert alert-danger" role="alert"><p>注册失败: 抱歉，您提供的工号无注册权限！</p></div>
    <a class="btn btn-primary pull-right" href="login.php?lu=<?php echo $lasturl; ?>">确定</a>
<?php
}
elseif ($row['nickname'] != $nickname)
{?>
    <div class="alert alert-danger" role="alert"><p>注册失败: 您提供的工号与姓名不匹配！</p></div>
    <a class="btn btn-primary pull-right" href="login.php?lu=<?php echo $lasturl; ?>">确定</a>
<?php
}
else
{
  $result = mysqli_query($con, "SELECT username FROM eb_users WHERE username='$username'");
  $row = mysqli_fetch_array($result);
  if ($row)
  {?>
      <div class="alert alert-danger" role="alert"><p>注册失败: 该账户已被注册，请登录！</p></div>
      <a class="btn btn-primary pull-right" href="login.php?lu=<?php echo $lasturl; ?>">确定</a>
<?php
  }
  else
  {
    $insertsql= "INSERT INTO eb_users(username, password, nickname, sx_id, create_tm, create_ip, department)
                VALUES('$username', '$password', '$nickname', '$sx_id', '$timenow', '$remote_ip', '$department')";

    if(!(mysqli_query($con, $insertsql)))
    {?>
        <div class="alert alert-danger" role="alert"><p>注册失败: <?php echo mysqli_error($con);?></p></div>
        <a class="btn btn-primary pull-right" href="login.php?lu=<?php echo $lasturl; ?>">确定</a>
  <?php
    }
    else
    {?>
        <div class="alert alert-success" role="alert"><p>注册成功，请登录</p></div>
        <a class="btn btn-primary pull-right" href="login.php?lu=<?php echo $lasturl; ?>">确定</a>
  <?php
    }
  }
}
mysqli_close($con);
?>
</div>
</body>
</html>