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

  <h4>2017.05.12:</h4>
  <ol>
    <li>用户注册限制</li>
  </ol>

  <h4>2017.05.20:</h4>
  <ol>
    <li>添加点赞功能</li>
  </ol>

  <h4>2017.08.05:</h4>
  <ol>
    <li>更改平台名称为“经验共享平台”</li>
    <li>自动打开经验文档预览</li>
    <li>显示赞了该文章的用户</li>
    <li>提交经验时强制要求带标签</li>
  </ol>

  <h4>2017.08.06:</h4>
  <ol>
    <li>富文本编辑器插入图片方式优化</li>
    <li>文章拥有者可编辑、删除</li>
    <li>留言板功能</li>
    <li>搜索功能</li>
  </ol>

  <h4>2017.08.08:</h4>
  <ol>
    <li>搭建“我的消息”页面</li>
    <li>消息系统简单实现，可回复和点赞和通知到作者</li>
    <li>添加文章最后动态时间，按动态时间进行文章排序</li>
  </ol>

  <h4>2017.08.09:</h4>
  <ol>
    <li>开设用电产品、文化、个人版块</li>
    <li>文章推荐页</li>
    <li>楼中楼评论</li>
    <li>限制未登录用户查看文章附件</li>
  </ol>

  <h4>2017.08.10:</h4>
  <ol>
    <li>首页设计</li>
    <li>平台LOGO更新</li>
    <li>平台首页介绍更新</li>
  </ol>

  <h4>2017.08.12:</h4>
  <ol>
    <li>产品中心员工数据更新</li>
    <li>修复反复登录问题</li>
    <li>优化文档上传速度</li>
  </ol>

  <h4>2017.08.12:</h4>
  <ol>
    <li>修复文档预览有概率失败的问题</li>
    <li>工号可用于登录</li>
    <li>使用可读性更好的多少分钟、小时前来显示时间</li>
  </ol>

  <h4>2017.08.13:</h4>
  <ol>
    <li>文章修改</li>
    <li>消息系统完善</li>
    <li>限制用户文档上传数量为2</li>
  </ol>

  <h4>2017.08.14:</h4>
  <ol>
    <li>图片上传插件更换为cropit，致谢<a href="http://scottcheng.github.io/cropit/">cropit</a></li>
    <li>头像更改、文章配图更改实现</li>
    <li>添加经验页用户离开时弹出提示</li>
    <li>修改登录页背景</li>
    <li>首页幻灯片更改为slippry，致谢<a href="http://slippry.com/">slippry</a></li>
    <li>首页活动图片添加</li>
    <li>首页推荐文章</li>
  </ol>

  <h4>2017.08.15:</h4>
  <ol>
    <li>优化关键词录入方式</li>
    <li>正式上线</li>
  </ol>

  <hr>
  
  <h4>todo list:</h4>
  <ol>
    <li>首页幻灯片更新</li>
    <li>楼中楼消息提醒</li>
    <li>个人订阅、收藏、消息系统搭建</li>
    <li>积分、等级系统搭建</li>
    <li>专家解答版块搭建</li>
    <li>标签系统优化、标签数据库搭建</li>
    <li>用户行为统计</li>
  </ol>
</div>

<?php echo_webfooter(); ?>
</body>

</html>