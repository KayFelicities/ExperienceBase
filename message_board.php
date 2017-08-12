<!DOCTYPE HTML>
<html>
<meta name="renderer" content="webkit"> 
<meta charset="UTF-8">
<title>经验共享平台</title>
<link rel="bookmark" type="image/x-icon" href="img/+1.ico" />
<link rel="shortcut icon" href="img/+1.ico">
<link rel="icon" href="img/+1.ico">
<link rel="stylesheet" href="style/css/bootstrap.css">
<link rel="stylesheet" href="style/css/carousel.css">
<script src="style/js/jquery.js"></script>
<script src="style/js/bootstrap.js"></script>

<!--editor-->
<link href="style/summernote/summernote.css" rel="stylesheet">
<script src="style/summernote/summernote.js"></script>
<script src="style/summernote/summernote-zh-CN.js"></script>

<body>
<?php include("common.php"); echo_banner("message"); ?>
<div style="margin: 60px"></div>
<div class="container">
    <div class="page-header">
        <h3>留言板<small>有任何问题或建议请务必在此留言，谢谢！</small></h3>
    </div>

    <div class="reply-form" id="leave-message">
        <form class="form" method="post" action="message_action.php">
            <div class="form-group">
                <div class="row">
                    <div class="col-sm-10">
                        <div class="row">
                            <div class="col-sm-12">
                                <textarea class="form-control" name="comment" rows="2" placeholder="撰写留言..." required></textarea>
                                 <div style="margin-top: 5px;"></div> 
                            </div>
                            <div class="col-sm-5">
                                <input type="text" class="form-control" name="user" placeholder="留言显示名称" required>
                            </div>
                            <div class="col-sm-7">
                                <input type="text" class="form-control" name="email" placeholder="联系方式（不会显示在留言中，可选）">
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-2">
                        <div style="margin-top: 5px;"></div> 
                        <button type="submit" class="btn btn-block btn-success"><i class="icon icon-check icon-5x"></i></button>
                    </div>
                </div>
            </div>
        </form>
    </div>

<?php
require_once('config.php');
$con=mysqli_connect(HOST, USERNAME, PASSWORD);
mysqli_set_charset($con, "utf8");
mysqli_select_db($con, 'experience_base');
$result = mysqli_query($con, "SELECT * FROM eb_message_board WHERE parent_mid='0' and status='publish' ORDER BY priority DESC,mid DESC");
while ($row = mysqli_fetch_array($result))
{?>
    <div class="comments-list">
        <div class="comment">
            <div class="content">
            <div class="pull-right text-muted"><?php echo get_readable_tm($row['create_tm']); ?></div>
            <div><strong>
                <i class="icon icon-angle-right"></i><?php echo $row['name'];?>
            </strong></div>
            <div class="text"><?php if ($row['priority'] > 0){echo '<b>[置顶]</b>';} echo $row['comment'];?></div>
            <div class="actions">
                <!-- <a href="##" class="pull-right">回复</a> -->
            </div>
            </div>
        </div>
    </div>
<?php
}
?>

</div>

<?php
mysqli_close($con);
?>

<?php echo_webfooter(); ?>
</body>

</html>