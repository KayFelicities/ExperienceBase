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
  $result = mysqli_query($con, "SELECT COUNT(*) AS count FROM eb_passages WHERE author_id='$uid'");
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
        echo '<p>发表文章'.$passage_num.'篇（目标3篇）</p>';
        echo '<p>点赞文章'.$like_num.'篇（目标5篇）</p>';
        echo '<p>评论文章'.$comment_num.'篇（目标5篇）</p>';
        if ($passage_num >= 3 and $like_num >= 5 and $comment_num >=5)
        {
            echo '<p>恭喜您已完成千元红包任务，请留意平台动态，我们会在23号与您共享千元红包！</p>';
        }
        else
        {
            echo '<p>您尚未完成千元红包任务，快去<a href="addex.php">上传经验文档</a>、给同事的文章点赞、评论吧！</p>';
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