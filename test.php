<!DOCTYPE HTML>
<html>
<meta charset="UTF-8">
<title>经验分享平台</title>
<link rel="bookmark" type="image/x-icon" href="+1.ico" />
<link rel="shortcut icon" href="+1.ico">
<link rel="icon" href="+1.ico">
<link rel="stylesheet" href="style/css/bootstrap.css">
<link rel="stylesheet" href="style/css/carousel.css">
<script src="style/js/jquery.js"></script>
<script src="style/js/bootstrap.js"></script>

<link href="style/summernote/summernote.css" rel="stylesheet">
<script src="style/summernote/summernote.js"></script>
<script src="style/summernote/summernote-zh-CN.js"></script>

<script>
  $(document).ready(function() {
    $('#summernote').summernote({
      
    });
    $('#test-btn').click(function(){
      var markupStr = $('#summernote').summernote('code');
      alert(markupStr);
    })
  });
</script>


<body>
  <?php include("common.php"); echo_banner("hardware"); ?>
  <div style="margin: 60px"></div>
  <div class="container">
    <div id="summernote">
      <p>Hello Summernote</p>
    </div>
    <button id="test-btn" class="btn btn-primary">test</button>

  </div>


</body>

</html>