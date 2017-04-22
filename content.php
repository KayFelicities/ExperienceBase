<!DOCTYPE HTML>
<html>
<meta charset="UTF-8">
<title>经验分享平台</title>
<link rel="bookmark" type="image/x-icon" href="+1.ico" />
<link rel="shortcut icon" href="+1.ico">
<link rel="icon" href="+1.ico">
<link rel="stylesheet" href="style/css/bootstrap.css">
<link rel="stylesheet" href="style/css/carousel.css">
<script src="style/js/jquery.js"></script>
<script src="style/js/bootstrap.js"></script>

<body>
<?php include("common.php"); echo_banner("content"); ?>
<div style="margin: 60px"></div>
<div class="container">
<?php
$cid = $_GET['cid'];
require_once('config.php');
$con=mysqli_connect(HOST, USERNAME, PASSWORD);
mysqli_set_charset($con, "utf8");
mysqli_select_db($con, 'experience_base');
$result = mysqli_query($con, "SELECT * FROM eb_contents WHERE cid=$cid");
$row = mysqli_fetch_array($result);
?>
    <div class="content-header">
        <h1><?php echo $row['title']?></h1>

        <a href="#" class="text-muted"><i class="icon-user"></i> <?php echo $row['author'];?></a>
        &nbsp; &nbsp; 
        <a href="#" class="text-muted"><i class="icon-comments"></i> <?php echo $row['comment_num'];?></a> 
        &nbsp; &nbsp; 
        <span class="text-muted"><i class="icon-time"></i> <?php echo $row['create_tm'];?></span>

    </div>

    <div>
    <?php
        echo $row['content'];
    ?>
    </div>

    <div>
        <hr>
        <h6>文件列表：</h6>
        <?php
        if ($row['file_name'])
        {
            $file_name = $row['file_name'];
            $file_name_array = explode('.', $file_name);
            $save_file_path = CONTENT_FILE . sprintf("/%06d", $cid) . "_01." . end($file_name_array);
            echo "<a download=\"$file_name\" href=\"$save_file_path\">$file_name</a>";
        }
        else
        {
            echo "<p>无</p>";
        }
        ?>
    </div>

</div>

</body>

</html>