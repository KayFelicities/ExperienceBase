<!DOCTYPE HTML>
<html>
<meta name="renderer" content="webkit"> 
<meta charset="UTF-8">
<title>经验共享平台</title>
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
  
  #swap-editor, #swap-tags, #file-list, #pid {
    display: none;
  }
</style>

<?php include("common.php"); ?>

<script>
$(document).ready(function() {
    $("#extype2").append("<option>外部异常分析</option>");
    $("#extype2").append("<option>内部异常分析</option>");
    $("#extype2").append("<option>开发经验共享</option>");
    $("#extype2").append("<option>测试经验共享</option>");
    $("#extype2").append("<option>行业信息</option>");

  $("#extype1").change(function() {
    $("#extype2").empty();
    var type1 = $("#extype1").val();
    switch (type1)
    {
      case "软件":
        $("#extype2").append("<option>外部异常分析</option>");
        $("#extype2").append("<option>内部异常分析</option>");
        $("#extype2").append("<option>开发经验共享</option>");
        $("#extype2").append("<option>测试经验共享</option>");
        $("#extype2").append("<option>行业信息</option>");
        break;
      case "硬件":
        $("#extype2").append("<option>外部异常分析</option>");
        $("#extype2").append("<option>内部异常分析</option>");
        $("#extype2").append("<option>开发经验共享</option>");
        $("#extype2").append("<option>测试经验共享</option>");
        $("#extype2").append("<option>行业信息</option>");
        break;
      case "结构件":
        $("#extype2").append("<option>外部异常分析</option>");
        $("#extype2").append("<option>内部异常分析</option>");
        $("#extype2").append("<option>开发经验共享</option>");
        $("#extype2").append("<option>测试经验共享</option>");
        $("#extype2").append("<option>行业信息</option>");
        break;
      case "综合":
        $("#extype2").append("<option>外部异常分析</option>");
        $("#extype2").append("<option>内部异常分析</option>");
        $("#extype2").append("<option>开发经验共享</option>");
        $("#extype2").append("<option>测试经验共享</option>");
        $("#extype2").append("<option>行业信息</option>");
        break;
      case "文化熏陶":
        $("#extype2").append("<option>企业文化</option>");
        $("#extype2").append("<option>文化案例</option>");
        $("#extype2").append("<option>优秀心得</option>");
        break;
      case "个人成长":
        $("#extype2").append("<option>沟通表达</option>");
        $("#extype2").append("<option>职业生涯</option>");
        $("#extype2").append("<option>人际关系</option>");
        $("#extype2").append("<option>财富管理</option>");
        $("#extype2").append("<option>家庭生活</option>");
        $("#extype2").append("<option>修身养性</option>");
        break;
      case "经验共享平台":
        $("#extype2").append("<option>用户指南</option>");
        $("#extype2").append("<option>平台活动</option>");
        break;
      default:
        alert("err");
    }
  });

  // $("#tagselect").select2({
  //   placeholder: "请添加关键词（每个关键词请以回车确认）",
  //   maximumSelectionLength: 5,
  //   minimumResultsForSearch: 3,
  //   tags: true
  // });
  
  window.onbeforeunload = function(evt) {
    if (!$("#swap-editor").val())
    {
       return "确认离开当前页面吗？未保存的数据将会丢失";
    }
   }

  <?php 
  if (isset($_GET['pid']))
  {
      if (!isset($_COOKIE["userid"]))
      {
        echo "$.notify({message: '请先登录'}, {type: 'danger'}); window.location.href='login.php';";
      }
      $pid = $_GET['pid'];
      require_once('config.php');
      $con=mysqli_connect(HOST, USERNAME, PASSWORD);
      mysqli_set_charset($con, "utf8");
      mysqli_select_db($con, 'experience_base');
      $search_condition = "SELECT * FROM eb_passages WHERE pid=$pid AND status='publish'";
      if (isset($_COOKIE["userid"]) and get_userinfo($_COOKIE["userid"])['power'] > 1)
      {
        $search_condition = "SELECT * FROM eb_passages WHERE pid=$pid";
      }
      $result = mysqli_query($con, $search_condition);
      $row = mysqli_fetch_array($result);
      if (!$row or $row['author_id'] != $_COOKIE["userid"] and get_userinfo($_COOKIE["userid"])['power'] < 4)
      {
        echo "$.notify({message: '权限错误'}, {type: 'danger'});";
      }
      else
      {?>
        $("#pid").val("<?php echo $pid;?>");
        $("#extype1").val("<?php echo $row['extype1'];?>");
        $("#extype1").trigger('change');
        $("#extype2").val("<?php echo $row['extype2'];?>");
        $("#title").val("<?php echo $row['title'];?>");
        $("#editor").html("<?php echo addslashes($row['content']);?>");
        $("#file-select").hide();
        $("#file-list").show();
      <?php
        $tags = str_replace(SEPARATOR, ',', $row['tags']);
        echo '$("#tags").val("'.$tags.'");';
      }
  }
?>

})

function before_submit() {
  <?php 
  if (isset($_COOKIE["userid"]))
{?>
      $("#swap-editor").val($("#editor").summernote('code'));
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
  <?php echo_banner("add_ex"); ?>

    <div style="margin:50px;">
    </div>

    <form name="addex" method="post" enctype="multipart/form-data" action="addex_action.php" onsubmit="return before_submit();">
      <input type="text" name="pid" id="pid"/>
      <input type="text" name="editor" id="swap-editor" />
      <!-- <input type="text" name="tags" id="swap-tags" /> -->
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
              <?php if (get_userinfo($_COOKIE["userid"])['power'] > 1){?>
              <option>文化熏陶</option>
              <option>个人成长</option>
              <option>经验共享平台</option>
              <?php }?>
            </select>
          </div>
          <div id="software-options" class="col-xs-2" style="padding: 0;">
            <select id="extype2" name="extype2" class="form-control">
            </select>
          </div>
          <div class="col-xs-8">
            <input name="title" id="title" class="form-control" placeholder="请输入标题" required autofocus></input>
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
        <div id="file-list">
          <?php 
            $file_array = explode(SEPARATOR, $row['file_name']); 
            foreach ($file_array as $file) {echo "<p>".$file."</p>";}
          ?>
          <p>(文件暂不支持更改)</p>
        </div>
        <div class="row" id="file-select">
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
                        maxFileCount: 2,
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
          <!-- <div class="row">
            <div class="col-xs-6" style="margin-bottom: 10px">
              <select id="tagselect" name="labels" class="form-control" multiple="multiple" required>
                <optgroup label="请自行输入标签">
                </optgroup>
              </select>
            </div>
          </div> -->

          <!--Tags-->
          <div class="form-group">
            <p>请添加至少1个关键词，关键次间以逗号(,)分隔:</p>
            <div class="row" style="margin-bottom: 10px">
              <div class="col-xs-6"> <input type="text" class="form-control" id="tags" name="tags" placeholder="关键词" required> </div>
            </div>
          </div>

          <button id="submitbtn" type="submit" class="btn btn-primary btn-block">提交经验</button>

        </div>
      </from>

<?php echo_webfooter(); ?>
</body>

</html>