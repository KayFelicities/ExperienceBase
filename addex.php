<!DOCTYPE HTML>
<html>
<meta name="renderer" content="webkit"> 
<meta charset="UTF-8">
<title>经验分享平台</title>
<link rel="bookmark" type="image/x-icon" href="img/+1.ico">
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

<link href="style/css/select2.css" rel="stylesheet">
<script src="style/js/select2.js"></script>

<!--fileinput-->
<link rel="stylesheet" href="style/css/fileinput.css">
<script src="style/js/fileinput/canvas-to-blob.js"></script>
<script src="style/js/fileinput/fileinput.js"></script>
<script src="style/js/fileinput/zh.js"></script>

<!--notify-->
<link rel="stylesheet" href="style/css/animate.css">
<script src="style/js/bootstrap-notify.js"></script>

<style>
  #myeditor {
    margin-top: 10px;
  }
  
  #swap-editor, #swap-tags {
    display: none;
  }
</style>

<script>
$(document).ready(function() {
  $("#extype1").change(function() {
    $("#extype2").empty();
    var type1 = $("#extype1").val();
    switch (type1)
    {
      case "软件":
        $("#extype2").append("<option>业务逻辑</option>");
        $("#extype2").append("<option>需求理解</option>");
        $("#extype2").append("<option>编程技巧</option>");
        $("#extype2").append("<option>单元测试</option>");
        break;
      case "硬件":
        $("#extype2").append("<option>电路设计</option>");
        $("#extype2").append("<option>元器件特性</option>");
        $("#extype2").append("<option>元器件选型</option>");
        $("#extype2").append("<option>PCB设计</option>");
        $("#extype2").append("<option>测试技巧</option>");
        break;
      case "结构件":
        $("#extype2").append("<option>CAD设计</option>");
        $("#extype2").append("<option>3D建模</option>");
        break;
      case "制度":
        $("#extype2").append("<option>制度1</option>");
        $("#extype2").append("<option>制度2</option>");
        $("#extype2").append("<option>制度3</option>");
        break;
      default:
        alert("err");
    }
  });

  $("#tagselect").select2({
    placeholder: "选择标签（可输入新标签）",
    maximumSelectionLength: 5,
    minimumResultsForSearch: 3,
    tags: true
  });
})

  function before_submit() {
<?php 
if (isset($_COOKIE["userid"]))
{?>
    $("#swap-editor").val($("#editor").summernote('code'));
    $("#swap-tags").val($("#tagselect").val());
    $.notify({message: '经验正在提交中，请稍后……'}, {type: 'info', delay: 0});
<?php
}
else
{?>
    $.notify({message: '登录后才能提交经验！'}, {type: 'danger'});
    return false;
<?php
}
?>
  }
</script>

<body>
  <?php include("common.php"); echo_banner("add_ex"); ?>

    <div style="margin:50px;">
    </div>

    <form name="addex" method="post" enctype="multipart/form-data" action="addex_action.php" onsubmit="return before_submit();">
      <input type="text" name="editor" id="swap-editor" />
      <input type="text" name="tags" id="swap-tags" />
      <div class="container">
        <div class="page-header">
          <h1>添加经验<small></small></h1>
        </div>
        <div class="row">
          <div id="main-options" class="col-xs-2" style="padding-right: 0;">
            <select id="extype1" name="extype1" class="form-control">
              <option>软件</option>
              <option>硬件</option>
              <option>结构件</option>
              <option>制度</option>
            </select>
          </div>
          <div id="software-options" class="col-xs-2" style="padding: 0;">
            <select id="extype2" name="extype2" class="form-control">
              <option>业务逻辑</option>
              <option>需求理解</option>
              <option>编程技巧</option>
              <option>单元测试</option>
            </select>
          </div>
          <div class="col-xs-8">
            <input name="title" class="form-control" placeholder="请输入标题" required autofocus></input>
          </div>
        </div>

        <!--editor-->
        <div id="myeditor">
          <div id="editor"></div>
        </div>
          <script>
          $(document).ready(function() {
            $('#editor').summernote({
              placeholder: '写下你的经验...',
            });
          });
        </script>

        <!--file-->
        <div class="row">
          <div class="col-xs-6" style="margin-top:20px">
            <div class="form-group">
              <p>插入经验文档：(支持上传文件类型：doc/docx/ppt/pptx/pdf)</p>
                <input id="input" name="file[]" type="file" multiple class="file-loading">
                <script>
                $(document).on('ready', function() {
                    $("#input").fileinput({
                        language: 'zh',
                        // uploadUrl: './uploader.php',
                        allowedFileExtensions : ['doc', 'docx', 'ppt', 'pptx', 'pdf', 'jpg', 'png'],
                        // minFileCount: 0,
                        maxFilesNum: 10,
                        showUpload: false,
                        showRemove: true,
                        showCaption: true,//是否显示输入框
                        maxFilePreviewSize: 10240
                    });
                });
                </script>
              </div>
            </div>
          </div>

          <!--Tags-->
          <div class="row">
            <div class="col-xs-6" style="margin-bottom: 10px">
              <select id="tagselect" name="labels" class="form-control" multiple="multiple">
                <optgroup label="请自行输入标签">
                </optgroup>
              </select>
            </div>
          </div>

          <button id="submitbtn" type="submit" class="btn btn-primary btn-block">提交经验</button>

        </div>
      </from>
</body>

</html>