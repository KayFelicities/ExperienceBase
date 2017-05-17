<!DOCTYPE HTML>
<html>
<meta name="renderer" content="webkit"> 
<meta charset="UTF-8">
<title>经验分享平台</title>
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
else
{
  $userinfo = get_userinfo($_COOKIE["userid"]);
?>
  <header>
    <h3><i></i>我的消息<small></small></h3>
  </header>
  <hr>
  <p>并没有消息╮(╯_╰)╭</p>

<?php }?>
</div>
</body>

</html>