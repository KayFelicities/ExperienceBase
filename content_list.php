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

<body>
<?php include("common.php"); ?>
<?php
  $items_per_page = 10;
  $page = isset($_GET['p']) ? $_GET['p'] : '0'; 
  $se_type = isset($_GET['t']) ? $_GET['t'] : ''; 
  $se_userid = isset($_GET['u']) ? $_GET['u'] : "";
  $se_tag = isset($_GET['tag']) ? $_GET['tag'] : "";
  $se_content = isset($_GET['c']) ? $_GET['c'] : "";

  $item_num = count_content($se_type, $se_userid, $se_tag);
  $page_sum = ceil($item_num / $items_per_page);
  echo_banner($se_type);
?>
<div style="margin: 60px"></div>
<div class="container">
  <div class="list">
    <header>
      <h3>
        搜索结果(共<?php echo $item_num;?>篇) 
        <small>
          <?php if($se_userid)echo get_userinfo($se_userid)['nickname']."的";?>
          <?php if($se_type)echo $se_type."分类下的";?>
          <?php if($se_tag)echo "包含“".$se_tag."”标签的";?>
          所有文章
        </small>
        <div class="col-xs-5 pull-right">
          <div class="input-group">
            <input type="text" class="form-control" placeholder="搜索点什么...">
            <span class="input-group-btn">
              <button class="btn btn-default" type="button">搜索</button>
            </span>
          </div>
        </div>
      </h3>
    </header>
    <div class="items items-hover">
      <?php
      for ($count = $page*$items_per_page; $count < ($page + 1)*$items_per_page; $count++) 
      {
        if (!echo_content_item($count, $se_type, $se_userid, $se_tag))
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

<?php echo_webfooter(); ?>
</body>

</html>