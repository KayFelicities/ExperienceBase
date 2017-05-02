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
<?php 
  $userinfo = get_userinfo($_GET['u']);
  if ($userinfo)
  {
?>
  <header>
    <h3><i></i><?php echo $userinfo['nickname'];?><small></small></h3>
  </header>
  <hr>

  <div class="col-xs-3">
    <img class="avatar-xxxl" src="<?php echo get_avatar($_GET['u'])?>" />
    <h3><?php echo $userinfo['nickname'];?> </h3>
    <h5><?php echo $userinfo['department'];?> </h5>
  </div>

  <div class="col-xs-9">
    <div class="panel panel-default">
      <div class="panel-heading">
        <h3 class="panel-title">关注的内容</h3>
      </div>
      <div class="panel-body col-display">

      </div>
    </div>
    
    <div class="panel panel-default">
      <div class="panel-heading">
        <h3 class="panel-title">发表的经验</h3>
      </div>
      <div class="panel-body col-display">

      </div>
    </div>
  </div>

<?php
  }
  else
  {
    echo "未查找到该用户";
  }
?>

</div>

</body>

</html>