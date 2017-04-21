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
  
  #swap-editor {
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
        $("#extype2").append("<option>编程技巧</option>");
        $("#extype2").append("<option>单元测试</option>");
        break;
      case "硬件":
        $("#extype2").append("<option>PCB原理图</option>");
        $("#extype2").append("<option>EMC</option>");
        break;
      case "结构件":
        $("#extype2").append("<option>CAD设计</option>");
        $("#extype2").append("<option>3D建模</option>");
        break;
      case "流程":
        $("#extype2").append("<option>流程1</option>");
        $("#extype2").append("<option>流程2</option>");
        $("#extype2").append("<option>流程3</option>");
        break;
      default:
        alert("test");
    }
  });
})

function take_editor() {
  $("#swap-editor").val($("#editor").html());
}
</script>

<body>
  <?php include("common.php"); echo_banner("add_ex"); ?>

    <div style="margin:50px;">
    </div>

    <form name="addex" method="post" action="addex_action.php" onsubmit="return take_editor();">
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
              <option>流程</option>
            </select>
          </div>
          <div id="software-options" class="col-xs-2" style="padding: 0;">
            <select id="extype2" name="extype2" class="form-control">
              <option>编程技巧</option>
              <option>单元测试</option>
            </select>
          </div>
          <div class="col-xs-8">
            <input name="title" class="form-control" placeholder="请输入标题"></input>
          </div>
        </div>

        <!--editor-->
        <input type="text" name="editor" id="swap-editor" />
        <div id="myeditor">
          <div class="btn-toolbar" data-role="editor-toolbar" data-target="#editor">
            <div class="btn-group">
              <a class="btn btn-default dropdown-toggle" data-toggle="dropdown" title="Font"><i class="icon icon-font"></i><b class="caret"></b></a>
              <ul class="dropdown-menu">
              </ul>
            </div>
            <div class="btn-group">
              <a class="btn btn-default dropdown-toggle" data-toggle="dropdown" title="Font Size"><i class="glyphicon glyphicon-text-height"></i>&nbsp;<b class="caret"></b></a>
              <ul class="dropdown-menu">
                <li>
                  <a data-edit="fontSize 5">
                    <font size="5">Huge</font>
                  </a>
                </li>
                <li>
                  <a data-edit="fontSize 3">
                    <font size="3">Normal</font>
                  </a>
                </li>
                <li>
                  <a data-edit="fontSize 1">
                    <font size="1">Small</font>
                  </a>
                </li>
              </ul>
            </div>
            <div class="btn-group">
              <a class="btn btn-default" data-edit="bold" title="Bold (Ctrl/Cmd+B)"><i class="icon icon-bold"></i></a>
              <a class="btn btn-default" data-edit="italic" title="Italic (Ctrl/Cmd+I)"><i class="icon icon-italic"></i></a>
              <a class="btn btn-default" data-edit="strikethrough" title="Strikethrough"><i class="icon icon-strikethrough"></i></a>
              <a class="btn btn-default" data-edit="underline" title="Underline (Ctrl/Cmd+U)"><i class="icon icon-underline"></i></a>
            </div>
            <div class="btn-group">
              <a class="btn btn-default" data-edit="insertunorderedlist" title="Bullet list"><i class="icon icon-list-ul"></i></a>
              <a class="btn btn-default" data-edit="insertorderedlist" title="Number list"><i class="icon icon-list-ol"></i></a>
              <a class="btn btn-default" data-edit="outdent" title="Reduce indent (Shift+Tab)"><i class="icon icon-double-angle-left"></i></a>
              <a class="btn btn-default" data-edit="indent" title="Indent (Tab)"><i class="icon icon-double-angle-right"></i></a>
            </div>
            <div class="btn-group">
              <a class="btn btn-default" data-edit="justifyleft" title="Align Left (Ctrl/Cmd+L)"><i class="glyphicon glyphicon-align-left"></i></a>
              <a class="btn btn-default" data-edit="justifycenter" title="Center (Ctrl/Cmd+E)"><i class="glyphicon glyphicon-align-center"></i></a>
              <a class="btn btn-default" data-edit="justifyright" title="Align Right (Ctrl/Cmd+R)"><i class="glyphicon glyphicon-align-right"></i></a>
              <a class="btn btn-default" data-edit="justifyfull" title="Justify (Ctrl/Cmd+J)"><i class="glyphicon glyphicon-align-justify"></i></a>
            </div>
            <div class="btn-group">
              <a class="btn btn-default" data-toggle="dropdown" title="Hyperlink"><i class="icon icon-link"></i></a>
              <div class="dropdown-menu input-append">
                <input class="span2" placeholder="URL" type="text" data-edit="createLink" />
                <button class="btn btn-default" type="button">Add</button>
              </div>
            </div>

            <div class="btn-group">
              <a class="btn btn-default" title="Insert picture (or just drag & drop)" id="pictureBtn"><i class="icon icon-picture"></i></a>
              <input type="file" data-role="magic-overlay" data-target="#pictureBtn" data-edit="insertImage" />
            </div>
            <div class="btn-group">
              <a class="btn btn-default" data-edit="undo" title="Undo (Ctrl/Cmd+Z)"><i class="icon icon-undo"></i></a>
              <a class="btn btn-default" data-edit="redo" title="Redo (Ctrl/Cmd+Y)"><i class="icon icon-repeat"></i></a>
            </div>
            <input type="text" data-edit="inserttext" id="voiceBtn" x-webkit-speech="">
          </div>

          <div id="editor"></div>

          <script>
            $(function() {
              function initToolbarBootstrapBindings() {
                var fonts = ['微软雅黑', '宋体', '黑体', '新宋体', 'Serif', 'Sans', 'Arial', 'Arial Black', 'Courier',
                    'Courier New', 'Comic Sans MS', 'Helvetica', 'Impact', 'Lucida Grande', 'Lucida Sans', 'Tahoma', 'Times',
                    'Times New Roman', 'Verdana',
                  ],
                  fontTarget = $('[title=Font]').siblings('.dropdown-menu');
                $.each(fonts, function(idx, fontName) {
                  fontTarget.append($('<li><a data-edit="fontName ' + fontName + '" style="font-family:\'' + fontName + '\'">' + fontName + '</a></li>'));
                });
                $('a[title]').tooltip({
                  container: 'body'
                });
                $('.dropdown-menu input').click(function() {
                    return false;
                  })
                  .change(function() {
                    $(this).parent('.dropdown-menu').siblings('.dropdown-toggle').dropdown('toggle');
                  })
                  .keydown('esc', function() {
                    this.value = '';
                    $(this).change();
                  });

                $('[data-role=magic-overlay]').each(function() {
                  var overlay = $(this),
                    target = $(overlay.data('target'));
                  overlay.css('opacity', 0).css('position', 'absolute').offset(target.offset()).width(target.outerWidth()).height(target.outerHeight());
                });
                if ("onwebkitspeechchange" in document.createElement("input")) {
                  var editorOffset = $('#editor').offset();
                  $('#voiceBtn').css('position', 'absolute').offset({
                    top: editorOffset.top,
                    left: editorOffset.left + $('#editor').innerWidth() - 35
                  });
                } else {
                  $('#voiceBtn').hide();
                }
              };

              function showErrorAlert(reason, detail) {
                var msg = '';
                if (reason === 'unsupported-file-type') {
                  msg = "Unsupported format " + detail;
                } else {
                  console.log("error uploading file", reason, detail);
                }
                $('<div class="alert"> <button type="button" class="close" data-dismiss="alert">&times;</button>' +
                  '<strong>File upload error</strong> ' + msg + ' </div>').prependTo('#alerts');
              };
              initToolbarBootstrapBindings();
              $('#editor').wysiwyg({
                fileUploadError: showErrorAlert
              });
              window.prettyPrint && prettyPrint();
            });
          </script>
        </div>
        <!--editor-->

        <div class="form-group" style="margin-top: 20px">
          <p>插入经验文档：(支持上传文件类型：doc/docx/ppt/pptx/pdf)</p>
          <input type="file" id="exampleInputFile">
        </div>

        <button id="submitbtn" type="submit" class="btn btn-primary btn-block">提交经验</button>

      </div>
      </from>
</body>

</html>