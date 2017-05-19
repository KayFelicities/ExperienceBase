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

<!--notify-->
<link rel="stylesheet" href="style/css/animate.css">
<script src="style/js/bootstrap-notify.js"></script>

<body>
<?php
if(PHP_VERSION >= 6 || !get_magic_quotes_gpc()) 
{
    $_POST = array_map( 'addslashes', $_POST);
}
$imgbase64=$_POST["imgbase64"];
$remote_ip = $_SERVER["REMOTE_ADDR"];
$timenow = date('Y-m-d H:i:s');

require_once('config.php');
if (!is_dir(USER_AVATAR_STORE_PATH))
{
    mkdir(USER_AVATAR_STORE_PATH, 0777, true);
}

if (isset($_COOKIE["userid"]))
{
  $user_id = $_COOKIE["userid"];

  if (preg_match('/^(data:\s*image\/(\w+);base64,)/', $imgbase64, $result)){
    // $type = $result[2];
    $new_file = USER_AVATAR_STORE_PATH.sprintf("/%06d.png", $user_id);
    if (file_put_contents($new_file, base64_decode(str_replace($result[1], '', $imgbase64))))
    {
      echo ("<script>$.notify({message: '保存成功！'}, {type: 'success'});</script>");
      header("Refresh: 1; url=userpage.php");
    }
  }
}
else
{
  echo ("<script>$.notify({message: '请先登录！'}, {type: 'danger'});</script>");
  header("Refresh: 1; url=login.php");
}
?>

</body>
</html>