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
  <?php include("common.php"); echo_banner("growth"); ?>

  <div class="container">
    <div class="title-center">
      <h2>个人成长经验共享</h2>
      <p>为您提供最新最优质的个人成长、个人管理文档</p>
      <a class="btn btn-default" href="content_list.php?p=0&t=个人成长">查看全部</a>
      <a class="btn btn-default" href="content_list.php?p=0&t=沟通表达">沟通表达</a>
      <a class="btn btn-default" href="content_list.php?p=0&t=职业生涯">职业生涯</a>
      <a class="btn btn-default" href="content_list.php?p=0&t=人际关系">人际关系</a>
      <a class="btn btn-default" href="content_list.php?p=0&t=财富管理">财富管理</a>
      <a class="btn btn-default" href="content_list.php?p=0&t=家庭生活">家庭生活</a>
      <a class="btn btn-default" href="content_list.php?p=0&t=修身养性">修身养性</a>
    </div>
    
    <div class="page-header">
      <h3>推荐阅读<small></small></h3>
    </div>
    <?php echo_passage_recommendation('growth');?>
  </div>


  <?php echo_webfooter(); ?>
</body>
</html>