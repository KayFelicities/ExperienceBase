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
          <li <?php if ($page_name == "home"){echo 'class="active"';}?> ><a href="index.php">主页</a></li>
          <li <?php if ($page_name == "software"){echo 'class="active"';}?> ><a href="software.php">软件</a></li>
          <li <?php if ($page_name == "hardware"){echo 'class="active"';}?> ><a href="hardware.php">硬件</a></li>
          <li <?php if ($page_name == "structure"){echo 'class="active"';}?> ><a href="structure.php">结构件</a></li>
          <li <?php if ($page_name == "procedure"){echo 'class="active"';}?> ><a href="procedure.php">流程</a></li>
          <li <?php if ($page_name == "about"){echo 'class="active"';}?> ><a href="about.php">关于</a></li>
        </ul>
        <ul class="nav navbar-nav navbar-right">
          <li <?php if ($page_name == "add_ex"){echo 'class="active"';}?> ><a href="addex.php">添加经验</a></li>
          <li <?php if ($page_name == "mypage"){echo 'class="active"';}?> ><a href="login.php">注册/登录</a></li>
        </ul>
        <form class="navbar-form navbar-right">
          <input type="text" class="form-control" placeholder="搜索点什么...">
        </form>
      </div>
    </div>
  </nav>
<?php
}
?>
