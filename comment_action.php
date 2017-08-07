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

$remote_ip = $_SERVER["REMOTE_ADDR"];
$timenow = date("Y-m-d H:i:s");
$author_id = 0;
if (isset($_COOKIE["userid"]))
{
    $author_id = $_COOKIE["userid"];
}
$cid=$_POST["cid"];

$comment=isset($_POST["comment"]) ? $_POST["comment"] : "";
$comment_type=$_POST["type"];

if (!$author_id)
{
    echo ("<script>$.notify({message: '请先登录'}, {type: 'danger'});</script>");
    header("Refresh: 1; url=login.php");
}
else
{
    include("common.php");
    if ($comment_type == 'like' && is_i_liked($cid))
    {
        echo ("<script>$.notify({message: '您已赞过该文章啦'}, {type: 'danger'});</script>");
        header("Refresh: 1; url=content.php?cid=$cid");
    }
    else
    {
        $con=mysqli_connect(HOST, USERNAME, PASSWORD);
        mysqli_set_charset($con, "utf8");
        mysqli_select_db($con, 'experience_base');
        $insertsql_add= "INSERT INTO eb_comments(cid, create_tm, create_ip, co_author_id, comment, type)
                                    VALUES('$cid', '$timenow', '$remote_ip', '$author_id', '$comment', '$comment_type')";
        if ($comment_type == 'comment')
        {
            $insertsql_update= "UPDATE eb_contents SET comment_num=comment_num+1 WHERE cid='$cid'";
        }
        else
        {
            $insertsql_update= "UPDATE eb_contents SET like_num=like_num+1 WHERE cid='$cid'";
        }

        if(mysqli_query($con, $insertsql_add) and mysqli_query($con, $insertsql_update))
        {
            echo ("<script>$.notify({message: '评论成功！'}, {type: 'success'});</script>");
            header("Refresh: 1; url=content.php?cid=$cid");
        }
        else
        {
            echo mysqli_error($con);
        }
        mysqli_close($con);
    }
}
?>

</body>
</html>
