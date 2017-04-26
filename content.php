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
  #submit-btns, #swap-editor, #pdfview{
    display: none;
  }
  #edit-btn
  {
    float: right;
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
  $(".showpdf-btn").click(function() {
    $("#pdfview").toggle("fast");
    $('html,body').animate({scrollTop:$('#pdfview').offset().top}, 200);
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
?>
    <div class="content-header">
        <h1><?php echo $row['title']?></h1>

        <a href="#" class="text-muted"><i class="icon-user"></i> <?php echo get_userinfo($row['author_id'])['nickname'];?></a>
        &nbsp; &nbsp; 
        <a href="#" class="text-muted"><i class="icon-comments"></i> <?php echo $row['comment_num'];?></a> 
        &nbsp; &nbsp; 
        <span class="text-muted"><i class="icon-time"></i> <?php echo $row['create_tm'];?></span>
        &nbsp; &nbsp; 
        <?php
        $tags_array = explode(',', $row['tags']);
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
        <h6>文件列表：</h6>
        <?php
        if ($row['file_name'])
        {
            $file_name = $row['file_name'];
            $file_name_array = explode('.', $file_name);
            $save_file_path = CONTENT_FILE . sprintf("/%06d", $cid) . "_01." . end($file_name_array);
            echo "<span><a download=\"$file_name\" href=\"$save_file_path\">$file_name</a>";
            $view_file_path = CONTENT_FILE . sprintf("/%06d", $cid) . "_01.pdf";
            if (file_exists($view_file_path))
            {
              echo "<span> </span><button class=\"btn btn-primary btn-xs showpdf-btn\">预览文件</button></span>";
              echo "<span> </span><button class=\"btn btn-danger btn-xs openpdf-btn\"><a href='pdfview.php?c=$cid', target='_Blank'>全屏预览</a></button></span>";
            }
            ?>

            <div id="pdfview">
              <div id="pdf"></div>
              <button class="btn btn-primary btn-xs showpdf-btn" style="float: right;">收起预览</button>
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
              PDFObject.embed("<?php echo $view_file_path?>", "#pdf", options);
            }
            else
            {
              $("#pdf").html("抱歉，当前浏览器不支持预览，推荐使用Chrome");
            }
            </script>
<?php
        }
        else
        {
            echo "<p>无</p>";
        }
        ?>
    </div>

</div>

</body>

</html>