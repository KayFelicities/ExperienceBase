<!DOCTYPE HTML>
<html>
<meta name="renderer" content="webkit"> 
<meta charset="UTF-8">
<title>经验分享平台</title>
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
       <script>alert("系统检测到您正在使用IE浏览器(IE内核)，我们强烈建议您使用Chrome或Firefox浏览器浏览本网站！");</script>
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
              <h1>经验分享平台</h1>
              <p>为您提供最新、最全的经验，让我们每天都能经验+1</p>
              <p><a class="btn btn-lg btn-primary" href="about.php" role="button">了解更多</a></p>
            </div>
          </div>
        </div>
        <!--<div class="item">
          <img class="first-slide" src="img/img1.png" alt="First slide">
          <div class="brief">
            <p>运作流程</p>
          </div>
        </div>-->
        <div class="item">
          <img class="second-slide" src="img/img2.png" alt="Second slide">
          <div class="brief">
            <p>工作分配</p>
          </div>
        </div>
        <div class="item">
          <img class="third-slide" src="img/img3.png" alt="Third slide">
          <div class="brief">
            <p>时间节点</p>
          </div>
        </div>
      </div>
      <a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev">
        <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
        <span class="sr-only">Previous</span>
      </a>
      <a class="right carousel-control" href="#myCarousel" role="button" data-slide="next">
        <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
        <span class="sr-only">Next</span>
      </a>
    </div>

    <!--new contents-->
    <div class="container">
      <div class="list">
        <header>
          <h3><i class="icon-list-ul"></i> 最新经验 <small></small></h3>
        </header>
        <div class="items items-hover">

        <?php
        for ($count = 0; $count < 5; $count++) {
          if (!echo_content_item($count))
          {
            break;
          }
        }
        if ($count == 0)
        {
            echo '无记录';
        }
        ?>

        </div>
      </div>
    </div>

<?php echo_webfooter(); ?>
</body>

</html>