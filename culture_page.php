<!DOCTYPE HTML>
<html>
<meta name="renderer" content="webkit">
<meta charset="UTF-8">
<title>经验共享平台</title>
<link rel="bookmark" type="image/x-icon" href="img/+1.ico" />
<link rel="shortcut icon" href="img/+1.ico">
<link rel="icon" href="img/+1.ico">
<link rel="stylesheet" href="style/css/bootstrap.css">
<link rel="stylesheet" href="style/css/carousel.css">
<script src="style/js/jquery.js"></script>
<script src="style/js/bootstrap.js"></script>

<?php
if (strpos($_SERVER['HTTP_USER_AGENT'],'MSIE'))
{?>
  <script>
    alert("系统检测到您正在使用IE浏览器(IE内核)，我们强烈建议您使用Chrome浏览器浏览本网站！");
  </script>
<?php 
}?>

<style>
.title-center {
    width: 100%;
    text-align: center;
    padding: 120px 0 80px;
    font-weight: 200;
    margin-bottom: 20px;
    display: block;
    margin-left: auto;
    margin-right: auto;
    font-family: "Microsoft YaHei";
    color: #000;
    display: block;
}
.title-center>.btn{
  margin-bottom: 3px;
}
</style>

<body>
  <?php include("common.php"); echo_banner("culture"); ?>

  <div class="title-center">
    <h2>企业文化经验共享</h2>
    <p>为您提供最新最优质的企业文化、案例分享、心得体会等经验文档 <a href="content_list.php?t=文化熏陶">查看全部</a></p>
    <a class="btn btn-default" href="content_list.php?p=0&t=企业文化">企业文化</a>
    <a class="btn btn-default" href="content_list.php?p=0&t=文化案例">文化案例</a>
    <a class="btn btn-default" href="content_list.php?p=0&t=优秀心得">优秀心得</a>
  </div>

  <div class="container">
    <?php echo_passage_recommendation('culture');?>
  </div>


  <?php echo_webfooter(); ?>
</body>
</html>