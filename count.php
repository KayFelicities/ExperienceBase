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
<?php include("common.php"); echo_banner("mission"); ?>
<div style="margin: 60px"></div>
<div class="container">
<?php 
  require_once('config.php');
  $con=mysqli_connect(HOST, USERNAME, PASSWORD);
  mysqli_set_charset($con, "utf8");
  mysqli_select_db($con, 'experience_base');
?>
    <header>
        <h3><i></i>红包任务统计<small></small></h3>
    </header>
    <hr>
    <div class="panel panel-default">
        <div class="panel-heading">
        <h3 class="panel-title">
            完成情况
        </h3>
        </div>
        <div class="panel-body">
<?php
  $uid_count = 2;
  $complete_user_count = 0;
  while (1)
  {
    $userinfo = get_userinfo($uid_count);
    if (!$userinfo) break;

    $result = mysqli_query($con, "SELECT COUNT(*) AS count FROM eb_passages WHERE status='publish' AND author_id='$uid_count' AND pid<=334");
    $passage_num = mysqli_fetch_array($result)['count'];
    $result = mysqli_query($con, "SELECT COUNT(*) AS count FROM eb_comments WHERE status='publish' AND type='like' AND c_author_id='$uid_count'");
    $like_num = mysqli_fetch_array($result)['count'];
    $result = mysqli_query($con, "SELECT COUNT(*) AS count FROM eb_comments WHERE status='publish' AND type='comment' AND c_author_id='$uid_count'");
    $comment_num = mysqli_fetch_array($result)['count'];

    if ($passage_num >= 3 and $like_num >= 5 and $comment_num >=5)
    {
        echo '<p>'.$userinfo['nickname'].':文章'.$passage_num.',点赞'.$like_num.',评论'.$comment_num;
        echo '>已完成</p>';$complete_user_count += 1;
    }
    else echo '</p>';

    $uid_count += 1;
  }
  mysqli_close($con);

  echo '<p style="color: red">共'.$uid_count.'名用户，完成任务'.$complete_user_count.'名';

  ?>
        </div>
    </div>
</div>
</div>

<?php echo_webfooter(); ?>
</body>

</html>