<html>
<head>
  <script src="style/js/angular.js"></script>
  <script src="style/js/ng-img-crop.js"></script>
  <link rel="stylesheet" type="text/css" href="style/css/ng-img-crop.css">

  <!--fileinput-->
  <link rel="stylesheet" href="style/css/fileinput.css">
  <script src="style/js/fileinput/fileinput.js"></script>
  <script src="style/js/fileinput/zh.js"></script>

  <style>
    .cropArea {
      background: #E4E4E4;
      overflow: hidden;
      width:500px;
      height:350px;
    }
  </style>
  <script>
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
</head>
<body ng-app="app" ng-controller="Ctrl">
  <div>Select an image file: <input type="file" id="fileInput" /></div>
  <div class="cropArea">
    <img-crop image="myImage" result-image="myCroppedImage"></img-crop>
  </div>
  <div>Cropped Image:</div>
  <div><img ng-src="{{myCroppedImage}}" /></div>
</body>
</html>