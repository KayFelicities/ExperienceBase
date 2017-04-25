<meta charset="UTF-8">
<?php
if(PHP_VERSION >= 6 || !get_magic_quotes_gpc())
{
    $_POST = array_map( 'addslashes', $_POST);
}


$title=$_POST["title"];
$editor=$_POST["editor"];
$extype1=$_POST["extype1"];
$extype2=$_POST["extype2"];
$tags=$_POST["tags"];
$remote_ip = $_SERVER["REMOTE_ADDR"];
$timenow = date("Y-m-d H:i:s");
$author_id = 0;
if (!empty($_COOKIE["userid"]))
{
    $author_id = $_COOKIE["userid"];
}

require_once('config.php');
$con=mysqli_connect(HOST, USERNAME, PASSWORD);
mysqli_set_charset($con, "utf8");
mysqli_select_db($con, 'experience_base');
$insertsql= "INSERT INTO eb_contents(title, create_tm, author_id, content, extype1, extype2, tags, create_ip)
VALUES('$title', '$timenow', '$author_id', '$editor', '$extype1', '$extype2', '$tags', '$remote_ip')";

if(mysqli_query($con, $insertsql))
{
    $result = mysqli_query($con, "SELECT @@IDENTITY");
    $cid = mysqli_fetch_array($result)[0];

    if (!empty($_FILES['file']['tmp_name']))
    {
        if ($_FILES["file"]["error"] > 0)
        {
            echo "文件上传失败：" . $_FILES["file"]["error"] . "<br />";
        }
        else
        {
            echo "正在上传文件" . $_FILES["file"]["name"] . "，请稍后。";

            if (!is_dir(CONTENT_FILE))
            {
                mkdir(CONTENT_FILE, 0777, true);
            }

            $file_name = $_FILES["file"]["name"];
            $file_name_array = explode('.', $file_name);
            $save_file_path = CONTENT_FILE . sprintf("/%06d", $cid) . "_01." . end($file_name_array);
            move_uploaded_file($_FILES["file"]["tmp_name"], $save_file_path);

            $update_sql = "UPDATE eb_contents SET file_name='$file_name' WHERE cid='$cid'";
            mysqli_query($con, $update_sql);
        }
    }

    echo "<script>window.location.href='content.php?cid=$cid'</script>";
}
else
{
    echo mysqli_error($con);
}
mysqli_close($con);
?>