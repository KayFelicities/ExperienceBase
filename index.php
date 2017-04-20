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

<style>
  .media img {
    width: 70px;
  }
</style>

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
              <p><a class="btn btn-lg btn-primary" href="about.php" role="button">了解更多</a></p>
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

    <div class="container">
      <div class="list">
        <header>
          <h3><i class="icon-list-ul"></i> 最新文章 <small>test</small></h3>
        </header>
        <div class="items items-hover">

<?php
require_once('config.php');
$con=mysqli_connect(HOST, USERNAME, PASSWORD);
mysqli_set_charset($con, "utf8");
mysqli_select_db($con, 'experience_base');
$result = mysqli_query($con, "SELECT * FROM eb_contents ORDER BY 'create_tm' DESC LIMIT 5");
while($row = mysqli_fetch_array($result))
{?>
          <div class="item">
            <div class="item-heading">
              <div class="pull-right label label-success">标签</div>
              <h4><a href="###"><?php echo $row['title'];?></a></h4>
            </div>
            <div class="item-content">
              <div class="media pull-right"><img src="img/logo.png" alt=""></div>
              <div class="text"><?php echo mb_substr(strip_tags($row['content']), 0, 100, 'utf-8').'...';?></div>
            </div>
            <div class="item-footer">
              <a href="#" class="text-muted"><?php echo $row['uid'];?></a>
              &nbsp; &nbsp; 
              <a href="#" class="text-muted"><i class="icon-comments"></i><?php echo ' '.$row['comment_num'];?></a> 
              &nbsp; &nbsp; 
              <span class="text-muted"><?php echo $row['create_tm'];?></span>
            </div>
          </div>
<?php
}
mysqli_close($con);
?>

        </div>
      </div>
    </div>

</body>

</html>