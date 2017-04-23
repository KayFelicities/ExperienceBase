<?php
function echo_banner($page_name)
{?>
  <nav class="navbar navbar-inverse navbar-fixed-top">
    <div class="container">
      <div class="navbar-header">
        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
          <span class="sr-only">Toggle navigation</span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
        </button>
        <a class="navbar-brand" href="index.php">经验分享平台</a>
      </div>
      <div id="navbar" class="navbar-collapse collapse">
        <ul class="nav navbar-nav">
          <li <?php if ($page_name=="content_list" ){echo 'class="active"';}?> ><a href="content_list.php">所有经验</a></li>
          <li <?php if ($page_name=="software" ){echo 'class="active"';}?> ><a href="software.php">软件</a></li>
          <li <?php if ($page_name=="hardware" ){echo 'class="active"';}?> ><a href="hardware.php">硬件</a></li>
          <li <?php if ($page_name=="structure" ){echo 'class="active"';}?> ><a href="structure.php">结构件</a></li>
          <li <?php if ($page_name=="procedure" ){echo 'class="active"';}?> ><a href="procedure.php">流程</a></li>
          <li <?php if ($page_name=="about" ){echo 'class="active"';}?> ><a href="about.php">关于</a></li>
        </ul>
        <ul class="nav navbar-nav navbar-right">
          <li <?php if ($page_name=="add_ex" ){echo 'class="active"';}?> ><a href="addex.php">添加经验</a></li>

          <?php 
          if (isset($_COOKIE["user"]))
          {?>
            <li <?php if ($page_name=="mypage" ){echo 'class="active"';}?> ><a href="mypage.php"><?php echo $_COOKIE["user"];?></a></li>
          <?php
          }
          else
          {?>
            <li <?php if ($page_name=="login" ){echo 'class="active"';}?> ><a href="login.php">登录/注册</a></li>
          <?php
          }
          ?>
        </ul>
        <!--<form class="navbar-form navbar-right">
    <input type="text" class="form-control" placeholder="搜索点什么...">
    </form>-->
      </div>
    </div>
  </nav>
<?php
}

function echo_content_item($no, $type="")
{
  require_once('config.php');
  $con=mysqli_connect(HOST, USERNAME, PASSWORD);
  mysqli_set_charset($con, "utf8");
  mysqli_select_db($con, 'experience_base');
  if ($type)
  {
    $result = mysqli_query($con, "SELECT * FROM eb_contents WHERE extype1='$type' ORDER BY create_tm DESC LIMIT $no,1");
  }
  else
  {
    $result = mysqli_query($con, "SELECT * FROM eb_contents ORDER BY create_tm DESC LIMIT $no,1");
  }
  $row = mysqli_fetch_array($result);
  if($row)
  {
   ?>
    <div class="item">
      <div class="item-heading">
        <h4><a href="content.php?cid=<?php echo $row['cid'];?>"><?php echo $row['title'];?></a></h4>
      </div>
      <div class="item-content">
        <div class="media pull-right"><img src="img/logo.png" alt=""></div>
        <div class="text"><?php echo mb_substr(strip_tags($row['content']), 0, 200, 'utf-8').'...';?></div>
      </div>
      <div class="item-footer">
        <a href="#" class="text-muted"> <?php echo $row['extype1'];?></a>
        <span> ></span>
        <a href="#" class="text-muted"> <?php echo $row['extype2'];?></a>
        &nbsp; &nbsp; 
        <a href="#" class="text-muted"><i class="icon-user"></i> <?php echo $row['author'];?></a>
        &nbsp; &nbsp; 
        <a href="#" class="text-muted"><i class="icon-comments"></i> <?php echo $row['comment_num'];?></a> 
        &nbsp; &nbsp; 
        <span class="text-muted"><i class="icon-time"></i> <?php echo $row['create_tm'];?></span>
        &nbsp;
        <?php
        $tags_array = explode(',', $row['tags']);
        foreach ($tags_array as $tag) 
        {?>
          <span class="label label-success"><?php echo $tag;?></span>
        <?php
        }?>
      </div>
    </div>
  <?php
    mysqli_close($con);
    return true;
  }
  else
  {
    mysqli_close($con);
    return false;
  }
}

function count_content($type="")
{
  require_once('config.php');
  $con=mysqli_connect(HOST, USERNAME, PASSWORD);
  mysqli_set_charset($con, "utf8");
  mysqli_select_db($con, 'experience_base');
  if ($type)
  {
    $result = mysqli_query($con, "SELECT COUNT(*) AS count FROM eb_contents WHERE extype1='$type'");
  }
  else
  {
    $result = mysqli_query($con, "SELECT COUNT(*) AS count FROM eb_contents");
  }
  $count = mysqli_fetch_array($result)['count'];
  mysqli_close($con);
  return $count;
}

function echo_editor()
{?>
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
<?php
}
?>