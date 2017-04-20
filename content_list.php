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
<?php include("common.php"); echo_banner("content_list"); ?>
<div style="margin: 60px"></div>
<div class="container">
<?php
require_once('config.php');
$con=mysqli_connect(HOST, USERNAME, PASSWORD);
mysqli_set_charset($con, "utf8");
mysqli_select_db($con, 'experience_base');
$result = mysqli_query($con, "SELECT * FROM eb_contents ORDER BY create_tm DESC LIMIT 15");
while($row = mysqli_fetch_array($result))
{?>
    <div class="items items-hover">
        <div class="item">
            <div class="item-heading">
                <div class="pull-right label label-success">标签</div>
                <h4><a href="content.php?cid=<?php echo $row['cid'];?>"><?php echo $row['title'];?></a></h4>
            </div>
            <div class="item-content">
                <div class="media pull-right"><img src="img/logo.png" alt=""></div>
                <div class="text"><?php echo mb_substr(strip_tags($row['content']), 0, 200, 'utf-8').'...';?></div>
            </div>
            <div class="item-footer">
                <a href="#" class="text-muted"><i class="icon-user"></i> <?php echo $row['uid'];?></a>
                &nbsp; &nbsp; 
                <a href="#" class="text-muted"><i class="icon-comments"></i> <?php echo $row['comment_num'];?></a> 
                &nbsp; &nbsp; 
                <span class="text-muted"><i class="icon-time"></i> <?php echo $row['create_tm'];?></span>
            </div>
        </div>
    </div>
<?php
}
mysqli_close($con);
?>
</div>

</body>

</html>