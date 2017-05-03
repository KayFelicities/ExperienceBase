<!DOCTYPE HTML>
<html>
<meta charset="UTF-8">
<title>经验分享平台</title>
<link rel="bookmark" type="image/x-icon" href="img/+1.ico" />
<link rel="shortcut icon" href="img/+1.ico">
<link rel="icon" href="img/+1.ico">
<link rel="stylesheet" href="style/css/bootstrap.css">
<script src="style/js/jquery.js"></script>
<script src="style/js/bootstrap.js"></script>

<body>
<?php include("common.php"); echo_banner("dev_log"); ?>
<div style="margin: 60px"></div>

<div class="container">
  <header>
    <h3><i></i> 开发日志 <small></small></h3>
  </header>
  <hr>

  <h4>2017.04.16:</h4>
  <ol>
    <li>基础框架搭建，移植BootStrap全局样式、JS方法。致谢<a href="http://v3.bootcss.com/">Bootstrap</a></li>
    <li>响应式布局导航栏开发</li>
    <li>主页搭建</li>
    <li>主页Carousel开发</li>
  </ol>

  <h4>2017.04.17:</h4>
  <ol>
    <li>经验分类页面搭建</li>
    <li>关于页面搭建</li>
  </ol>

  <h4>2017.04.18:</h4>
  <ol>
    <li>主页文章列表显示</li>
    <li>经验文章添加页面搭建</li>
    <li>移植可视化编辑器bootstrap-wysiwyg。致谢<a href="http://mindmup.github.io/bootstrap-wysiwyg/">bootstrap-wysiwyg</a></li>
  </ol>

  <h4>2017.04.19:</h4>
  <ol>
    <li>文章列表显示分类、作者、时间、评论数</li>
    <li>分类页面文章列表显示</li>
  </ol>

  <h4>2017.04.20:</h4>
  <ol>
    <li>文章数据库规划、实现</li>
    <li>文章内容显示</li>
    <li>经验可提交至数据库</li>
  </ol>

  <h4>2017.04.21:</h4>
  <ol>
    <li>用户登录、注册页面搭建</li>
    <li>用户数据库规划、实现</li>
    <li>文章标签系统实现</li>
    <li>页面整体布局优化</li>
  </ol>

  <h4>2017.04.22:</h4>
  <ol>
    <li>用户注册、登录信息保存</li>
    <li>文章附件文档上传</li>
  </ol>

  <h4>2017.04.23:</h4>
  <ol>
    <li>关于页面搭建</li>
    <li>关于页面可编辑</li>
  </ol>

  <h4>2017.04.24:</h4>
  <ol>
    <li>放弃bootstrap-wysiwyg，移植SummerNote编辑器，非常好用！致谢：<a href="http://summernote.org/">SummerNote</a></li>
    <li>列表页添加分页</li>
  </ol>

  <h4>2017.04.25:</h4>
  <ol>
    <li>完善注册填写信息项</li>
    <li>显示用户昵称</li>
  </ol>

  <h4>2017.04.26:</h4>
  <ol>
    <li>文档自动另存pdf，移植pdf预览控件。致谢：<a href="https://pdfobject.com/">PDFObject</a></li>
    <li>经验评论框架搭建</li>
  </ol>

  <h4>2017.04.27:</h4>
  <ol>
    <li>移植多文档上传控件。致谢：<a href="http://plugins.krajee.com/file-input">FileInput</a></li>
    <li>完善经验提交逻辑</li>
  </ol>

  <h4>2017.04.29:</h4>
  <ol>
    <li>移植提示消息系统，修改弹窗提示为更友善的提示消息。致谢：<a href="http://bootstrap-notify.remabledesigns.com/">bootstrap-notify</a></li>
  </ol>

  <h4>2017.04.30:</h4>
  <ol>
    <li>移植图片裁剪插件，实现头像更换。致谢：<a href="https://github.com/alexk111/ngImgCrop">ngImgCrop</a></li>
    <li>文章评论数据库搭建，功能实现</li>
  </ol>

  <h4>2017.05.03:</h4>
  <ol>
    <li>用户页面显示当前用户发表的经验</li>
    <li>搜索页面搭建</li>
    <li>实现分类、用户、标签搜索</li>
  </ol>

  <hr>
  
  <h4>todo list:</h4>
  <ol>
    <li>注册限制、登录限制√</li>
    <li>文件显示√</li>
    <li>用户个人界面搭建</li>
    <li>用户信息数据库优化</li>
    <li>标签系统优化、标签数据库搭建</li>
    <li>文章评论、点赞系统搭建</li>
    <li>个人订阅、消息系统搭建</li>
    <li>搜索系统搭建</li>
  </ol>
</div>

</body>

</html>