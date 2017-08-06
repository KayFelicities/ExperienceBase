<!DOCTYPE html >
<html>

<head>


<link rel="stylesheet" href="style/css/carousel.css">

<script src="style/js/jquery.js"></script>
<link rel="stylesheet" href="style/css/bootstrap.css">
<script src="style/js/bootstrap.js"></script>
  <link href="//netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.min.css" rel="stylesheet" type="text/css">
<link href="style/summernote/summernote.css" rel="stylesheet">
<script src="style/summernote/summernote.js"></script>
<script src="style/summernote/summernote-zh-CN.js"></script>

  <title>bootstrap-markdown</title>
  <style>
    .note-alarm {
      float: right;
      margin-top: 10px;
      margin-right: 10px;
    }
  </style>
</head>

<body>
  <div id="summernote"></div>


  <script type="text/javascript">
    //调用富文本编辑
    $(document).ready(function() {
        var $summernote = $('#summernote').summernote({
            height: 300,
            minHeight: null,
            maxHeight: null,
            focus: true,
            //调用图片上传
            callbacks: {
                onImageUpload: function (files) {
                    sendFile($summernote, files[0]);
                }
            }
        });

        //ajax上传图片
        function sendFile($summernote, file) {
            var formData = new FormData();
            formData.append("file", file);
            formData.append("dir", 'test');
            $.ajax({
                url: "upload_img_ajax.php",//路径是你控制器中上传图片的方法，下面controller里面我会写到
                data: formData,
                cache: false,
                contentType: false,
                processData: false,
                type: 'POST',
                success: function (data) {
                    $summernote.summernote('insertImage', data, function ($image) {
                        $image.attr('src', data);
                    });
                }
            });
        }
    });
    </script>


</body>

</html>