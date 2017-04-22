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
<?php include("common.php"); echo_banner("procedure"); ?>
<div style="margin: 60px"></div>
<div class="container">
  <div class="list">
    <header>
      <h3><i></i> 流程经验 <small>共<?php echo count_content("流程");?>条</small></h3>
    </header>
    <div class="items items-hover">
      <?php
      for ($count = 0; $count < 15; $count++) {
        if (!echo_content_item($count, "流程"))
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


</body>

</html>