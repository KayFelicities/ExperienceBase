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

<!--editor-->
<link href="style/summernote/summernote.css" rel="stylesheet">
<script src="style/summernote/summernote.js"></script>
<script src="style/summernote/summernote-zh-CN.js"></script>

<!--notify-->
<link rel="stylesheet" href="style/css/animate.css">
<script src="style/js/bootstrap-notify.js"></script>

<style>
  #submit-btns, #swap-editor, #del-confirm{
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
$(document).ready(function() {
  $("#edit-btn").click(function() {
    $("#editor").summernote({
      height: 300,
      focus: true,
    });
    $("#swap-editor").val($('#editor').summernote('code'));
    $("#submit-btns").show();
  });
  $("#cancel-btn").click(function() {
    $("#editor").summernote('destroy');
    $("#editor").html($("#swap-editor").val());
    $("#submit-btns").hide();
  });
});
  
function before_edit_submit() {
  $("#swap-editor").val($('#editor').summernote('code'));
}
  
function before_delet_submit() {
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
$result = mysqli_query($con, "SELECT * FROM eb_passages WHERE pid=$pid AND status='publish'");
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

      <?php if (isset($_COOKIE["userid"]) && $p_author_id == $_COOKIE["userid"])
      {?>
        <form method="post" name="delet-form" action="content_edit_action.php" onsubmit="return before_delet_submit();">
          <input type="hidden" name="type" value="delet">
          <input type="hidden" name="pid" value="<?php echo $pid; ?>">
          <input type="hidden" name="p_author_id" value="<?php echo $p_author_id; ?>">
          <button type="button" id="delet-btn" class="btn btn-default btn-xs" onclick="$('#del-confirm').toggle();">删除文章</button>
          <div id="del-confirm">
            <input type="text" class="form-control" style="width: 30%" id="confirm" placeholder="请输入“确认”来删除文章">
            <button type="submit" id="delet" style="width: 30%" class="btn btn-danger btn-xs">删除</button>
          </div>
        </form>
        <button type="button" id="edit-btn" style="margin-top: 5px;" class="btn btn-default btn-xs">编辑内容</button>
      <?php
      }?>
    </div>

    <div id="editor">
    <?php
        echo $row['content'];
    ?>
    </div>

    <!--edit form-->
    <form id="edit-submit" method="post" action="content_edit_action.php" onsubmit="return before_edit_submit();">
        <input type="text" id="swap-editor" name="editor"></input>
        <input type="hidden" name="pid" value="<?php echo $pid; ?>">
        <input type="hidden" name="c_authur_id" value="<?php echo $p_author_id; ?>">
        <input type="hidden" name="type" value="edit">
        <div class="row" id="submit-btns">
          <div class="col-xs-9">
              <button type="submit" name="edit" class="btn btn-primary btn-block">提交</button>
          </div>  
          <div class="col-xs-3">
              <button type="button" id="cancel-btn" class="btn btn-warning btn-block">取消</button>
          </div>
        </div>
    </form>
    
    <div>
        <hr>
        <h6 id='filelist'>文件列表：</h6>
        <?php
        if ($row['file_name'])
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
              else{print_r($view_file_path);}
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
$result = mysqli_query($con, "SELECT * FROM eb_comments WHERE status='publish' and pid=$pid and type='comment'");
while ($row = mysqli_fetch_array($result))
{?>
      <div class="comments-list" id="c<?php echo $row['cid'];?>">
        <div class="comment">
          <a href="userpage.php?u=<?php echo $row['c_author_id'];?>" class="avatar">
            <img class="avatar-m" src="<?php echo get_avatar($row['c_author_id']); ?>"></img>
          </a>
          <div class="content">
            <div class="pull-right text-muted"><?php echo $row['create_tm']; ?></div>
            <div><a href="userpage.php?u=<?php echo $row['c_author_id'];?>"><strong><?php echo get_userinfo($row['c_author_id'])['nickname'];?></strong></a></div>
            <div class="text"><?php echo $row['comment'];?></div>
            <div class="actions">
              <a href="##">回复</a>
            </div>
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

<?php
mysqli_close($con);
?>

<?php echo_webfooter(); ?>
</body>

</html>