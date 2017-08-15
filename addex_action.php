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

$title=$_POST["title"];
$editor=$_POST["editor"];
$extype1=$_POST["extype1"];
$extype2=$_POST["extype2"];
$tags=str_replace(';', ',', $_POST["tags"]);
$tags=str_replace('；', ',', $tags);
$tags=str_replace('，', ',', $tags);
$tags=str_replace(' ', '', $tags);
$tags=str_replace(',', SEPARATOR, $tags);
$remote_ip = $_SERVER["REMOTE_ADDR"];
$timenow = date("Y-m-d H:i:s");
$author_id = 0;
if (isset($_COOKIE["userid"]))
{
    $author_id = $_COOKIE["userid"];
}
// print_r($_FILES);
$con=mysqli_connect(HOST, USERNAME, PASSWORD);
mysqli_set_charset($con, "utf8");
mysqli_select_db($con, 'experience_base');

$edit_pid=$_POST["pid"];
if (!$edit_pid)
{//new
  $insertsql= "INSERT INTO eb_passages(title, create_tm, author_id, content, extype1, extype2, tags, create_ip, last_tm)
  VALUES('$title', '$timenow', '$author_id', '$editor', '$extype1', '$extype2', '$tags', '$remote_ip', '$timenow')";

  if(mysqli_query($con, $insertsql))
  {
      $result = mysqli_query($con, "SELECT @@IDENTITY");
      $pid = mysqli_fetch_array($result)[0];

      if ($_FILES['file']['name'][0])
      {
        for ($i = 0; $i < count($_FILES['file']['name']); $i++)
        {
          if ($_FILES["file"]["error"][$i] > 0)
          {
            echo ("<script>$.notify({message: '".$_FILES["file"]["name"][$i]."上传失败:".$_FILES["file"]["error"][$i]."'}, {type: 'danger'});</script>");
          }
          else
          {
            echo ("<script>$.notify({message: '正在上传".$_FILES["file"]["name"][$i]."，请稍后。'}, {type: 'info'});</script>");

            if (!is_dir(CONTENT_FILE_STORE_PATH))
            {
                mkdir(CONTENT_FILE_STORE_PATH, 0777, true);
            }

            $file_name = $_FILES["file"]["name"][$i];
            $file_name_array = explode('.', $file_name);
            $save_file_path = str_replace("/", "\\", CONTENT_FILE_STORE_PATH . sprintf("/%06d", $pid) . sprintf("_%02d.", $i) . end($file_name_array));
            $pdf_file_path = str_replace("/", "\\", CONTENT_FILE_STORE_PATH . sprintf("/%06d", $pid) . sprintf("_%02d.pdf", $i));
            move_uploaded_file($_FILES["file"]["tmp_name"][$i], $save_file_path);

            if ($i == 0)
            {
              $update_sql = "UPDATE eb_passages SET file_name='$file_name' WHERE pid='$pid'";
            }
            else 
            {
              $separator = SEPARATOR;
              $update_sql = "UPDATE eb_passages SET file_name=CONCAT_WS('$separator',file_name,'$file_name') WHERE pid='$pid'";
            }
            mysqli_query($con, $update_sql);
          }
        }
      }
      else
      {
        // print_r('未上传文件');
      }

      echo ("<script>$.notify({message: '提交成功！'}, {type: 'success'});</script>");
      header("Refresh: 1; url=content.php?pid=$pid");
  }
  else
  {
      echo mysqli_error($con);
  }
}
else
{//edit
  $insertsql= "UPDATE eb_passages SET title='$title',content='$editor',extype1='$extype1',extype2='$extype2',tags='$tags',last_tm='$timenow',modify_tm='$timenow',modify_ip='$remote_ip'
                WHERE pid='$edit_pid'";
  if(mysqli_query($con, $insertsql))
  {
      echo ("<script>$.notify({message: '修改成功！'}, {type: 'success'});</script>");
      header("Refresh: 1; url=content.php?pid=$edit_pid");
  }
  else
  {
      echo mysqli_error($con);
  }
}
mysqli_close($con);
?>

</body>

</html>