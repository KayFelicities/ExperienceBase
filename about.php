<!DOCTYPE HTML>
<html>
<meta charset="UTF-8">
<title>经验分享平台</title>
<link rel="bookmark" type="image/x-icon" href="+1.ico" />
<link rel="shortcut icon" href="+1.ico">
<link rel="icon" href="+1.ico">
<link rel="stylesheet" href="style/css/bootstrap.css">
<link rel="stylesheet" href="style/css/carousel.css">
<link href="style/editor/google-code-prettify/prettify.css" rel="stylesheet">
<script src="style/js/jquery.js"></script>
<script src="style/js/bootstrap.js"></script>
<script src="style/editor/bootstrap-wysiwyg.js"></script>
<script src="style/editor/jquery.hotkeys.js"></script>
<script src="style/editor/google-code-prettify/prettify.js"></script>

<style>
  #editor {
    max-height: 250px;
    height: 250px;
    background-color: white;
    border-collapse: separate;
    border: 1px solid rgb(204, 204, 204);
    padding: 4px;
    box-sizing: content-box;
    -webkit-box-shadow: rgba(0, 0, 0, 0.0745098) 0px 1px 1px 0px inset;
    box-shadow: rgba(0, 0, 0, 0.0745098) 0px 1px 1px 0px inset;
    border-top-right-radius: 3px;
    border-bottom-right-radius: 3px;
    border-bottom-left-radius: 3px;
    border-top-left-radius: 3px;
    overflow: scroll;
    outline: none;
  }
  #myeditor {
    margin-top: 10px;
  }
  #myeditor, #submit-btns, #swap-editor{
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
    $("#edit-btn").hide();
    $("#about").hide();
    $("#myeditor").show();
    $("#submit-btns").show();
    $("#editor").html($("#about").html());
  });
  $("#cancel-btn").click(function() {
    $("#myeditor").hide();
    $("#submit-btns").hide();
    $("#edit-btn").show();
    $("#about").show();
  });
});

function befor_submit() {
  $("#swap-editor").val($("#editor").html());
}
</script>

<body>
<?php include("common.php"); echo_banner("about"); ?>
<div style="margin: 60px"></div>

<div class="container">
  <header>
    <h3><i></i> 经验分享平台 <small>A1班 工匠组</small><button id="edit-btn" class="btn btn-default btn-xs">修改</button></h3>
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
    echo $row['content'];
  }
  else
  {
    mysqli_query($con, "INSERT INTO eb_others(name) VALUES('about')");
  }
  ?>
  </div>

  <!--editor-->
  <form method="post" action="about_edit_action.php" onsubmit="return befor_submit();">
    <?php echo_editor();?>
    <div class="row" id="submit-btns">
      <div class="col-xs-9">
        <button type="submit" class="btn btn-primary btn-block">提交</button>
      </div>  
      <div class="col-xs-3">
        <button type="button" id="cancel-btn" class="btn btn-warning btn-block">取消</button>
      </div>
    </div>
    <input type="text" id="swap-editor" name="editor"></input>
  </form>

  <hr>
  <a href="dev_log.php">开发日志</a>
</div>

</body>

</html>