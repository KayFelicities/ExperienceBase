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
    $("#extype2").append("<option>外部异常分析</option>");
    $("#extype2").append("<option>内部异常分析</option>");
    $("#extype2").append("<option>技术规范</option>");
    $("#extype2").append("<option>管理制度</option>");
    $("#extype2").append("<option>开发经验分享</option>");
    $("#extype2").append("<option>测试经验分享</option>");
    $("#extype2").append("<option>行业信息</option>");

  $("#extype1").change(function() {
    $("#extype2").empty();
    var type1 = $("#extype1").val();
    switch (type1)
    {
      case "软件":
        $("#extype2").append("<option>外部异常分析</option>");
        $("#extype2").append("<option>内部异常分析</option>");
        $("#extype2").append("<option>技术规范</option>");
        $("#extype2").append("<option>管理制度</option>");
        $("#extype2").append("<option>开发经验分享</option>");
        $("#extype2").append("<option>测试经验分享</option>");
        $("#extype2").append("<option>行业信息</option>");
        break;
      case "硬件":
        $("#extype2").append("<option>外部异常分析</option>");
        $("#extype2").append("<option>内部异常分析</option>");
        $("#extype2").append("<option>技术规范</option>");
        $("#extype2").append("<option>管理制度</option>");
        $("#extype2").append("<option>开发经验分享</option>");
        $("#extype2").append("<option>测试经验分享</option>");
        $("#extype2").append("<option>行业信息</option>");
        break;
      case "结构件":
        $("#extype2").append("<option>外部异常分析</option>");
        $("#extype2").append("<option>内部异常分析</option>");
        $("#extype2").append("<option>技术规范</option>");
        $("#extype2").append("<option>管理制度</option>");
        $("#extype2").append("<option>开发经验分享</option>");
        $("#extype2").append("<option>测试经验分享</option>");
        $("#extype2").append("<option>行业信息</option>");
        break;
      case "综合":
        $("#extype2").append("<option>外部异常分析</option>");
        $("#extype2").append("<option>内部异常分析</option>");
        $("#extype2").append("<option>技术规范</option>");
        $("#extype2").append("<option>管理制度</option>");
        $("#extype2").append("<option>开发经验分享</option>");
        $("#extype2").append("<option>测试经验分享</option>");
        $("#extype2").append("<option>行业信息</option>");
        $("#extype2").append("<option>其他</option>");
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
              <option>综合</option>
            </select>
          </div>
          <div id="software-options" class="col-xs-2" style="padding: 0;">
            <select id="extype2" name="extype2" class="form-control">
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
            var $summernote = $('#editor').summernote({
              height: 300,
              placeholder: '写下你的经验...',
              callbacks: {
                  onImageUpload: function (files) {
                      sendFile($summernote, files[0]);
                  }
              }
            });

            //ajax上传图片
            function sendFile($summernote, file) {
                var formData = new FormData();
                formData.append("file", file);
                formData.append("dir", 'content');
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
                        allowedFileExtensions : ['doc', 'docx', 'ppt', 'pptx', 'pdf'],
                        // minFileCount: 0,
                        maxFilesNum: 10,
                        showUpload: false,
                        showRemove: true,
                        showCaption: true,//是否显示输入框
                        maxFileSize: 8000,
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
              <select id="tagselect" name="labels" class="form-control" multiple="multiple" required>
                <optgroup label="请自行输入标签">
                </optgroup>
              </select>
            </div>
          </div>

          <button id="submitbtn" type="submit" class="btn btn-primary btn-block">提交经验</button>

        </div>
      </from>

<?php echo_webfooter(); ?>
</body>

</html>