<!DOCTYPE HTML>
<html>
<meta charset="UTF-8">
<title>经验分享平台</title>
<link rel="bookmark" type="image/x-icon" href="img/+1.ico" />
<link rel="shortcut icon" href="img/+1.ico">
<link rel="icon" href="img/+1.ico">
<link rel="stylesheet" href="style/css/bootstrap.css">
<link rel="stylesheet" href="style/css/carousel.css">
<script src="style/js/jquery.js"></script>
<script src="style/js/bootstrap.js"></script>

<body>
<?php include("common.php"); echo_banner("mymessages"); ?>
<div style="margin: 60px"></div>
<div class="container">
  <p>欢迎您，<?php if (isset($_COOKIE["userid"]))echo get_userinfo($_COOKIE["userid"])['nickname'];else echo "游客";?></p>
</div>

</body>

</html>