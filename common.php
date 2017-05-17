<script>
function delCookie(name) {
  var d = new Date();
  d.setTime(d.getTime() - 1);
  var expires = "expires="+d.toUTCString();
  document.cookie = name + "=" + "" + "; " + expires;
}
</script>

<?php
function echo_banner($page_name)
{?>
  <nav class="navbar navbar-inverse navbar-fixed-top">
    <div class="container">
      <div class="navbar-header">
        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
          <span class="sr-only">经验分享平台</span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
        </button>
        <a class="navbar-brand" href="index.php">经验分享平台</a>
      </div>
      <div id="navbar" class="navbar-collapse collapse">
        <ul class="nav navbar-nav">
          <li <?php if ($page_name=="" ){echo 'class="active"';}?> ><a href="content_list.php?p=0&t=">所有经验</a></li>
          <li class="dropdown <?php if (in_array($page_name, array("软件", "硬件", "结构件", "综合")))echo "active "; ?>">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">分类<span class="caret"></span></a>
            <ul class="dropdown-menu">
              <li><a href="content_list.php?p=0&t=软件">软件</a></li>
              <li><a href="content_list.php?p=0&t=硬件">硬件</a></li>
              <li><a href="content_list.php?p=0&t=结构件">结构件</a></li>
              <li><a href="content_list.php?p=0&t=综合">综合</a></li>
              <!--<li role="separator" class="divider"></li>-->
            </ul>
          </li>
          <li <?php if ($page_name=="about" ){echo 'class="active"';}?> ><a href="about.php">关于</a></li>
        </ul>
        <ul class="nav navbar-nav navbar-right">

    <?php
    if (isset($_COOKIE["userid"]))
    {?>
          <li <?php if ($page_name=="add_ex" ){echo 'class="active"';}?> ><a href="addex.php">添加经验</a></li>
          <li class="dropdown <?php if (in_array($page_name, array("mypage", "mymessages", "myconfig")))echo "active "; ?>">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><?php echo get_userinfo($_COOKIE["userid"])['nickname'];?> <span class="badge">1</span><span class="caret"></span></a>
            <ul class="dropdown-menu">
              <li><a href="userpage.php?u=0">我的主页</a></li>
              <li><a href="mymessages.php">消息 <span class="badge">1</span></a></li>
              <li><a href="myconfig.php">设置</a></li>
              <li><a href="javascript:delCookie('userid');window.location.href='<?php echo $_SERVER["PHP_SELF"]."?".$_SERVER["QUERY_STRING"]?>';">退出登录</a></li>
            </ul>
          </li>
    <?php
    }
    else
    {?>
          <li <?php if ($page_name=="add_ex" ){echo 'class="active"';}?> ><a href="login.php">添加经验</a></li>
          <script>alert(<?php echo $_COOKIE["userid"];?>);</script>
          <li <?php if ($page_name=="login" ){echo 'class="active"';}?> ><a href="login.php">登录/注册</a></li>
    <?php
    }
    ?>
        </ul>
        <!--<form class="navbar-form navbar-right">
    <input type="text" class="form-control" placeholder="搜索点什么...">
    </form>-->
      </div>
    </div>
  </nav>
  <?php
}

function echo_content_item($no, $type="", $author_id="", $tag="")
{
    require_once('config.php');
    $con=mysqli_connect(HOST, USERNAME, PASSWORD);
    mysqli_set_charset($con, "utf8");
    mysqli_select_db($con, 'experience_base');
    $result = mysqli_query($con, "SELECT * FROM eb_contents ".get_search_condition($type, $author_id, $tag)." ORDER BY cid DESC LIMIT $no,1");
    $row = mysqli_fetch_array($result);
    if ($row)
    {
    ?>
    <div class="item">
      <div class="item-heading">
        <h4><a href="content.php?cid=<?php echo $row['cid'];?>"><?php echo $row['title'];?></a></h4>
      </div>
      <div class="item-content">
        <div class="media pull-right"></div>
        <div class="text">
          <?php echo mb_substr(strip_tags($row['content']), 0, 200, 'utf-8').'...';?>
        </div>
      </div>
      <div class="item-footer">
        <?php echo_content_footer($row) ?>
      </div>
    </div>
    <?php
        mysqli_close($con);
        return true;
    }
    else
    {
        mysqli_close($con);
        return false;
    }
}

function echo_content_footer($row)
{
?>
    <a href="content_list.php?t=<?php echo $row['extype1'];?>" class="text-muted">
      <?php echo $row['extype1'];?>
    </a>
    <span> ></span>
    <a href="content_list.php?t=<?php echo $row['extype2'];?>" class="text-muted">
      <?php echo $row['extype2'];?>
    </a>
    &nbsp; &nbsp;

    <a href="userpage.php?u=<?php echo $row['author_id'];?>" class="text-muted"><img class="avatar-xs" src="<?php echo get_avatar($row['author_id']);?>" /> <?php echo get_userinfo($row['author_id'])['nickname'];?></a>
    &nbsp; &nbsp;
    <a href="content.php?cid=<?php echo $row['cid'];?>#excomments" class="text-muted"><i class="icon-comments"></i> <?php echo $row['comment_num'];?></a> 
    &nbsp; &nbsp;
    <a href="content.php?cid=<?php echo $row['cid'];?>#excomments" class="text-muted"><i class="icon-thumbs-o-up"></i> <?php echo $row['like_num'];?></a> 
    &nbsp; &nbsp;
    <span class="text-muted"><i class="icon-time"></i> <?php echo $row['create_tm'];?></span> 
    &nbsp;
    <span>
    <?php
    $tags_array = explode(SEPARATOR, $row['tags']);
    foreach ($tags_array as $tag)
    {
      if ($tag)
      {
      ?>
        <a class="label label-success" href="content_list.php?tag=<?php echo urlencode($tag);?>">
          <?php echo $tag;?>
        </a>
        &nbsp;
    <?php
      }
    }?>
    </span>
<?php
}

function echo_content_title($no, $type="", $author_id="", $tag="")
{
    require_once('config.php');
    $con=mysqli_connect(HOST, USERNAME, PASSWORD);
    mysqli_set_charset($con, "utf8");
    mysqli_select_db($con, 'experience_base');
    $result = mysqli_query($con, "SELECT * FROM eb_contents ".get_search_condition($type, $author_id, $tag)." ORDER BY cid DESC LIMIT $no,1");
    $row = mysqli_fetch_array($result);
    if($row)
    {
    ?>
      <p>
        <a href="content.php?cid=<?php echo $row['cid'];?>"><?php echo $row['title'];?></a>
        <span class="pull-right"><?php echo $row['create_tm'];?></span>
      </p>
    <?php
        mysqli_close($con);
        return true;
    }
    else
    {
        mysqli_close($con);
        return false;
    }
}

function count_content($type="", $author_id="", $tag="")
{
    require_once('config.php');
    $con=mysqli_connect(HOST, USERNAME, PASSWORD);
    mysqli_set_charset($con, "utf8");
    mysqli_select_db($con, 'experience_base');
    $result = mysqli_query($con, "SELECT COUNT(*) AS count FROM eb_contents ".get_search_condition($type, $author_id, $tag));
    $count = mysqli_fetch_array($result)['count'];
    mysqli_close($con);
    return $count;
}

function count_comment($cid)
{
    require_once('config.php');
    $con=mysqli_connect(HOST, USERNAME, PASSWORD);
    mysqli_set_charset($con, "utf8");
    mysqli_select_db($con, 'experience_base');
    $result = mysqli_query($con, "SELECT COUNT(*) AS count FROM eb_comments WHERE cid='$cid' and type='comment'");
    $count = mysqli_fetch_array($result)['count'];
    mysqli_close($con);
    return $count;
}

function count_like($cid)
{
    require_once('config.php');
    $con=mysqli_connect(HOST, USERNAME, PASSWORD);
    mysqli_set_charset($con, "utf8");
    mysqli_select_db($con, 'experience_base');
    $result = mysqli_query($con, "SELECT COUNT(*) AS count FROM eb_comments WHERE cid='$cid' and type='like'");
    $count = mysqli_fetch_array($result)['count'];
    mysqli_close($con);
    return $count;
}

function get_avatar($uid)
{
  require_once('config.php');
  $avatar = USER_AVATAR_PATH.sprintf("/%06d.png", $uid);
  if (!file_exists($avatar))
  {
    $avatar = "img/avatar.png";
  }
  return $avatar;
}

function get_userinfo($uid)
{
    include_once("config.php");
    $con=mysqli_connect(HOST, USERNAME, PASSWORD);
    mysqli_set_charset($con, "utf8");
    mysqli_select_db($con, 'experience_base');
    $result = mysqli_query($con, "SELECT * FROM eb_users WHERE uid='$uid'");
    $row = mysqli_fetch_array($result);
    mysqli_close($con);
    return $row;
}

function get_search_condition($se_type="", $se_userid="", $tag="")
{
  $search_condition = "";
  if ($se_type)
  {
    $search_condition .= "(extype1='$se_type' OR extype2='$se_type') AND ";
  }
  if ($se_userid)
  {
    $search_condition .= "author_id='$se_userid' AND ";
  }
  if ($tag)
  {
    $search_condition .= "tags LIKE '%$tag%' AND ";
  }
  
  if ($search_condition)
  {
    $search_condition = "WHERE " . substr($search_condition, 0, -4);  //去掉最后的AND
  }
  // print_r($search_condition);
  return $search_condition;
}
?>