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

<!--notify-->
<link rel="stylesheet" href="style/css/animate.css">
<script src="style/js/bootstrap-notify.js"></script>

<style>
  #submit-btns, #swap-editor, #del-confirm, #change-type{
    display: none;
  }
  .comments
  {
    margin-top: 30px;
    background: #f5f5f5;
    padding: 20px;
    border: 1px solid #dddddd;
    border-radius:7px;
  }

  #pdf{
    margin: 10px 0;
  }
  .pdfobject-container { height: 600px;}
  .pdfobject { border: 0 }

</style>

<script>
function before_delete_submit() {
  if (document.getElementById("confirm").value == '确认')
  {
    return true;
  }
  else
  {
    $.notify({message: '请填写“确认”后进行删除'}, {type: 'danger'});
    return false;
  }
}
</script>

<body>
<?php include("common.php"); echo_banner("content"); ?>
<div style="margin: 60px"></div>
<div class="container">
<?php
$pid = $_GET['pid'];
require_once('config.php');
$con=mysqli_connect(HOST, USERNAME, PASSWORD);
mysqli_set_charset($con, "utf8");
mysqli_select_db($con, 'experience_base');
$search_condition = "SELECT * FROM eb_passages WHERE pid=$pid AND status='publish'";
if (isset($_COOKIE["userid"]) and get_userinfo($_COOKIE["userid"])['power'] > 1)
{
  $search_condition = "SELECT * FROM eb_passages WHERE pid=$pid";
}
$result = mysqli_query($con, $search_condition);
$row = mysqli_fetch_array($result);
if (!$row)
{
  echo "<script>location.href='404.php'</script>";
}
$p_author_id = $row['author_id'];

if (count_comment($pid) != $row['comment_num'])
{//评论数纠错
  $comment_num = count_comment($pid);
  mysqli_query($con, "UPDATE eb_passages SET comment_num='$comment_num' WHERE pid='$pid'");
  $row['comment_num'] = $comment_num;
}

if (count_like($pid) != $row['like_num'])
{//点赞数纠错
  $like_num = count_like($pid);
  mysqli_query($con, "UPDATE eb_passages SET like_num='$like_num' WHERE pid='$pid'");
  $row['like_num'] = $like_num;
}
?>
    <div class="content-header">
      <h1><?php echo $row['title']?></h1>
      <?php 
      if (is_file(IMG_FILE_STORE_PATH.'/link_pic/'.$row['pid'].'.jpg'))
      {
        echo '<img class="pull-right" style="border-radius: 5px;" src="'.IMG_FILE_PATH.'/link_pic/'.$row['pid'].'.jpg" height="100px" width="200px" alt="">';
      }
      ?>
      <div style="margin-top: 10px;">
        <?php echo_content_footer($row) ?>
      </div>
      <div style="margin-top: 10px;">
        <span>
          <?php echo_like_people($pid)?>
          <form class="form" style="display: inline;" method="post" action="comment_action.php">
            <button type="submit" name="like" style="padding: 0 5px; margin: 0 5px;" class="btn btn-primary btn-xs"><i class="icon-heart-empty"></i> 赞</button>
            <input type="hidden" name="pid" value="<?php echo $pid; ?>">
            <input type="hidden" name="p_author_id" value="<?php echo $p_author_id; ?>">
            <input type="hidden" name="type" value="like">
          </form>
        </span>
      </div>

      <?php if (isset($_COOKIE["userid"]) && ($p_author_id == $_COOKIE["userid"] or get_userinfo($_COOKIE["userid"])['power'] > 4))
      {?>
        <div style="margin-top: 5px;"></div>
        <form method="post" name="delete-form" action="content_edit_action.php" onsubmit="return before_delete_submit();">
          <input type="hidden" name="type" value="delete">
          <input type="hidden" name="pid" value="<?php echo $pid; ?>">
          <input type="hidden" name="p_author_id" value="<?php echo $p_author_id; ?>">
          <button type="button" id="delete-btn" class="btn btn-default btn-xs" onclick="$('#del-confirm').show();">删除文章</button>
          <a class="btn btn-default btn-xs" href="addex.php?pid=<?php echo $row['pid']?>">修改</a>
          <a class="btn btn-default btn-xs" href="img_select.php?type=passage&pid=<?php echo $row['pid']?>">设置文章配图</a>
          <div id="del-confirm">
            <input type="text" class="form-control" style="width: 30%" id="confirm" placeholder="请输入“确认”来删除文章">
            <button type="submit" id="delete" style="width: 3%" class="btn btn-danger btn-xs">删除</button>
            <a style="width: 27%" class="btn btn-success btn-xs" onclick="$('#del-confirm').hide();">取消</a>
          </div>
        </form>
      <?php
      }?>
    </div>

    <div class="row">
      <div id="content" class="col-md-9 col-xs-12">
          <?php
          echo $row['content'];
          ?>


    
        <div>
            <hr>
            <h6 id='filelist'>文件列表：</h6>
            <?php
            if ($row['file_name'])
            {
              if (isset($_COOKIE["userid"]))
              {
                $file_array = explode(SEPARATOR, $row['file_name']);
                for ($file_count = 0; $file_count < count($file_array); $file_count++)
                {
                    $file_name = $file_array[$file_count];
                    $file_name_array = explode('.', $file_name);
                    $save_file_path = CONTENT_FILE_PATH . sprintf("/%06d", $pid) . sprintf("_%02d.", $file_count) . end($file_name_array);
                    // echo "<div><span><a download=\"$file_name\" href=\"$save_file_path\">$file_name</a>";
                    echo "<div><span>$file_name";
                    $store_file_path = CONTENT_FILE_STORE_PATH . sprintf("/%06d", $pid) . sprintf("_%02d.pdf", $file_count);
                    $view_file_path = CONTENT_FILE_PATH . sprintf("/%06d", $pid) . sprintf("_%02d.pdf", $file_count);
                    if (file_exists($store_file_path))
                    {
                      $pdfview = "pdfview".$file_count;
                      $pdfbed = "pdfbed".$file_count;
                      echo "<span> </span><button class=\"btn btn-success btn-xs\" onclick=\"$('#$pdfview').toggle('fast');$('html,body').animate({scrollTop:$('#$pdfview').offset().top}, 200);\">预览/收起</button></span>";
                      echo "<span> </span><button class=\"btn btn-info btn-xs openpdf-btn\"><a href='pdfview.php?c=$pid&f=$file_count', target='_Blank'>全屏预览</a></button>";
                      echo "</span></div>";
                    }
                    else{echo '<span style="color: red;">（文件转码中，请稍后刷新查看。若超过5分钟文件依然无法预览，请联系管理员665593）</span>';}
                    ?>

                    <div id="<?php echo $pdfview ?>" class="pdfview">
                      <div id="<?php echo $pdfbed ?>"></div>
                      <button class="btn btn-success btn-xs" style="float: right;" onclick="$('#<?php echo $pdfview?>').toggle('fast');$('html,body').animate({scrollTop:$('#filelist').offset().top}, 200);">收起预览</button>
                      <div style="height: 20px;"></div>
                    </div>
                    <script src="style/js/pdfobject.js"></script>
                    <script>
                    if(PDFObject.supportsPDFs)
                    {
                      var options = {
                        pdfOpenParams: {
                          pagemode: "thumbs",
                          navpanes: 0,
                          toolbar: 0,
                          statusbar: 0,
                          view: "FitV"
                        }
                      };
                      PDFObject.embed("<?php echo $view_file_path?>", "#<?php echo $pdfbed ?>", options);
                    }
                    else
                    {
                      $("#<?php echo $pdfview ?>").html("抱歉，当前浏览器不支持预览，推荐使用Chrome");
                    }
                    </script>
        <?php
                }
              }
              else
              {
                echo "<div> <p><a href='login.php'>登录</a>后查看附件</p> </div>";
              }
            }
            else
            {
                echo "<p>无</p>";
            }
            ?>
        </div>

        <!--comments-->
        <div class="comments" id="excomments">
          <header>
            <h3>评论(共<?php echo count_comment($pid); ?>条)</h3>
          </header>

    <?php
    $result = mysqli_query($con, "SELECT * FROM eb_comments WHERE status='publish' and pid=$pid and parent_cid='0' and type='comment'");
    while ($row = mysqli_fetch_array($result))
    {?>
          <div class="comments-list" id="c<?php echo $row['cid'];?>">
            <div class="comment">
              <a href="userpage.php?u=<?php echo $row['c_author_id'];?>" class="avatar">
                <img class="avatar-m" src="<?php echo get_avatar($row['c_author_id']); ?>"></img>
              </a>
              <div class="content">
                <div class="pull-right text-muted"><?php echo get_readable_tm($row['create_tm']); ?></div>
                <div><a href="userpage.php?u=<?php echo $row['c_author_id'];?>"><strong><?php echo get_userinfo($row['c_author_id'])['nickname'];?></strong></a></div>
                <div class="text"><?php echo $row['comment'];?></div>
                <div class="actions">
                  <a href="##" onclick="$('#rec<?php echo $row['cid'];?>').show();
                                          $('#ct<?php echo $row['cid'];?>').focus();
                                          $('#ct<?php echo $row['cid'];?>').attr('placeholder', '');
                                          $('#cr<?php echo $row['cid'];?>').attr('value', '')">回复</a>
                </div>

    <?php
                $inline_cid = $row['cid'];
                $inline_res = mysqli_query($con, "SELECT * FROM eb_comments WHERE status='publish' and pid=$pid and parent_cid='$inline_cid' and type='comment'");
                while ($inline_row = mysqli_fetch_array($inline_res))
                {?>
                  <div class="comments-list" id="c<?php echo $inline_row['cid'];?>">
                    <div class="comment">
                      <a href="userpage.php?u=<?php echo $inline_row['c_author_id'];?>" class="avatar">
                        <img class="avatar-m" src="<?php echo get_avatar($inline_row['c_author_id']); ?>"></img>
                      </a>
                      <div class="content">
                        <div class="pull-right text-muted"><?php echo get_readable_tm($inline_row['create_tm']); ?></div>
                        <div><a href="userpage.php?u=<?php echo $inline_row['c_author_id'];?>"><strong><?php echo get_userinfo($inline_row['c_author_id'])['nickname'];?></strong></a></div>
                        <div class="text"><?php echo $inline_row['comment'];?></div>
                        <div class="actions">
                          <a href="##" onclick="$('#rec<?php echo $row['cid'];?>').show();
                                                  $('#ct<?php echo $row['cid'];?>').focus();
                                                  $('#ct<?php echo $row['cid'];?>').attr('placeholder', '回复 <?php echo get_userinfo($inline_row['c_author_id'])['nickname'];?> :');
                                                  $('#cr<?php echo $row['cid'];?>').attr('value', '<?php echo $inline_row['c_author_id'];?>')">回复</a>
                        </div>
                      </div>
                    </div>
                  </div>
                <?php
                }?>

                <form id="rec<?php echo $row['cid'];?>" class="form" style="display: none;" method="post" action="comment_action.php">
                  <input type="hidden" name="pid" value="<?php echo $pid; ?>">
                  <input type="hidden" name="p_author_id" value="<?php echo $p_author_id; ?>">
                  <input type="hidden" name="parent_cid" value="<?php echo $row['cid']; ?>">
                  <input type="hidden" name="parent_c_author_id" value="<?php echo $row['c_author_id']; ?>">
                  <input type="hidden" id="cr<?php echo $row['cid'];?>" name="reply_to_uid" value="">
                  <input type="hidden" name="type" value="comment">
                  <div class="form-group">
                      <textarea id="ct<?php echo $row['cid'];?>" class="form-control" name="comment" rows="2" placeholder="回复@<?php echo get_userinfo($row['c_author_id'])['nickname'];?> :" required></textarea>
                      <button type="submit" class="btn btn-primary btn-ubmargin pull-right">提交</button>
                      <div style="margin: 50px"></div>
                  </div>
                </form>
              </div>
            </div>
          </div>
    <?php
    }
    ?>


        <footer>
  <?php 
  if (isset($_COOKIE["userid"]))
  {
  ?>
          <div class="reply-form">
            <a href="###" class="avatar"><img class="avatar-m" src="<?php echo get_avatar($_COOKIE["userid"]);?>"></img></a>
            <form class="form" method="post" action="comment_action.php">
              <input type="hidden" name="pid" value="<?php echo $pid; ?>">
              <input type="hidden" name="p_author_id" value="<?php echo $p_author_id; ?>">
              <input type="hidden" name="type" value="comment">
              <div class="form-group">
                  <textarea class="form-control" name="comment" rows="2" placeholder="撰写评论..." required></textarea>
                  <button type="submit" class="btn btn-primary btn-ubmargin pull-right">提交评论</button>
                  <div style="margin: 50px"></div>
              </div>
            </form>
          </div>
  <?php
  }
  else
  {
  ?>
          <div>
            <p><a href="login.php">登录</a>后回复</p>
          </div>
  <?php
  }
  ?>
        </footer>
      </div>


    </div>
    <div id="content" class="col-md-3 col-xs-12">
      <div class="panel panel-default">
        <div class="panel-heading">
          <h3 class="panel-title">
            为您推荐
            <span class="pull-right">
              <!-- <a href="##" class="btn btn-xs btn-default">更多</a> -->
            </span>
          </h3>
        </div>
        <div class="panel-body">
          <?php 
            for ($count=0; $count < 15; $count++)
            {
              if (!echo_content_title($count, $with_type=false, $type=get_passage_info($pid)['extype1']))
              {
                break;
              }
            }
          ?>
        </div>
      </div>
    </div>
  </div>
</div>

<?php
mysqli_close($con);
?>

<?php echo_webfooter(); ?>
</body>

</html>