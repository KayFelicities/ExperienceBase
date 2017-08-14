<!DOCTYPE html>
<html lang="zh-CN">

<meta charset="utf-8">
<title>jQuery幻灯片插件skippr演示-默认_dowebok</title>
<style>
#container { width: 900px; height: 300px; margin: 0 auto;}
#skippr h2 { margin: 100px 0 0 100px; font: 50px "Microsoft Yahei"; color: #fff; text-shadow: 1px 1px 0 #000;}
#skippr p { margin: 10px 0 0 100px; font: 30px "Microsoft Yahei"; color: #fff; text-shadow: 1px 1px 0 #000;}
</style>
<link rel="stylesheet" href="style/css/jquery.skippr.css">
<script src="style/js/jquery.js"></script>
<script src="style/js/jquery.skippr.js"></script>
<script>
$(function(){
	$('#skippr').skippr();
});
</script>


<body>

		<div id="container">
			<div id="skippr">
				<div style="background-image: url(img/img1.jpg)">
					<h2>skippr</h2>
					<p>——更轻更快的 jQuery 幻灯片插件</p>
				</div>
				<div style="background-image: url(img/img2.jpg)">
					<h2>skippr</h2>
					<p>——更轻更快的 jQuery 幻灯片插件</p>
				</div>
				<div style="background-image: url(img/img3.jpg)">
					<h2>skippr</h2>
					<p>——更轻更快的 jQuery 幻灯片插件</p>
				</div>
				<div style="background-image: url(img/img4.jpg)">
					<h2>skippr</h2>
					<p>——更轻更快的 jQuery 幻灯片插件</p>
				</div>
				<div style="background-image: url(img/img5.jpg)">
					<h2>skippr</h2>
					<p>——更轻更快的 jQuery 幻灯片插件</p>
				</div>
			</div>
		</div>
		<!-- Demo end -->
</body>
</html>