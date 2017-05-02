<!DOCTYPE HTML>
<html>
<meta charset="UTF-8">
<title>经验分享平台</title>
<link rel="bookmark" type="image/x-icon" href="img/+1.ico" />
<link rel="shortcut icon" href="img/+1.ico">
<link rel="icon" href="img/+1.ico">
<link rel="stylesheet" href="style/css/bootstrap.css">
<script src="style/js/jquery.js"></script>
<script src="style/js/bootstrap.js"></script>

<style> 
.col-display
{
-moz-column-count:2; /* Firefox */
-webkit-column-count:2; /* Safari and Chrome */
column-count:2;
}
</style>

<body>
<?php include("common.php"); echo_banner("mypage"); ?>
<div style="margin: 60px"></div>
<div class="container">
<?php if (!isset($_COOKIE["userid"])){echo "请<a href='login.php'>登录</a>";}
else
{
  $userinfo = get_userinfo($_COOKIE["userid"]);
?>
  <header>
    <h3><i></i> <?php echo $userinfo['nickname'];?> <small>个人主页</small></h3>
  </header>
  <hr>

  <div class="panel panel-default">
    <div class="panel-heading">
      <h3 class="panel-title">我的资料
        <small><button id="edit-btn" class="btn btn-default btn-xs pull-right">修改</button></small>
      </h3>
    </div>
    <div class="panel-body col-display">
      <p>用户名：<?php echo $userinfo['username'];?> </p>
      <p>姓名：<?php echo $userinfo['nickname'];?> </p>
      <p>工号：<?php echo $userinfo['sx_id'];?> </p>
      <p>部门：<?php echo $userinfo['department'];?> </p>
    </div>
  </div>
  
  <div class="panel panel-default">
    <div class="panel-heading">
      <h3 class="panel-title">我的关注</h3>
    </div>
    <div class="panel-body col-display">

    </div>
  </div>
  
  <div class="panel panel-default">
    <div class="panel-heading">
      <h3 class="panel-title">我发表的经验</h3>
    </div>
    <div class="panel-body col-display">

    </div>
  </div>

<?php }?>
</div>

</body>

</html>