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
<?php include("common.php"); echo_banner("myconfig"); ?>
<div style="margin: 60px"></div>
<div class="container">
<?php if (!isset($_COOKIE["userid"])){echo "请<a href='login.php'>登录</a>";}else{?>
  <header>
    <h3><i></i>个人设置<small></small></h3>
  </header>
  <hr>
  <form method="post" action="myconfig_action.php">
    <a class="btn btn-default" href="img_select.php?type=avatar&uid=<?php echo $_COOKIE["userid"];?>">更改头像</a>
  </form>
<?php }?>
</div>

<?php echo_webfooter(); ?>
</body>

</html>