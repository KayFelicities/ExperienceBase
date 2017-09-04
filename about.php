<!DOCTYPE HTML>
<html>
<meta name="renderer" content="webkit"> 
<meta charset="UTF-8">
<title>经验共享平台</title>
<link rel="bookmark" type="image/x-icon" href="img/+1.ico" />
<link rel="shortcut icon" href="img/+1.ico">
<link rel="icon" href="img/+1.ico">
<link rel="stylesheet" href="style/css/bootstrap.css">
<script src="style/js/jquery.js"></script>
<script src="style/js/bootstrap.js"></script>

<!--editor-->
<link href="style/summernote/summernote.css" rel="stylesheet">
<script src="style/summernote/summernote.js"></script>
<script src="style/summernote/summernote-zh-CN.js"></script>

<style>
  #myeditor {
    margin-top: 10px;
  }
  #submit-btns, #swap-editor{
    display: none;
  }
  #edit-btn
  {
    float: right;
  }
</style>

<script>
$(document).ready(function() {
  $("#edit-btn").click(function() {
    var $summernote = $('#editor').summernote({
      focus: true,
      callbacks: {
          onImageUpload: function (files) {
              sendFile($summernote, files[0]);
          }
      }
    });
    $("#swap-editor").val($('#editor').summernote('code'));
    $("#submit-btns").show();
  });
  $("#cancel-btn").click(function() {
    $("#editor").summernote('destroy');
    $("#editor").html($("#swap-editor").val());
    $("#submit-btns").hide();
  });

  //ajax上传图片
  function sendFile($summernote, file) {
      var formData = new FormData();
      formData.append("file", file);
      formData.append("dir", 'about');
      $.ajax({
          url: "upload_img_ajax.php",//路径是你控制器中上传图片的方法，下面controller里面我会写到
          data: formData,
          cache: false,
          contentType: false,
          processData: false,
          type: 'POST',
          success: function (data) {
              $summernote.summernote('insertImage', data, function ($image) {
                  $image.attr('src', data);
                  $image.css('width', '50%');
              });
          }
      });
  }
});

function before_submit() {
  $("#swap-editor").val($('#editor').summernote('code'));
}
</script>

<body>
<?php include("common.php"); echo_banner("about"); ?>
<div style="margin: 60px"></div>

<div class="container">
  <header>
    <h3><i></i> 经验共享平台 
      <small>A1班 工匠组 <a class="btn btn-xs btn-default pull-right" href="statistic.php">查看统计信息</a></small>
      <?php 
      if (isset($_COOKIE["userid"]) and get_userinfo($_COOKIE["userid"])['power'] > 1)
        echo '<button id="edit-btn" class="btn btn-default btn-xs">修改</button>';
      ?>
    </h3>
  </header>
  <hr>

  <!--about-->
  <div id="about">
  <?php
  require_once('config.php');
  $con=mysqli_connect(HOST, USERNAME, PASSWORD);
  mysqli_set_charset($con, "utf8");
  mysqli_select_db($con, 'experience_base');
  $result = mysqli_query($con, "SELECT * FROM eb_others WHERE name='about'");
  $row = mysqli_fetch_array($result);
  if ($row)
  {
    echo "<div id='editor'>";
    echo $row['content'];
    echo "</div>";
  }
  else
  {
    mysqli_query($con, "INSERT INTO eb_others(name) VALUES('about')");
  }
  ?>
  </div>

  <!--edit form-->
  <form method="post" action="about_edit_action.php" onsubmit="return before_submit();">
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

  <hr>
  <a href="dev_log.php">开发日志</a>
  <div style="margin-top: 100px;"></div>
</div>

<?php echo_webfooter(); ?>
</body>

</html>