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

<body>
<?php include("common.php"); ?>
<?php
  $items_per_page = 10;
  $page = isset($_GET['p']) ? $_GET['p'] : '0'; 
  $se_type = isset($_GET['t']) ? $_GET['t'] : ''; 
  $se_userid = isset($_GET['u']) ? $_GET['u'] : "";
  $se_tag = isset($_GET['tag']) ? $_GET['tag'] : "";
  $se_content = isset($_GET['c']) ? $_GET['c'] : "";
  $se_text = isset($_GET['s']) ? $_GET['s'] : "";
  $order_type = isset($_GET['o']) ? $_GET['o'] : "last";

  $item_num = count_content($se_type, $se_userid, $se_tag, $se_text);
  $page_sum = ceil($item_num / $items_per_page);
  echo_banner('content_list');
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
          <?php if($se_text)echo "搜索“".$se_text."”相关的";?>
          所有文章
           <span style="font-size: 12px; margin-left: 10px;"> 
            <?php
              $href_last = sprintf('"content_list.php?p=%s&t=%s&u=%s&tag=%s&c=%s&s=%s&o=last"',
                  $page, $se_type, $se_userid, $se_tag, $se_content, $se_text);
              $href_new = sprintf('"content_list.php?p=%s&t=%s&u=%s&tag=%s&c=%s&s=%s&o=new"',
                  $page, $se_type, $se_userid, $se_tag, $se_content, $se_text);
              if ($order_type == "last"){echo '<b>按动态时间排序</b>|<a href='.$href_new.'>按发表时间排序</a>';}
              else {echo '<a href='.$href_last.'>按动态时间排序</a>|<b>按发表时间排序</b>';}
            ?>
           </span> 
        </small>
        <div class="col-xs-5 pull-right">
          <form id="edit-submit" method="get" action="content_list.php">
            <div class="input-group">
              <input id="search-text" type="text" name="s" class="form-control" placeholder="搜索点什么...">
              <span class="input-group-btn">
                <button class="btn btn-default" type="submit" >搜索</button>
              </span>
            </div>
          </form>
        </div>
      </h3>
    </header>
    <div class="items items-hover">
      <?php
      for ($count = $page*$items_per_page; $count < ($page + 1)*$items_per_page; $count++)
      {
        if (!echo_content_item($count, $se_type, $se_userid, $se_tag, $se_text, $order_type))
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
    <?php }else{
      $param = sprintf('p=%s&t=%s&u=%s&tag=%s&c=%s&s=%s&o=%s',$page-1, $se_type, $se_userid, $se_tag, $se_content, $se_text, $order_type);
    ?>
      <li class="previous"><a href="content_list.php?<?php echo ($param)?>"><span aria-hidden="true">上一页</span></a></li>
    <?php }
    for ($count=0; $count < $page_sum; $count++)
    {
      $param = sprintf('p=%s&t=%s&u=%s&tag=%s&c=%s&s=%s&o=%s',$count, $se_type, $se_userid, $se_tag, $se_content, $se_text, $order_type);
    ?>
      <li <?php if($page == $count)echo "class='active'"?>><a href="content_list.php?<?php echo $param?>"><?php echo ($count + 1)?></a></li>
    <?php 
    }
    if($page >= $page_sum-1){?>
      <li class="disabled"><span aria-hidden="true">下一页</span></li>
    <?php }else
    {
      $param = sprintf('p=%s&t=%s&u=%s&tag=%s&c=%s&s=%s&o=%s',$page+1, $se_type, $se_userid, $se_tag, $se_content, $se_text, $order_type);
    ?>
      <li class="next"><a href="content_list.php?<?php echo ($param)?>"><span aria-hidden="true">下一页</span></a></li>
    <?php }?>
    </ul>
  </nav>
</div>

<?php echo_webfooter(); ?>
</body>

</html>