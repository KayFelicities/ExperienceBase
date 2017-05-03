<!DOCTYPE HTML>
<html>
<meta charset="UTF-8">
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

$cid=$_POST["cid"];
$comment=$_POST["comment"];
$remote_ip = $_SERVER["REMOTE_ADDR"];
$timenow = date("Y-m-d H:i:s");
$author_id = 0;
if (isset($_COOKIE["userid"]))
{
    $author_id = $_COOKIE["userid"];
}

$con=mysqli_connect(HOST, USERNAME, PASSWORD);
mysqli_set_charset($con, "utf8");
mysqli_select_db($con, 'experience_base');
$insertsql_add= "INSERT INTO eb_comments(cid, create_tm, create_ip, co_author_id, comment)
                              VALUES('$cid', '$timenow', '$remote_ip', '$author_id', '$comment')";         
$insertsql_update= "UPDATE eb_contents SET comment_num=comment_num+1 WHERE cid='$cid'";         
if(mysqli_query($con, $insertsql_add) and mysqli_query($con, $insertsql_update))
{
    echo ("<script>$.notify({message: '评论成功！'}, {type: 'success'});</script>");
    header("Refresh: 1; url=content.php?cid=$cid#excomments");
}
else
{
    echo mysqli_error($con);
}
mysqli_close($con);
?>

</body>

</html>