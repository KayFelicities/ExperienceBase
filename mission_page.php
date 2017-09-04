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
$uid = isset($_GET['uid']) ? $_GET['uid'] : '';
if (!$uid){echo '<script>location.href="404.php"</script>';}
else
{
  $userinfo = get_userinfo($uid);
  $timenow = date("Y-m-d H:i:s");

  $con=mysqli_connect(HOST, USERNAME, PASSWORD);
  mysqli_set_charset($con, "utf8");
  mysqli_select_db($con, 'experience_base');
  $result = mysqli_query($con, "SELECT COUNT(*) AS count FROM eb_passages WHERE author_id='$uid' AND status='publish' AND pid<=334");
  $passage_num = mysqli_fetch_array($result)['count'];
  $result = mysqli_query($con, "SELECT COUNT(*) AS count FROM eb_comments WHERE type='like' AND c_author_id='$uid'");
  $like_num = mysqli_fetch_array($result)['count'];
  $result = mysqli_query($con, "SELECT COUNT(*) AS count FROM eb_comments WHERE type='comment' AND c_author_id='$uid'");
  $comment_num = mysqli_fetch_array($result)['count'];

  mysqli_close($con);
?>
    <header>
        <h3><i></i><?php echo $userinfo['nickname'];?>的千元红包任务<small></small></h3>
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
        // echo '<p>发表文章'.$passage_num.'篇（目标3篇）</p>';
        // echo '<p>点赞文章'.$like_num.'篇（目标5篇）</p>';
        // echo '<p>评论文章'.$comment_num.'篇（目标5篇）</p>';
        if ($passage_num >= 3 and $like_num >= 5 and $comment_num >=5)
        {?>
            <p>感谢您对平台的支持。</p>
            <!-- <img src="<?php echo IMG_FILE_PATH;?>/others/0823.jpg"></img> -->
            <p style="color: red;"><b>进群后请改群昵称为自己的姓名以便我们核对，请不要拉没完成任务的人进群，否则我们将取消您的获奖资格！</b></p>
            <p style="color: red;"><b>红包按人数分配，每个人都有份，因此您不需要守着手机，我们会在所有完成任务的用户都进群后开始发红包。</b></p>
            <p style="color: red;"><b>红包金额是随机的，我们会发5个200元的红包，具体能分到多少钱完全随机！</b></p>
    <?php
        }
        else
        {
            echo '<p>活动已截止。您尚未完成千元红包任务，期待下次活动吧~</p>';
        }
        ?>
        </div>
    </div>
<?php
}
?>

<?php echo_webfooter(); ?>
</body>

</html>