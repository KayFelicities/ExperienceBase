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

<style>
  .login, .signup{
    float: left;
    width: 50%;
  }

  .signup{
    display: none;
  }

  #logo{
    float: right;
    width: 40%;
  }

  .bigtext{
    text-align: center;
    font-size: 220px;
  }
</style>

<script>
$(document).ready(function(){
  $("#signup-btn").click(function(){
    $(".page-header").html("<h1>注册</h1>");
    $("#login-form").hide();
    $("#signup-form").show();
  });
  $("#login-btn").click(function(){
    $(".page-header").html("<h1>登录</h1>");
    $("#signup-form").hide();
    $("#login-form").show();
  });
});

function chk_form()
{
  if(document.signup.password.value != document.signup.password_chk.value)  
  {  
      document.signup.password.focus();  
      alert("两次密码不同，请重新填写");  
      return false;  
  }
}
</script>

<body>
  <?php include("common.php"); echo_banner("signup"); ?>

    <div style="margin: 50px">
    </div>

    <div class="container">
      <div class="page-header">
        <h1>登录</h1>
      </div>

      <div id="login-form" class="login">
        <form name="login" method="post" action="login_action.php">
          <div class="form-group">
            <label>用户名</label>
            <input type="text" class="form-control" name="username" maxlength="32" placeholder="姓名全拼" required autofocus>
          </div>
          <div class="form-group">
            <label>密码</label>
            <input type="password" class="form-control" name="password" maxlength="64" placeholder="" required>
          </div>
          <div class="row">
            <div class="col-xs-9">
              <button type="submit" class="btn btn-block btn-primary">登录</button>
            </div>  
            <div class="col-xs-3">
              <button type="button" id="signup-btn" class="btn btn-block btn-warning">注册</button> 
            </div>
          </div>
        </form> 
      </div>

      <div id="signup-form" class="signup">
        <form name="signup" method="post" action="signup_action.php" onsubmit="return chk_form();">
          <div class="form-group">
            <label>用户名</label>
            <input type="text" class="form-control" name="username" maxlength="32" placeholder="姓名全拼，用于登录" required autofocus>
          </div>
          <div class="form-group">
            <label>密码</label>
            <input type="password" class="form-control" name="password" maxlength="64" placeholder="" required>
          </div>
          <div class="form-group">
            <label>确认密码</label>
            <input type="password" class="form-control" name="password_chk" maxlength="64" placeholder="" required>
          </div>
          <div class="form-group">
            <label>昵称</label>
            <input type="text" class="form-control" name="nickname" maxlength="16" placeholder="用于网站显示，建议使用中文（不超过16个字）" required>
          </div>
          <div class="checkbox">
            <label>
              <input type="checkbox"> 接受<a herf="#">经验分享平台使用条款</a>  
            </label>
          </div>
          <div class="row">
            <div class="col-xs-9">
              <button type="submit" class="btn btn-block btn-primary">提交</button>
            </div>  
            <div class="col-xs-3">
              <button type="button" id="login-btn" class="btn btn-block btn-success">登录</button> 
            </div>
          </div>
        </form> 
      </div>

      <div class="bigtext">
        <p>+1</p>
      </div>

    </div>

</body>

</html>