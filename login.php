<!DOCTYPE HTML>
<html>
<meta name="renderer" content="webkit"> 
<meta charset="UTF-8">
<title>经验共享平台</title>
<link rel="bookmark" type="image/x-icon" href="img/+1.ico" />
<link rel="shortcut icon" href="img/+1.ico">
<link rel="icon" href="img/+1.ico">
<link rel="stylesheet" href="style/css/bootstrap.css">
<link rel="stylesheet" href="style/css/carousel.css">
<script src="style/js/jquery.js"></script>
<script src="style/js/bootstrap.js"></script>

<!--notify-->
<link rel="stylesheet" href="style/css/animate.css">
<script src="style/js/bootstrap-notify.js"></script>

<?php if (isset($_COOKIE["userid"])){echo "<script>location.href='index.php'</script>";}?>

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

  .logo{
    height: 220px;
    margin-left: 100px;
  }
</style>

<script>
var add1 = Math.random()*8 + 1;
add1 = parseInt(add1, 10);
var add2 = Math.random()*8 + 1;
add2 = parseInt(add2, 10);

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
  $("#accept-cb").change(function(){
    if ($("#accept-cb").is(':checked')) 
    {
      $("#signup-submit").removeAttr("disabled", "");
    } 
    else 
    {
      $("#signup-submit").attr("disabled", "disabled");
    }
  });

  $("#department1").change(function() {
    $("#department2").empty();
    var type1 = $("#department1").val();
    switch (type1)
    {
      case "研发中心":
        $("#department2").append("<option>终端通信部</option>");
        $("#department2").append("<option>表计开发部</option>");
        $("#department2").append("<option>研发管理部</option>");
        $("#department2").append("<option>平台部</option>");
        $("#department2").append("<option>产品企化部</option>");
        $("#department2").append("<option>产品审查室</option>");
        break;
      case "品质中心":
        $("#department2").append("<option>仪表模块</option>");
        $("#department2").append("<option>综合管理室</option>");
        $("#department2").append("<option>失效</option>");
        $("#department2").append("<option>可靠性实验室</option>");
        $("#department2").append("<option>电力失效分析室</option>");
        $("#department2").append("<option>功能实验室</option>");
        $("#department2").append("<option>系统实验室</option>");
        break;
      default:
        alert("err");
    }
  });

  $("#chklabel").html("请填写"+add1+"+"+add2+"=");
});

function chk_form()
{
  if(document.signup.password.value.length < 6)  
  {  
      document.signup.password.focus();  
      $.notify({message: '密码不得小于6位'}, {type: 'danger'});
      return false;
  }
  if(document.signup.password.value != document.signup.password_chk.value)
  {  
      document.signup.password.focus();  
      $.notify({message: '两次密码不同，请重新填写'}, {type: 'danger'});
      return false;
  }
  if(add1 + add2 != document.signup.sumchk.value)
  {
      document.signup.sumchk.focus();
      $.notify({message: '验证码错误，请重新填写'}, {type: 'danger'});
      return false;  
  }
}
</script>

<body>
  <?php include("common.php"); echo_banner("login"); ?>

    <div style="margin: 50px">
    </div>

    <div class="container">
      <div class="page-header">
        <h1>登录</h1>
      </div>

      <div id="login-form" class="login">
        <form name="login" method="post" action="login_action.php">
          <input type="hidden" name="lasturl" value="<?php echo (isset($_GET['lu']) ? $_GET['lu'] : $_SERVER['HTTP_REFERER']);?>">
          <div class="form-group">
            <label>用户名</label>
            <input type="text" class="form-control" name="username" maxlength="32" placeholder="" required autofocus>
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
          <input type="hidden" name="lasturl" value="<?php echo (isset($_GET['lu']) ? $_GET['lu'] : $_SERVER['HTTP_REFERER']);?>">
          <div class="form-group">
            <label>用户名</label>
            <input type="text" class="form-control" name="username" maxlength="32" onkeyup="value=value.replace(/[^\w\.\/]/ig,'')" placeholder="请保持与OA用户名相同（一般是姓名全拼），用于登录" required autofocus>
          </div>
          <div class="form-group">
            <label>密码</label>
            <input type="password" class="form-control" name="password" maxlength="64" placeholder="长度不得小于6位" required>
          </div>
          <div class="form-group">
            <label>确认密码</label>
            <input type="password" class="form-control" name="password_chk" maxlength="64" placeholder="" required>
          </div>
          <div class="form-group">
            <label>姓名</label>
            <input type="text" class="form-control" name="nickname" maxlength="16" placeholder="请使用真实姓名" required>
          </div>
          <div class="form-group">
            <label>工号</label>
            <input type="text" class="form-control" name="sx_id" maxlength="32" onkeyup="this.value=this.value.replace(/\D/g,'')" placeholder="请填写真实工号" required>
          </div>
          <!-- <div class="form-group">
            <label>部门</label>
            <div class="row">
              <div id="main-options" class="col-xs-6" style="padding-right: 0;">
                <select id="department1" name="department1" class="form-control">
                  <option>研发中心</option>
                  <option>品质中心</option>
                </select>
              </div>
              <div id="software-options" class="col-xs-6" style="padding-left: 0;">
                <select id="department2" name="department2" class="form-control">
                  <option>终端通信部</option>
                  <option>表计开发部</option>
                  <option>研发管理部</option>
                  <option>平台部</option>
                  <option>产品企化部</option>
                  <option>产品审查室</option>
                </select>
              </div>
            </div>
          </div> -->
          <div class="form-group">
            <label id="chklabel">请填写</label>
            <input type="text" class="form-control" name="sumchk" maxlength="3" placeholder="" required>
          </div>
          <div class="checkbox">
            <label>
              <input type="checkbox" id="accept-cb"> 接受<a herf="#">经验共享平台使用条款</a>  
            </label>
          </div>
          <div class="form-group">
            <p>为保证数据安全，本平台仅接受三星电气产品中心员工进行注册，请填写真实姓名和工号完成注册。因此带来的不便请谅解。</p>
            <p style="color: red"><b>若您在注册过程中遇到问题，请务必联系王珂（665593），我们将竭诚为您服务。</b></p>
          </div>
          <div class="row">
            <div class="col-xs-9">
              <button type="submit" id="signup-submit" class="btn btn-block btn-primary" disabled="disabled">提交</button>
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
      <!-- <img src="img/logo_500.png" class="logo"></img> -->
    </div>

<?php echo_webfooter(); ?>
</body>

</html>