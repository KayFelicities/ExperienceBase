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

$title=$_POST["title"];
$editor=$_POST["editor"];
$extype1=$_POST["extype1"];
$extype2=$_POST["extype2"];
$tags=str_replace(',', SEPARATOR, $_POST["tags"]);
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
$insertsql= "INSERT INTO eb_contents(title, create_tm, author_id, content, extype1, extype2, tags, create_ip)
VALUES('$title', '$timenow', '$author_id', '$editor', '$extype1', '$extype2', '$tags', '$remote_ip')";

if(mysqli_query($con, $insertsql))
{
    $result = mysqli_query($con, "SELECT @@IDENTITY");
    $cid = mysqli_fetch_array($result)[0];

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

            if (!is_dir(CONTENT_FILE))
            {
                mkdir(CONTENT_FILE, 0777, true);
            }

            $file_name = $_FILES["file"]["name"][$i];
            $file_name_array = explode('.', $file_name);
            $save_file_path = str_replace("/", "\\", getcwd()."/".CONTENT_FILE . sprintf("/%06d", $cid) . sprintf("_%02d.", $i) . end($file_name_array));
            $pdf_file_path = str_replace("/", "\\", getcwd()."/".CONTENT_FILE . sprintf("/%06d", $cid) . sprintf("_%02d.pdf", $i));
            move_uploaded_file($_FILES["file"]["tmp_name"][$i], $save_file_path);

            if ($i == 0)
            {
              $update_sql = "UPDATE eb_contents SET file_name='$file_name' WHERE cid='$cid'";
            }
            else 
            {
              $separator = SEPARATOR;
              $update_sql = "UPDATE eb_contents SET file_name=CONCAT_WS('$separator',file_name,'$file_name') WHERE cid='$cid'";
            }
            mysqli_query($con, $update_sql);

            switch(end($file_name_array))
            {
              case "doc":
              case "docx":
                $word = new COM("Word.application") or error_handler("Unable to instanciate word!");
                $word->Visible = false;
                $word->Documents->Open($save_file_path);
                $word->ActiveDocument->SaveAs($pdf_file_path, 17); 
                $word->ActiveDocument->Close();
                $word->Quit();
                $word = null;
                exec("233 " . $pdf_file_path);
                break;
              case "xls":
              case "xlsx":
                $excel = new COM("Excel.application") or error_handler("Unable to instanciate excel!");
                $excel->Visible = false; $excel->Workbooks->Open($save_file_path);
                $count = $excel->ActiveWorkbook->Sheets->Count;
                //轮询给每个workbook设定pagesetup参数，横版，papersize，缩放(适合页宽)
                for($i = 1; $i <= $count; $i ++)
                {
                  $excel->ActiveWorkbook->Sheets($i)->Activate;
                  $excel->ActiveWorkbook->ActiveSheet->PageSetup->Orientation = 2; // Landscape 2 // Portrait 1
                  $excel->ActiveWorkbook->ActiveSheet->PageSetup->PaperSize = 9; //xlPaperA4 9
                  $excel->ActiveWorkbook->ActiveSheet->PageSetup->Zoom = false;
                  $excel->ActiveWorkbook->ActiveSheet->PageSetup->FitToPagesWide = 1; // true
                }
                $excel->ActiveWorkbook->ExportAsFixedFormat(0, $pdf_file_path, 0, true, true);
                $excel->ActiveWorkbook->Close(false);
                $excel->Quit();
                $excel = null;
                exec("233 ".$pdf_file_path);
                break;
              case "ppt":
              case "pptx":
                $ppt = new COM("PowerPoint.application") or error_handler("Unable to instanciate PowerPoint!");
                $ppt->Visible = true;
                $ppt->Presentations->Open($save_file_path);
                $ppt->ActivePresentation->SaveAs($pdf_file_path, 32);
                $ppt->ActivePresentation->Close();
                $ppt->Quit(); 
                $ppt = null;
                exec("233 ".$pdf_file_path);
                break;
            }
        }
      }
    }
    else
    {
      print_r('未上传文件');
    }

    echo ("<script>$.notify({message: '提交成功！'}, {type: 'success'});</script>");
    header("Refresh: 1; url=content.php?cid=$cid");
}
else
{
    echo mysqli_error($con);
}
mysqli_close($con);
?>

</body>

</html>