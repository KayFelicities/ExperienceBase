<!DOCTYPE HTML>
<html>
<meta charset="UTF-8">
<title>经验共享平台</title>
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
$login_id = 0;
if (isset($_COOKIE["userid"]))
{
    $login_id = $_COOKIE["userid"];
}
$pid=$_POST["pid"];

$comment=isset($_POST["comment"]) ? $_POST["comment"] : "";
$parent_cid=isset($_POST["parent_cid"]) ? $_POST["parent_cid"] : "0";
$mentioned_id=isset($_POST["mentioned_id"]) ? $_POST["mentioned_id"] : "";
$parent_c_author_id=isset($_POST["parent_c_author_id"]) ? $_POST["parent_c_author_id"] : "0";
$comment_type=$_POST["type"];
$p_author_id=$_POST["p_author_id"];

if (!$login_id)
{
    echo ("<script>$.notify({message: '请先登录'}, {type: 'danger'});</script>");
    header("Refresh: 1; url=login.php");
}
else
{
    include("common.php");
    if ($comment_type == 'like' && is_i_liked($pid))
    {
        echo ("<script>$.notify({message: '您已赞过该文章啦'}, {type: 'danger'});</script>");
        header("Refresh: 1; url=content.php?pid=$pid");
    }
    else
    {
        $con=mysqli_connect(HOST, USERNAME, PASSWORD);
        mysqli_set_charset($con, "utf8");
        mysqli_select_db($con, 'experience_base');

        if ($mentioned_id)
        {
            $result = mysqli_query($con, "SELECT * FROM eb_users WHERE uid='$mentioned_id'");
            $row = mysqli_fetch_array($result);
            $comment = "回复 " . $row['nickname'] . ": " . $comment;
        }

        $insertsql_add= "INSERT INTO eb_comments(pid, p_author_id, create_tm, create_ip, c_author_id, comment, type, parent_cid, parent_c_author_id, mentioned_uids)
                                    VALUES('$pid', '$p_author_id', '$timenow', '$remote_ip', '$login_id', '$comment', '$comment_type', '$parent_cid', '$parent_c_author_id', '$mentioned_id')";
        if ($comment_type == 'comment')
        {
            $insertsql_update= "UPDATE eb_passages SET comment_num=comment_num+1,last_tm='$timenow' WHERE pid='$pid'";
        }
        else
        {
            $insertsql_update= "UPDATE eb_passages SET like_num=like_num+1,last_tm='$timenow' WHERE pid='$pid'";
        }

        if(mysqli_query($con, $insertsql_add) and mysqli_query($con, $insertsql_update))
        {
            mysqli_query($con, "UPDATE eb_users SET unread_num=unread_num+1 WHERE uid='$p_author_id'");
            if ($mentioned_id){mysqli_query($con, "UPDATE eb_users SET unread_num=unread_num+1 WHERE uid='$mentioned_id'");}
            echo ("<script>$.notify({message: '评论成功！'}, {type: 'success'});</script>");
            header("Refresh: 1; url=content.php?pid=$pid");
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
