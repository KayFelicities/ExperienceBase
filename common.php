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
          <li class="dropdown <?php if (in_array($page_name, array(" 软件 ", "硬件 ", "结构件 ", "流程 ")))echo "active "; ?>">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">分类<span class="caret"></span></a>
            <ul class="dropdown-menu">
              <li><a href="content_list.php?p=0&t=软件">软件</a></li>
              <li><a href="content_list.php?p=0&t=硬件">硬件</a></li>
              <li><a href="content_list.php?p=0&t=结构件">结构件</a></li>
              <li><a href="content_list.php?p=0&t=流程">流程</a></li>
              <!--<li role="separator" class="divider"></li>-->
            </ul>
          </li>
          <li <?php if ($page_name=="about" ){echo 'class="active"';}?> ><a href="about.php">关于</a></li>
        </ul>
        <ul class="nav navbar-nav navbar-right">
          <li <?php if ($page_name=="add_ex" ){echo 'class="active"';}?> ><a href="addex.php">添加经验</a></li>

          <?php
    if (isset($_COOKIE["userid"]))
    {?>
            <li <?php if ($page_name=="mypage" ){echo 'class="active"';}?> >
              <a href="mypage.php">
                <?php echo get_userinfo($_COOKIE["userid"])['nickname'];?>
              </a>
            </li>
            <?php
    }
    else
    {?>
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

function echo_content_item($no, $type="")
{
    require_once('config.php');
    $con=mysqli_connect(HOST, USERNAME, PASSWORD);
    mysqli_set_charset($con, "utf8");
    mysqli_select_db($con, 'experience_base');
    if ($type)
    {
        $result = mysqli_query($con, "SELECT * FROM eb_contents WHERE extype1='$type' ORDER BY cid DESC LIMIT $no,1");
    }
    else
    {
        $result = mysqli_query($con, "SELECT * FROM eb_contents ORDER BY cid DESC LIMIT $no,1");
    }
    $row = mysqli_fetch_array($result);
    if($row)
    {
        ?>
    <div class="item">
      <div class="item-heading">
        <h4><a href="content.php?cid=<?php echo $row['cid'];?>"><?php echo $row['title'];?></a></h4>
      </div>
      <div class="item-content">
        <div class="media pull-right"><img src="img/logo.png" alt=""></div>
        <div class="text">
          <?php echo mb_substr(strip_tags($row['content']), 0, 200, 'utf-8').'...';?>
        </div>
      </div>
      <div class="item-footer">
        <a href="#" class="text-muted">
          <?php echo $row['extype1'];?>
        </a>
        <span> ></span>
        <a href="#" class="text-muted">
          <?php echo $row['extype2'];?>
        </a>
        &nbsp; &nbsp;
        <a href="#" class="text-muted"><i class="icon-user"></i> <?php echo get_userinfo($row['author_id'])['nickname'];?></a> &nbsp; &nbsp;
        <a href="#" class="text-muted"><i class="icon-comments"></i> <?php echo $row['comment_num'];?></a> &nbsp; &nbsp;
        <span class="text-muted"><i class="icon-time"></i> <?php echo $row['create_tm'];?></span> &nbsp;
        <?php
        $tags_array = explode(',', $row['tags']);
        foreach ($tags_array as $tag)
        {?>
          <span class="label label-success"><?php echo $tag;?></span>
          <?php
        }?>
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

function count_content($type="")
{
    require_once('config.php');
    $con=mysqli_connect(HOST, USERNAME, PASSWORD);
    mysqli_set_charset($con, "utf8");
    mysqli_select_db($con, 'experience_base');
    if ($type)
    {
        $result = mysqli_query($con, "SELECT COUNT(*) AS count FROM eb_contents WHERE extype1='$type'");
    }
    else
    {
        $result = mysqli_query($con, "SELECT COUNT(*) AS count FROM eb_contents");
    }
    $count = mysqli_fetch_array($result)['count'];
    mysqli_close($con);
    return $count;
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
?>