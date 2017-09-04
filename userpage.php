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
$userid = 0;
if (isset($_GET['u']))$userid = $_GET['u'];
if ($userid == '0' and !isset($_COOKIE["userid"])){echo "请<a href='login.php'>登录</a>";}
else
{
  $userid = $userid != '0' ? $userid : $_COOKIE["userid"];
  $userinfo = get_userinfo($userid);
  $sxinfo = get_sxinfo($userinfo['sx_id']);
  $unit = 'sx';
  if ($sxinfo)
  {
    $unit = $sxinfo['unit1'];
    if ($sxinfo['unit2']) $unit .= '，' . $sxinfo['unit2'];
  }
  if ($userinfo)
  {
?>
    <header>
      <h3><i></i>个人主页<small></small></h3>
    </header>
    <hr>

    <div class="col-xs-3">
      <img class="avatar-xxxl" src="<?php echo get_avatar($userid);?>" />
      <h3><?php echo $userinfo['nickname'];?> </h3>
      <h5><?php echo $unit;?> </h5>
    </div>

    <div class="col-xs-9">

      <div class="panel panel-default">
        <div class="panel-heading">
          <h3 class="panel-title">
            收藏的文章(共0篇)
            <span class="pull-right">
              <a href="##" class="btn btn-xs btn-default">更多</a>
            </span>
          </h3>
        </div>
        <div class="panel-body">
          无
        </div>
      </div>
      
      <div class="panel panel-default">
        <div class="panel-heading">
          <h3 class="panel-title">
            发表的经验(共<?php echo count_content("", $userid);?>篇)
            <span class="pull-right">
              <a href="content_list.php?u=<?php echo $userid;?>" class="btn btn-xs btn-default">更多</a>
            </span>
          </h3>
        </div>
        <div class="panel-body">
          <?php
          for ($count=0; $count < 5; $count++)
          {
            if (!echo_content_title($count, $with_tm=true, $type="", $author_id=$userid, $tag="", $text=""))
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
      if (isset($_COOKIE["userid"]) and $userid == $_COOKIE["userid"])
      {?>
      <div class="panel panel-default">
        <div class="panel-heading">
          <h3 class="panel-title">
            草稿箱
            <span class="pull-right">
              <a href="##" class="btn btn-xs btn-default">更多</a>
            </span>
          </h3>
        </div>
        <div class="panel-body">
          无
        </div>
      </div>
      <?php
      }?>
    </div>

<?php 
  }
  else
  {
    echo "未查找到该用户";
  }
}?>
</div>

<?php echo_webfooter(); ?>
</body>

</html>