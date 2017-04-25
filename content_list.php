<!DOCTYPE HTML>
<html>
<meta charset="UTF-8">
<title>经验分享平台</title>
<link rel="bookmark" type="image/x-icon" href="img/+1.ico" />
<link rel="shortcut icon" href="img/+1.ico">
<link rel="icon" href="img/+1.ico">
<link rel="stylesheet" href="style/css/bootstrap.css">
<link rel="stylesheet" href="style/css/carousel.css">
<script src="style/js/jquery.js"></script>
<script src="style/js/bootstrap.js"></script>

<body>
<?php include("common.php"); ?>
<?php
  $items_per_page = 10;  
  $page = $_GET['p']; 
  $type = $_GET['t']; 
  $page_sum = ceil(count_content($type) / $items_per_page);
  echo_banner($type);
?>
<div style="margin: 60px"></div>
<div class="container">
  <div class="list">
    <header>
      <h3><i></i> <?php if(!$type)echo "所有经验";else echo $type; ?> <small>第<?php echo ($page + 1) ?>页，共<?php echo $page_sum ?>页</small></h3>
    </header>
    <div class="items items-hover">
      <?php
      for ($count = $page*$items_per_page; $count < ($page + 1)*$items_per_page; $count++) 
      {
        if (!echo_content_item($count, $type))
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

  <nav aria-label="Page navigation" style="margin-left: 15px">
    <ul class="pagination">
    <?php if($page == 0){?>
      <li class="disabled"><span aria-hidden="true">上一页</span></li>
    <?php }else{?>
      <li class="previous"><a href="content_list.php?p=<?php echo ($page-1)?>"><span aria-hidden="true">上一页</span></a></li>
    <?php }
    for ($count=0; $count < $page_sum; $count++)
    {?>
      <li <?php if($page == $count)echo "class='active'"?>><a href="content_list.php?p=<?php echo $count?>"><?php echo ($count + 1)?></a></li>
    <?php 
    }
    if($page >= $page_sum-1){?>
      <li class="disabled"><span aria-hidden="true">下一页</span></li>
    <?php }else{?>
      <li class="next"><a href="content_list.php?p=<?php echo ($page+1)?>"><span aria-hidden="true">下一页</span></a></li>
    <?php }?>
    </ul>
  </nav>
</div>

</body>

</html>