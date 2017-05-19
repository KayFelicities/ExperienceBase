<!DOCTYPE HTML>
<html>
<meta name="renderer" content="webkit"> 
<meta charset="UTF-8">
<title>经验分享平台</title>
<link rel="bookmark" type="image/x-icon" href="img/+1.ico" />
<link rel="shortcut icon" href="img/+1.ico">
<link rel="icon" href="img/+1.ico">

<body>
    <div id="pdfview"></div>
    <script src="style/js/pdfobject.js"></script>
    <script>
    if(PDFObject.supportsPDFs)
    {
      var view_file_path = "<?php require_once('config.php'); echo CONTENT_FILE_PATH . sprintf("/%06d", $_GET['c']) . sprintf("_%02d.pdf", $_GET['f']);?>";
      PDFObject.embed(view_file_path);
    }
    else
    {
      $("#pdfview").html("抱歉，当前浏览器不支持预览，推荐使用Chrome");
    }
    </script>
</body>
</html>