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
<script src="style/js/jquery.cropit.js"></script>
<!--notify-->
<link rel="stylesheet" href="style/css/animate.css">
<script src="style/js/bootstrap-notify.js"></script>


<?php
  include("common.php"); 
  if (isset($_GET['type'])) $type = $_GET['type'];
  else header("Refresh: 1; url=404.php");

  if ($type == 'passage' and isset($_GET['pid']))
  {?>
    <style>
      .cropit-preview {
          background-color: #f8f8f8;
          background-size: cover;
          border: 1px solid #ccc;
          border-radius: 3px;
          margin-top: 7px;
          width: 300px;
          height: 150px;
      }
      .cropit-preview-background {
          opacity: .2;
      }
      input.cropit-image-zoom-input {
          position: relative;
      }
      #image-cropper {
          overflow: hidden;
      }
    </style>

    <script>
    function img_submit() {
      var imageData = $('#image-cropper').cropit('export', {type: "image/jpeg", quality: .6});
      if (imageData) {$('#png-src').val(imageData);return true;}
      else {$.notify({message: '请选择图片'}, {type: 'danger'});return false;}
    }
    </script>
  <?php
  }
  else if ($type == 'avatar' and isset($_GET['uid']))
  {?>
    <style>
      .cropit-preview {
          background-color: #f8f8f8;
          background-size: cover;
          border: 1px solid #ccc;
          border-radius: 3px;
          margin-top: 7px;
          width: 200px;
          height: 200px;
      }
      .cropit-preview-background {
          opacity: .2;
      }
      input.cropit-image-zoom-input {
          position: relative;
      }
      #image-cropper {
          overflow: hidden;
      }
    </style>

    <script>
    function img_submit() {
      var imageData = $('#image-cropper').cropit('export');
      if (imageData) {$('#png-src').val(imageData);return true;}
      else {$.notify({message: '请选择图片'}, {type: 'danger'});return false;}
    }
    </script>
  <?php
  }
  else
  {
    header("Refresh: 1; url=404.php");
  }
  ?>


<body>

<?php
  if (isset($_POST['png']))
  {
    if (!isset($_COOKIE["userid"]))
    {
      echo ("<script>$.notify({message: '请先登录'}, {type: 'danger'});</script>");
      header("Refresh: 1; url=login.php");
    }
    $login_id = $_COOKIE["userid"];
    $base_img = $_POST['png'];

    require_once('config.php');
    $path = '';
    if ($type == 'passage' && isset($_GET['pid']))
    {
      $pid = $_GET['pid'];
      if (get_passage_info($pid)['author_id'] == $login_id or get_userinfo($login_id)['power'] > 1)
      {
        $path = IMG_FILE_STORE_PATH.'/link_pic/'.$_GET['pid'].'.jpg';
      }
    }
    else if ($type == 'avatar' && isset($_GET['uid']))
    {
      $uid = $_GET['uid'];
      if ($uid == $login_id or get_userinfo($login_id)['group'] == 'admin')
      {
        $path = IMG_FILE_STORE_PATH.'/avatar/'.$_GET['uid'].'.png';
      }
    }

    if ($path)
    {
      $base_img = explode('base64,', $base_img, 2)[1];
      file_put_contents($path, base64_decode($base_img));
      echo ("<script>$.notify({message: '更改成功！'}, {type: 'success'});</script>");
    }
    else
    {
      echo ("<script>$.notify({message: '权限错误！'}, {type: 'danger'});</script>");
    }
  }
?>

<?php echo_banner("content"); ?>
<div style="margin: 60px"></div>

<div class="container">
  <div class="page-header">
      <h3>选择图片<small id="img-brief"></small></h3>
  </div>

  <p>当前图片:</p>
  <?php
  require_once('config.php');
  if ($type == 'passage')
  {
    $pid = $_GET['pid'];
    $passage_title = get_passage_info($pid)['title'];
    echo '<script>$("#img-brief").html(" 设置文章《'.$passage_title.'》的配图")</script>';
    if (is_file(IMG_FILE_STORE_PATH.'/link_pic/'.$pid.'.jpg'))
    {
      $link_img_path = IMG_FILE_PATH.'/link_pic/'.$pid.'.jpg';
      echo '<img src="'.$link_img_path.'" width="300px">';
    }
    else
    {
      echo '<p>空</p>';
    }
  }
  else if($type == 'avatar')
  {
    $uid = $_GET['uid'];
    $avatar_path = get_avatar($uid);
    echo '<img src="'.$avatar_path.'" width="200px">';
    $user_name = get_userinfo($uid)['nickname'];
    echo '<script>$("#img-brief").html(" 设置'.$user_name.'的头像")</script>';
  }
  ?>
  
  <hr>
  <p>请选择或直接拖入图片进行图片裁剪:</p>
  <div id="image-cropper" style="margin: auto;">
    <div class="cropit-preview"></div>
    <div class="form-group">
      <input type="file" id="file" class="cropit-image-input" style="display:none"/>
      <a class="btn btn-default" onclick="$('#file').click();">选择图片</a>
      <input type="range" class="cropit-image-zoom-input" />
    </div>
    <form method="post" onsubmit="return img_submit();">
      <input type="text" id="png-src" name="png"  style="display:none"/>
      <button class="btn btn-primary">确定</button>
    </form>
  </div>
</div>

  <script>
    $('#image-cropper').cropit({
      // imageBackground: true,
      maxZoom: 1.5,
      exportZoom: 2,
    });
  </script>
</body>
</html>
