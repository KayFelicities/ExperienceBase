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

<!--fileinput-->
<link rel="stylesheet" href="style/css/fileinput.css">
<script src="style/js/fileinput/canvas-to-blob.js"></script>
<script src="style/js/fileinput/fileinput.js"></script>
<script src="style/js/fileinput/zh.js"></script>

<body>
<?php include("common.php"); echo_banner("myconfig"); ?>
<div style="margin: 60px"></div>
<div class="container">
  <p>欢迎您，<?php if (isset($_COOKIE["userid"]))echo get_userinfo($_COOKIE["userid"])['nickname'];else echo "游客";?></p>
  <input id="input" name="file" type="file" multiple class="file-loading">
  <!--<div id="errorBlock" class="help-block"></div>-->
  <script>
  $(document).on('ready', function() {
      $("#input").fileinput({
          language: 'zh',
          // uploadUrl: './uploader.php',
          allowedFileExtensions : ['doc', 'docx', 'ppt', 'pptx', 'pdf', 'jpg', 'png'],
          minFileCount: 0,
          maxFilesNum: 10,
          maxFilePreviewSize: 10240
      });
  });
  </script>
</div>

</body>

</html>