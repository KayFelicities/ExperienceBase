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

require_once('config.php');

$author_id = isset($_COOKIE["userid"]) ? $_COOKIE["userid"] : '0'; 
$name=$_POST["user"];
$email=$_POST["email"];
$comment=$_POST["comment"];
$remote_ip = $_SERVER["REMOTE_ADDR"];
$timenow = date("Y-m-d H:i:s");

$con=mysqli_connect(HOST, USERNAME, PASSWORD);
mysqli_set_charset($con, "utf8");
mysqli_select_db($con, 'experience_base');
$insertsql_add= "INSERT INTO eb_message_board(create_tm, create_ip, name, email, m_author_id, comment)
                            VALUES('$timenow', '$remote_ip', '$name', '$email', '$author_id', '$comment')";

if(mysqli_query($con, $insertsql_add))
{
    echo ("<script>$.notify({message: '留言成功！'}, {type: 'success'});</script>");
    header("Refresh: 1; url=message_board.php");
}
else
{
    echo mysqli_error($con);
}
mysqli_close($con);

?>
</body>

</html>