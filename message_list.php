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


<body>
<?php include("common.php"); echo_banner("mymessages"); ?>
<div style="margin: 60px"></div>
<div class="container">
<?php if (!isset($_COOKIE["userid"])){echo "请<a href='login.php'>登录</a>";}
else if (isset($_GET["t"]))
{
  $login_id = $_COOKIE["userid"];
  $userinfo = get_userinfo($login_id);
  $timenow = date("Y-m-d H:i:s");

  $con=mysqli_connect(HOST, USERNAME, PASSWORD);
  mysqli_set_charset($con, "utf8");
  mysqli_select_db($con, 'experience_base');
  mysqli_query($con, "UPDATE eb_users SET unread_num='0',last_read_tm='$timenow' WHERE uid='$login_id'");
  mysqli_close($con);

  if ($_GET["t"] == "mymessage")
  {?>
    <header>
      <h3><i></i>我的消息<small></small></h3>
    </header>
    <hr>
    <div class="panel panel-default">
      <div class="panel-heading">
        <h3 class="panel-title">
          回复我的
        </h3>
      </div>
      <div class="panel-body">
        <?php
        for ($count=0; $count < 100; $count++)
        {
          if (!echo_reply_me($login_id, $count, 1))
          {
            break;
          }
        }
        if ($count==0)
        {
          echo "无";
        }
        ?>
      </div>
    </div>
<?php
  }
}
else
{
    echo '<script>location.href="404.php"</script>';
}
?>

<?php echo_webfooter(); ?>
</body>

</html>