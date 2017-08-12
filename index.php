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
    /* color: #34a855; */
    /* color: #4286f5; */
    /* color: #ffcc00; */
}

#highlights .inner {
    max-width: 900px;
    margin: 0 auto;
    text-align: center;
}
</style>

<?php
    if (strpos($_SERVER['HTTP_USER_AGENT'],'MSIE'))
    {?>
       <script>alert("系统检测到您正在使用IE浏览器(IE内核)，我们强烈建议您使用Chrome(内核)浏览器浏览本网站！");</script>
<?php }?>

<body>
  <?php include("common.php"); echo_banner("home"); ?>
    <div style="margin:70px;">
    </div>
    <!--Carousel-->
    <div id="myCarousel" class="carousel slide" data-ride="carousel">
      <!-- Indicators -->
      <ol class="carousel-indicators">
        <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
        <li data-target="#myCarousel" data-slide-to="1"></li>
        <li data-target="#myCarousel" data-slide-to="2"></li>
        <!--<li data-target="#myCarousel" data-slide-to="3"></li>-->
      </ol>
      <div class="carousel-inner" role="listbox">
        <div class="item active">
          <div class="container">
            <div class="carousel-caption">
              <h1>经验共享平台</h1>
              <p>为您提供最新、最全的经验，让我们每天都能经验+1</p>
              <p><a class="btn btn-lg btn-primary" href="about.php" role="button">了解更多</a></p>
            </div>
          </div>
        </div>
        <div class="item">
          <img class="second-slide" src="<?php echo IMG_FILE_PATH; ?>/others/slide2.png" alt="Second slide">
          <!-- <div class="brief">
            <p>工作分配</p>
          </div> -->
        </div>
        <div class="item">
          <img class="third-slide" src="<?php echo IMG_FILE_PATH; ?>/others/slide3.png" alt="Third slide">
          <!-- <div class="brief">
            <p>时间节点</p>
          </div> -->
        </div>
      </div>
      <!-- <a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev">
        <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
        <span class="sr-only">Previous</span>
      </a>
      <a class="right carousel-control" href="#myCarousel" role="button" data-slide="next">
        <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
        <span class="sr-only">Next</span>
      </a> -->
    </div>

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

<?php echo_webfooter(); ?>
</body>

</html>