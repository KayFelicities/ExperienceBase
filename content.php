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

<!--editor-->
<link href="style/summernote/summernote.css" rel="stylesheet">
<script src="style/summernote/summernote.js"></script>
<script src="style/summernote/summernote-zh-CN.js"></script>

<style>
  #edit-btn
  {
    float: right;
  }
  #submit-btns, #swap-editor, .pdfview{
    display: none;
  }
  #edit-btn
  {
    float: right;
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
</script>

<body>
<?php include("common.php"); echo_banner("content"); ?>
<div style="margin: 60px"></div>
<div class="container">
<?php
$cid = $_GET['cid'];
require_once('config.php');
$con=mysqli_connect(HOST, USERNAME, PASSWORD);
mysqli_set_charset($con, "utf8");
mysqli_select_db($con, 'experience_base');
$result = mysqli_query($con, "SELECT * FROM eb_contents WHERE cid=$cid");
$row = mysqli_fetch_array($result);
$c_author_id = $row['author_id'];

if (count_comment($cid) != $row['comment_num'])
{//评论数纠错
  $comment_num = count_comment($cid);
  mysqli_query($con, "UPDATE eb_contents SET comment_num='$comment_num' WHERE cid='$cid'");
  $row['comment_num'] = $comment_num;
}
?>
    <div class="content-header">
        <h1><?php echo $row['title']?></h1>

        <a href="#" class="text-muted"><img class="avatar-xs" src="<?php echo get_avatar($c_author_id); ?>" /> <?php echo get_userinfo($row['author_id'])['nickname'];?></a>
        &nbsp; &nbsp; 
        <a href="#" class="text-muted"><i class="icon-comments"></i> <?php echo $row['comment_num'];?></a> 
        &nbsp; &nbsp; 
        <span class="text-muted"><i class="icon-time"></i> <?php echo $row['create_tm'];?></span>
        &nbsp; &nbsp; 
        <?php
        $tags_array = explode(SEPARATOR, $row['tags']);
        foreach ($tags_array as $tag)
        {?>
          <span class="label label-success"><?php echo $tag;?></span>
          <?php
        }?>
        <!--<button id="edit-btn" class="btn btn-default btn-xs">修改</button>-->

    </div>

    <div id="editor">
    <?php
        echo $row['content'];
    ?>
    </div>

    <!--edit form-->
    <form method="post" action="content_edit_action.php" onsubmit="return befor_submit();">
        <input type="text" id="swap-editor" name="editor"></input>
        <div class="row" id="submit-btns">
        <div class="col-xs-9">
            <button type="submit" class="btn btn-primary btn-block">提交</button>
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
              $save_file_path = CONTENT_FILE . sprintf("/%06d", $cid) . sprintf("_%02d.", $file_count) . end($file_name_array);
              echo "<div><span><a download=\"$file_name\" href=\"$save_file_path\">$file_name</a>";
              $view_file_path = CONTENT_FILE . sprintf("/%06d", $cid) . sprintf("_%02d.pdf", $file_count);
              if (file_exists($view_file_path))
              {
                $pdfview = "pdfview".$file_count;
                $pdfbed = "pdfbed".$file_count;
                echo "<span> </span><button class=\"btn btn-success btn-xs\" onclick=\"$('#$pdfview').toggle('fast');$('html,body').animate({scrollTop:$('#$pdfview').offset().top}, 200);\">预览文件</button></span>";
                echo "<span> </span><button class=\"btn btn-info btn-xs openpdf-btn\"><a href='pdfview.php?c=$cid&f=$file_count', target='_Blank'>全屏预览</a></button>";
                echo "</span></div>";
              }
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
        <h3>评论(共<?php echo count_comment($cid); ?>条)</h3>
      </header>

<?php
$result = mysqli_query($con, "SELECT * FROM eb_comments WHERE cid=$cid");
while ($row = mysqli_fetch_array($result))
{?>
      <div class="comments-list">
        <div class="comment">
          <a href="###" class="avatar">
            <img class="avatar-m" src="<?php echo get_avatar($row['co_author_id']); ?>"></img>
          </a>
          <div class="content">
            <div class="pull-right text-muted"><?php echo $row['create_tm']; ?></div>
            <div><a href="###"><strong><?php echo get_userinfo($row['co_author_id'])['nickname'];?></strong></a></div>
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
            <input type="hidden" name="cid" value="<?php echo $cid; ?>">
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
</body>

</html>