<!DOCTYPE HTML>
<html>
<meta charset="UTF-8">
<title>经验分享平台</title>
<link rel="bookmark" type="image/x-icon" href="+1.ico" />
<link rel="shortcut icon" href="+1.ico">
<link rel="icon" href="+1.ico">
<link rel="stylesheet" href="style/css/bootstrap.css">
<link rel="stylesheet" href="style/css/carousel.css">
<script src="style/js/jquery.js"></script>
<script src="style/js/bootstrap.js"></script>
<script>
function delCookie(name) {
  var d = new Date();
  d.setTime(d.getTime() - 1);
  var expires = "expires="+d.toUTCString();
  document.cookie = name + "=" + "" + "; " + expires;
}
</script>

<body>
<?php include("common.php"); echo_banner("mypage"); ?>
<div style="margin: 60px"></div>
<div class="container">
  <button class="btn btn-danger" onclick="delCookie('user');window.location.href='index.php';">退出登录</button>
</div>

</body>

</html>