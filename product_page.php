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
  width: 60%;
  text-align: center;
  margin: 120px 0 10px;
  font-weight: 200;
  margin-bottom: 40px;
  display: block;
  margin-left: auto;
  margin-right: auto;
  font-family: "Microsoft YaHei";
}
.title-center>.btn{
  margin-bottom: 3px;
}
</style>

<body>
  <?php include("common.php"); echo_banner("product"); ?>

  <div class="container">
    <div class="title-center">
      <h2>用电产品经验共享</h2>
      <p>为您提供最新最优质的用电产品开发、测试、行业等经验文档</p>
      <a class="btn btn-default" href="content_list.php?p=0&t=软件">软件</a>
      <a class="btn btn-default" href="content_list.php?p=0&t=硬件">硬件</a>
      <a class="btn btn-default" href="content_list.php?p=0&t=结构件">结构件</a>
      <a class="btn btn-default" href="content_list.php?p=0&t=综合">综合</a>
    </div>

    <div class="page-header">
      <h3>推荐阅读<small></small></h3>
    </div>
    <?php echo_passage_recommendation('product');?>
  </div>


  <?php echo_webfooter(); ?>
</body>
</html>