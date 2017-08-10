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

$pid=$_POST["pid"];
$p_author_id = $_POST["p_author_id"];
$remote_ip = $_SERVER["REMOTE_ADDR"];
$timenow = date("Y-m-d H:i:s");
$login_id = 0;
if (!empty($_COOKIE["userid"]))
{
    $login_id = $_COOKIE["userid"];
}
if ($p_author_id != $login_id)
{
    echo "<script>$.notify({message: '权限错误'}, {type: 'danger'});</script>";
    header("Refresh: 1; url=content.php?pid=$pid");
}
else
{
    require_once('config.php');
    $con=mysqli_connect(HOST, USERNAME, PASSWORD);
    mysqli_set_charset($con, "utf8");
    mysqli_select_db($con, 'experience_base');

    if($_POST["type"] == "edit") {
        $content=$_POST["editor"];
        $insertsql= "UPDATE eb_passages 
                    SET content='$content',modify_ip='$remote_ip',modify_tm='$timenow',last_tm='$timenow'
                    WHERE pid=$pid";

        if(mysqli_query($con, $insertsql))
        {
            echo "<script>$.notify({message: '修改成功'}, {type: 'success'});</script>";
            header("Refresh: 1; url=content.php?pid=$pid");
        }
        else
        {
            echo mysqli_error($con);
            echo "<script>$.notify({message: '修改失败'}, {type: 'danger'});</script>";
            header("Refresh: 1; url=content.php?pid=$pid");
        }
    }
    else if ($_POST["type"] == "delet")
    {
        $insertsql= "UPDATE eb_passages SET status='delet' WHERE pid=$pid";
        if(mysqli_query($con, $insertsql))
        {
            echo "<script>$.notify({message: '删除成功'}, {type: 'success'});</script>";
            header("Refresh: 1; url=content_list.php");
        }
        else
        {
            echo mysqli_error($con);
            echo "<script>$.notify({message: '删除失败'}, {type: 'danger'});</script>";
            header("Refresh: 1; url=content.php?pid=$pid");
        }
    }
    else{
        print_r("err");
    }
    mysqli_close($con);
}
?>

</body>
</html>
