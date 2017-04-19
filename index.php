<!DOCTYPE HTML>
<html>
<meta charset="UTF-8">
<title>经验分享平台</title>
<link rel="bookmark" type="image/x-icon" href="+1.ico" />
<link rel="shortcut icon" href="+1.ico">
<link rel="icon" href="+1.ico">
<link rel="stylesheet" href="style/css/bootstrap.css">
<link rel="stylesheet" href="style/css/carousel.css">
<script src="style/js/jquery.js"></script>
<script src="style/js/bootstrap.js"></script>

<body>
  <?php include("common.php"); echo_banner("home"); ?>
  <div style="margin:70px;">
  </div>

  <!-- Carousel
    ================================================== -->
  <div id="myCarousel" class="carousel slide" data-ride="carousel">
    <!-- Indicators -->
    <ol class="carousel-indicators">
      <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
      <li data-target="#myCarousel" data-slide-to="1"></li>
      <li data-target="#myCarousel" data-slide-to="2"></li>
      <li data-target="#myCarousel" data-slide-to="3"></li>
    </ol>
    <div class="carousel-inner" role="listbox">
      <div class="item active">
        <img class="first-slide" src="img/运作流程.png" alt="First slide">
        <div class="brief">
          <p>运作流程</p>
        </div>
      </div>
      <div class="item">
        <img class="second-slide" src="img/工作分配.png" alt="Second slide">
        <div class="brief">
          <p>工作分配</p>
        </div>
      </div>
      <div class="item">
        <img class="third-slide" src="img/时间节点.png" alt="Third slide">
        <div class="brief">
          <p>时间节点</p>
        </div>
      </div>
      <div class="item">
        <!--<img class="third-slide" src="img/时间节点.png" alt="Third slide">-->
        <div class="container">
          <div class="carousel-caption">
            <h1>经验分享平台</h1>
            <p>提供最新、最全的经验，让我们每天都能经验+1</p>
            <p><a class="btn btn-lg btn-primary" href="#" role="button">了解更多</a></p>
          </div>
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
  <!-- /.carousel -->


</body>

</html>