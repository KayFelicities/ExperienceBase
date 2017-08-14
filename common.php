<script>
function delCookie(name) {
  var d = new Date();
  d.setTime(d.getTime() - 1);
  var expires = "expires="+d.toUTCString();
  document.cookie = name + "=" + "" + "; " + expires;
}
</script>

<?php
function echo_webfooter()
{?>
    <div style="margin-top: 30px; margin-bottom: 10px; text-align: center;">
        <p>Designed by A1-工匠组. Powered by Bootstrap. | <a href="about.php">关于</a></p>
    </div>
<?php
}

function echo_banner($page_name)
{?>
  <nav class="navbar navbar-default navbar-fixed-top">
    <div class="container">
      <div class="navbar-header">
        <a class="navbar-brand" href="index.php">
          <img alt="Brand" src="img/head_100.png">
        </a>
        <!-- <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
          <span class="sr-only">经验共享平台</span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
        </button> -->
        <!-- <a class="navbar-brand" href="index.php">经验共享平台</a> -->
      </div>
      <div id="navbar" class="navbar-collapse collapse">
        <ul class="nav navbar-nav">
          <li <?php if ($page_name == "product"){echo 'class="active"';}?>><a href="product_page.php">用电产品</a></li>
          <li <?php if ($page_name == "culture"){echo 'class="active"';}?>><a href="culture_page.php">文化熏陶</a></li>
          <li <?php if ($page_name == "growth"){echo 'class="active"';}?>><a href="growth_page.php">个人成长</a></li>
          <li <?php if ($page_name=="" ){echo 'class="active"';}?> ><a href="content_list.php?p=0&t=">所有经验</a></li>
          <li <?php if ($page_name=="message" ){echo 'class="active"';}?> ><a href="message_board.php">留言板</a></li>
          <li <?php if ($page_name=="about" ){echo 'class="active"';}?> ><a href="about.php">关于</a></li>
        </ul>
        <ul class="nav navbar-nav navbar-right">

    <?php
    if (isset($_COOKIE["userid"]))
    {
          $user_info = get_userinfo($_COOKIE["userid"]);
          $unread_badge = $user_info['unread_num'] == 0 ? '' : $user_info['unread_num']
    ?>
          <li <?php if ($page_name=="add_ex" ){echo 'class="active"';}?> ><a href="addex.php">添加经验</a></li>
          <li class="dropdown <?php if (in_array($page_name, array("mypage", "mymessages", "myconfig")))echo "active "; ?>">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><?php echo $user_info['nickname'];?> <span class="badge"><?php echo $unread_badge?></span><span class="caret"></span></a>
            <ul class="dropdown-menu">
              <li><a href="userpage.php?u=0">我的主页</a></li>
               <li><a href="mymessages.php">消息 <span class="badge"><?php echo $unread_badge;?></span></a></li> 
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

function get_readable_tm($tm)
{
  $time = strtotime($tm);
  $sec = time()-$time;
  if ($sec > 2592000 * 2)
  { // ignore tm two months ago 
    return $tm;
  }

  $convert = array(
      '31536000'=>'年',
      '2592000'=>'个月',
      '604800'=>'星期',
      '86400'=>'天',
      '3600'=>'小时',
      '60'=>'分钟',
      '1'=>'秒'
  );
  foreach ($convert as $level=>$unit)
  {
      if (0 != $num = floor($sec / (int)$level))
      {
          return $num.$unit.'前';
      }
  }
}

function echo_content_item($no, $type="", $author_id="", $tag="", $text="", $order_type="last")
{
    require_once('config.php');
    $con=mysqli_connect(HOST, USERNAME, PASSWORD);
    mysqli_set_charset($con, "utf8");
    mysqli_select_db($con, 'experience_base');
    $order = $order_type == "last" ? " ORDER BY priority DESC,last_tm DESC,pid DESC" : " ORDER BY priority DESC,pid DESC";
    $result = mysqli_query($con, "SELECT * FROM eb_passages ".get_search_condition($type, $author_id, $tag, $text).$order." LIMIT $no,1");
    $row = mysqli_fetch_array($result);
    if ($row)
    {
    ?>
    <div class="item">
      <div class="item-heading">
        <h4>
          <a href="content.php?pid=<?php echo $row['pid'];?>">
            <?php if($row['priority'] > 0){echo '[置顶]';} echo $row['title'];?>
          </a>
          <small class="pull-right"><?php echo get_readable_tm($row['last_tm']);?></small>
        </h4>
      </div>
      <div class="item-content">
        
        <div class="media pull-right">
          <?php if (is_file(IMG_FILE_STORE_PATH.'/link_pic/'.$row['pid'].'.jpg')) echo '<img src="'.IMG_FILE_PATH.'/link_pic/'.$row['pid'].'.jpg" height="70px" width="140px" alt="">';?>
        </div>
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

function echo_content_card($pid)
{
  require_once('config.php');
  $con=mysqli_connect(HOST, USERNAME, PASSWORD);
  mysqli_set_charset($con, "utf8");
  mysqli_select_db($con, 'experience_base');
  $result = mysqli_query($con, "SELECT * FROM eb_passages WHERE pid='$pid'");
  $row = mysqli_fetch_array($result);
  if ($row)
  {?>
    <div class="col-sm-6 col-md-4">
      <div class="thumbnail">
        <a href="content.php?pid=<?php echo $pid;?>">
          <img src="<?php echo(IMG_FILE_PATH.'/link_pic/'.$row['pid'].'.jpg');?>">
        </a>
        <div class="caption">
          <h3>
              <a href="content.php?pid=<?php echo $pid;?>">
                <?php echo $row['title'];?><br>
              </a>
                <small>
                  <!-- <?php echo get_userinfo($row['author_id'])['nickname'];?> -->
                  <a href="content_list.php?t=<?php echo $row['extype1'];?>" class="text-muted">
                    <?php echo $row['extype1'];?>
                  </a>
                  <span> ></span>
                  <a href="content_list.php?t=<?php echo $row['extype2'];?>" class="text-muted">
                    <?php echo $row['extype2'];?>
                  </a>
                </small>
          </h3>
          <p><?php echo mb_substr(strip_tags($row['content']), 0, 100, 'utf-8').'...';?></p>
        </div>
      </div>
    </div>
<?php
  }
}

function echo_passage_recommendation($page_type)
{
  require_once('config.php');
  $con=mysqli_connect(HOST, USERNAME, PASSWORD);
  mysqli_set_charset($con, "utf8");
  mysqli_select_db($con, 'experience_base');
  switch ($page_type)
  {
    case 'product':
      $result = mysqli_query($con, "SELECT * FROM eb_others WHERE name='product_page_pids'");
      $row = mysqli_fetch_array($result);
      break;
    case 'culture':
      $result = mysqli_query($con, "SELECT * FROM eb_others WHERE name='culture_page_pids'");
      $row = mysqli_fetch_array($result);
      break;
    case 'growth':
      $result = mysqli_query($con, "SELECT * FROM eb_others WHERE name='growth_page_pids'");
      $row = mysqli_fetch_array($result);
      break;
    default:
      $row = NULL;
  }
  if ($row)
  {
    $pids = explode(",", str_replace('，', ',', $row['content']));
    echo '<div class="row">';
    foreach ($pids as $pid) echo_content_card($pid);
    echo '</div>';
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
    <a href="content.php?pid=<?php echo $row['pid'];?>#excomments" class="text-muted"><i class="icon-comments"></i> <?php echo $row['comment_num'];?></a> 
    &nbsp; &nbsp;
    <a href="content.php?pid=<?php echo $row['pid'];?>" class="text-muted"><i class="icon-heart-empty"></i> <?php echo $row['like_num'];?></a> 
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

function echo_content_title($no, $type="", $author_id="", $tag="", $text="")
{
    require_once('config.php');
    $con=mysqli_connect(HOST, USERNAME, PASSWORD);
    mysqli_set_charset($con, "utf8");
    mysqli_select_db($con, 'experience_base');
    $result = mysqli_query($con, "SELECT * FROM eb_passages ".get_search_condition($type, $author_id, $tag, $text)." ORDER BY pid DESC LIMIT $no,1");
    $row = mysqli_fetch_array($result);
    if($row)
    {
    ?>
      <p>
        <a href="content.php?pid=<?php echo $row['pid'];?>"><?php echo $row['title'];?></a>
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

function count_content($type="", $author_id="", $tag="", $text="")
{
    require_once('config.php');
    $con=mysqli_connect(HOST, USERNAME, PASSWORD);
    mysqli_set_charset($con, "utf8");
    mysqli_select_db($con, 'experience_base');
    $result = mysqli_query($con, "SELECT COUNT(*) AS count FROM eb_passages ".get_search_condition($type, $author_id, $tag, $text));
    $count = mysqli_fetch_array($result)['count'];
    mysqli_close($con);
    return $count;
}

function count_comment($pid)
{
    require_once('config.php');
    $con=mysqli_connect(HOST, USERNAME, PASSWORD);
    mysqli_set_charset($con, "utf8");
    mysqli_select_db($con, 'experience_base');
    $result = mysqli_query($con, "SELECT COUNT(*) AS count FROM eb_comments WHERE status='publish' and pid='$pid' and type='comment'");
    $count = mysqli_fetch_array($result)['count'];
    mysqli_close($con);
    return $count;
}

function count_like($pid)
{
    require_once('config.php');
    $con=mysqli_connect(HOST, USERNAME, PASSWORD);
    mysqli_set_charset($con, "utf8");
    mysqli_select_db($con, 'experience_base');
    $result = mysqli_query($con, "SELECT COUNT(*) AS count FROM eb_comments WHERE pid='$pid' and type='like'");
    $count = mysqli_fetch_array($result)['count'];
    mysqli_close($con);
    return $count;
}

function echo_like_people($pid)
{
    require_once('config.php');
    $con=mysqli_connect(HOST, USERNAME, PASSWORD);
    mysqli_set_charset($con, "utf8");
    mysqli_select_db($con, 'experience_base');
    $result = mysqli_query($con, "SELECT * FROM eb_comments WHERE pid='$pid' and type='like'");
    $ret = '';
    while ($row = mysqli_fetch_array($result))
    {
      $ret .= '<a href="userpage.php?u=' . get_userinfo($row['c_author_id'])['uid'] . '">' . get_userinfo($row['c_author_id'])['nickname'] . '</a> ';
    }
    mysqli_close($con);

    if ($ret)
    {
      echo $ret . '赞了这篇文章';
    }
    else
    {
      echo '快来点赞吧！';
    }
}

function is_i_liked($pid)
{
    if (!isset($_COOKIE["userid"]))
    {
      return FALSE;
    }

    require_once('config.php');
    $con=mysqli_connect(HOST, USERNAME, PASSWORD);
    mysqli_set_charset($con, "utf8");
    mysqli_select_db($con, 'experience_base');
    $logined_userid = $_COOKIE["userid"];
    $result = mysqli_query($con, "SELECT * FROM eb_comments WHERE pid='$pid' and type='like' and c_author_id='$logined_userid'");
    $is_liked = FALSE;
    if (mysqli_fetch_array($result)) {$is_liked = TRUE;}
    mysqli_close($con);
    return $is_liked;
}

function get_avatar($uid)
{
  require_once('config.php');
  $avatar_store = IMG_FILE_STORE_PATH.'/avatar/'.$uid.'.png';
  $avatar = IMG_FILE_PATH.'/avatar/'.$uid.'.png';
  if (!file_exists($avatar_store))
  {
    $avatar = IMG_FILE_PATH.'/avatar/'.'/default.png';
  }
  return $avatar;
}

function get_sxinfo($sx_id)
{
    include_once("config.php");
    $con=mysqli_connect(HOST, USERNAME, PASSWORD);
    mysqli_set_charset($con, "utf8");
    mysqli_select_db($con, 'experience_base');
    $result = mysqli_query($con, "SELECT * FROM eb_sx_list WHERE sx_id='$sx_id'");
    $row = mysqli_fetch_array($result);
    mysqli_close($con);
    return $row;
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

function get_user_link($uid)
{
    return '<a href=userpage.php?u=' . $uid . '>' . get_userinfo($uid)['nickname'] . '</a>';
}

function get_passage_info($pid)
{
    include_once("config.php");
    $con=mysqli_connect(HOST, USERNAME, PASSWORD);
    mysqli_set_charset($con, "utf8");
    mysqli_select_db($con, 'experience_base');
    $result = mysqli_query($con, "SELECT * FROM eb_passages WHERE pid='$pid'");
    $row = mysqli_fetch_array($result);
    mysqli_close($con);
    return $row;
}

function echo_passage_link($pid, $cid='')
{
    echo '<a href=content.php?pid=' . $pid . '#c' . $cid . '>' . get_passage_info($pid)['title'] . '</a>';
}

function get_search_condition($se_type="", $se_userid="", $tag="", $text="")
{
  $search_condition = "WHERE status='publish' AND ";
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

  $search_text = "";
  if ($text)
  {
    $search_text .= "(extype1 LIKE '%$text%' OR extype2 LIKE '%$text%' OR tags LIKE '%$text%' OR author_id='$text' OR title LIKE '%$text%')";
  }
  
  $search_condition = substr($search_condition, 0, -4);  //去掉最后的AND
  if ($search_text)
  {
    $search_condition .= " AND " . $search_text;
  }
  // print_r($search_condition);
  return $search_condition;
}

function echo_reply_me($uid, $no=0, $num=1)
{
  require_once('config.php');
  $con=mysqli_connect(HOST, USERNAME, PASSWORD);
  mysqli_set_charset($con, "utf8");
  mysqli_select_db($con, 'experience_base');
  $result = mysqli_query($con, "SELECT * FROM eb_comments WHERE status='publish' AND
                          (p_author_id='$uid' OR reply_to_uid='$uid' OR parent_c_author_id='$uid') AND c_author_id!='$uid'
                          ORDER BY cid DESC LIMIT $no,$num");
  $row = mysqli_fetch_array($result);
  if ($row)
  {
    if ($row['type'] == 'comment')
    {
    ?>
      <p>
        <?php echo get_user_link($row['c_author_id']);?>在《<?php echo_passage_link($row['pid'], $row['cid']);?>》中回复你: 
        <a href="content.php?pid=<?php echo $row['pid'] . '#c' . $row['cid'];?>">
          <?php echo mb_substr(strip_tags($row['comment']), 0, 20, 'utf-8').'...';?>
        </a>
        <span class="pull-right"><?php echo get_readable_tm($row['create_tm']);?></span>
      </p>
    <?php
    }
    else if ($row['type'] == 'like')
    {
    ?>
      <p>
        <?php echo get_user_link($row['c_author_id']);?>赞了你的文章《<?php echo_passage_link($row['pid']);?>》
        <span class="pull-right"><?php echo get_readable_tm($row['create_tm']);?></span>
      </p>
    <?php
    }
      mysqli_close($con);
      return true;
  }
  else
  {
      mysqli_close($con);
      return false;
  }
}

function echo_notice_me($uid, $no=0, $num=1)
{
  return false;
}

?>