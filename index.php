<!DOCTYPE HTML>
<html>
<meta name="renderer" content="webkit"> 
<meta charset="UTF-8">
<title>经验共享平台</title>
<link rel="bookmark" type="image/x-icon" href="img/+1.ico" />
<link rel="shortcut icon" href="img/+1.ico">
<link rel="icon" href="img/+1.ico">
<link rel="stylesheet" href="style/css/bootstrap.css">
<!-- <link rel="stylesheet" href="style/css/carousel.css"> -->
<link rel="stylesheet" href="style/css/slippry.css">
<script src="style/js/jquery.js"></script>
<script src="style/js/bootstrap.js"></script>
<script src="style/js/slippry.min.js"></script>

<style>
  #highlights .point {
    width: 33%;
    display: inline-block;
    vertical-align: top;
    box-sizing: border-box;
    padding: 0 2em;
}

  #highlights .point h2{
    margin-bottom: 20px;
    /* color: #34a855; green*/
    /* color: #4286f5; blue*/
    /* color: #ffcc00; yellow*/
}

#highlights .inner {
    max-width: 900px;
    margin: 0 auto;
    text-align: center;
}

#slide-container {
  height: 300px;
}
</style>

<?php
    if (strpos($_SERVER['HTTP_USER_AGENT'],'MSIE'))
    {?>
       <script>
          alert("系统检测到您正在使用IE浏览器(IE内核)，我们强烈建议您使用Chrome(内核)浏览器浏览本网站！");
          window.open("http://10.9.52.233/experiencebase/content.php?pid=183"); 
        </script>
<?php }?>

<script>
    $(document).ready(function(){
      $("#slippry").slippry({
        // transition: 'horizontal',
        pause: 5000,
        adaptiveHeight: false,
        elements: 'div',
      });
    }); 
</script>

<body>
  <?php include("common.php"); echo_banner("home"); require_once('config.php');?>
    <div style="margin: 50px;">
    </div>
  <!-- <div id="slide-container"> -->
    <div id="slippry">
      <div>
        <a href="about.php"><img src="<?php echo IMG_FILE_PATH.'/others/slide2.jpg'?>" alt=""></a>
      </div>
      <div>
        <a href="content.php?pid=185"><img src="<?php echo IMG_FILE_PATH.'/others/slide1.jpg'?>" alt=""></a>
      </div>
    </div>
  <!-- </div> -->

  <div id="highlights" style="margin-top: 50px; margin-bottom: 100px;">
    <div class="inner">
      <div class="point">
        <h2>简单</h2>
        <p>完善的经验分类、<a href="content_list.php">检索</a><br>友好的附件预览、评论点赞、收藏关注<br/>一切为用户体验而生</p>
      </div>

      <div class="point">
        <h2>共享</h2>
        <p>打破产品中心各部门间壁垒<br>共享<a href="product_page.php">用电产品</a>、<a href="culture_page.php">企业文化</a>、<a href="growth_page.php">个人经验</a><br>独乐乐不如众乐乐</p>
      </div>

      <div class="point">
        <h2>安全</h2>
        <p>仅公司局域网可访问<br>仅用电中心员工可注册、查看附件<br>我们竭诚保护您的文档安全</p>
      </div>
    </div>
  </div>


  <div class="container">
    <div class="page-header">
        <h3>本周推荐阅读<small></small></h3>
    </div>
    <?php echo_passage_recommendation('main');?>
  </div>

<?php echo_webfooter(); ?>
</body>

</html>