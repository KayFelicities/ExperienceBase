<!DOCTYPE HTML>
<html>
<meta name="renderer" content="webkit"> 
<meta charset="UTF-8">
<title>经验共享平台</title>
<link rel="bookmark" type="image/x-icon" href="img/+1.ico" />
<link rel="shortcut icon" href="img/+1.ico">
<link rel="icon" href="img/+1.ico">
<link rel="stylesheet" href="style/css/bootstrap.css">
<script src="style/js/jquery.js"></script>
<script src="style/js/bootstrap.js"></script>

<!--imgcrop-->
<script src="style/js/angular.js"></script>
<script src="style/js/ng-img-crop.js"></script>
<link rel="stylesheet" type="text/css" href="style/css/ng-img-crop.css">

<style>
.cropArea {
  background: #E4E4E4;
  overflow: hidden;
  width:300px;
  height:200px;
}
#swapimg {
  display: none;
}
#myavatar
{
  /*float: right;*/
}
</style>

<script>
function delCookie(name) {
  var d = new Date();
  d.setTime(d.getTime() - 1);
  var expires = "expires="+d.toUTCString();
  document.cookie = name + "=" + "" + "; " + expires;
}

angular.module('app', ['ngImgCrop'])
.controller('Ctrl', function($scope) {
  $scope.myImage='';
  $scope.myCroppedImage='';

  var handleFileSelect=function(evt) {
    var file=evt.currentTarget.files[0];
    var reader = new FileReader();
    reader.onload = function (evt) {
      $scope.$apply(function($scope){
        $scope.myImage=evt.target.result;
      });
    };
    reader.readAsDataURL(file);
  };
  angular.element(document.querySelector('#fileInput')).on('change',handleFileSelect);
});
</script>

<body>
<?php include("common.php"); echo_banner("myconfig"); ?>
<div style="margin: 60px"></div>
<div class="container">
<?php if (!isset($_COOKIE["userid"])){echo "请<a href='login.php'>登录</a>";}else{?>
  <header>
    <h3><i></i>个人设置<small></small></h3>
  </header>
  <hr>
  <form method="post" action="myconfig_action.php">
    <div id="myavatar">
      <img class="avatar-xxxl" src="<?php echo get_avatar($_COOKIE["userid"]);?>" />
      <div ng-app="app" ng-controller="Ctrl">
        <div>选择新头像: <input type="file" id="fileInput" /></div>
        <div class="cropArea">
          <img-crop image="myImage" result-image="myCroppedImage" result-image-size="400" area-type="square"></img-crop>
        </div>
        <input class="text" id="swapimg" name="imgbase64" value="{{myCroppedImage}}">
        <button class="btn btn-primary">保存</button>
      </div>
    </div>
  </form>
<?php }?>
</div>

<?php echo_webfooter(); ?>
</body>

</html>