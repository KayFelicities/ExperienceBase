<!DOCTYPE html>
<html>
  <head>
     <title>cropit</title> 
    <!-- <link rel="stylesheet" href="style/css/bootstrap.css"> -->
    <script src="style/js/jquery.js"></script>
    <script src="style/js/bootstrap.js"></script>
    <script src="style/js/jquery.cropit.js"></script>

  <style>
      .cropit-preview {
        background-color: #f8f8f8;
        background-size: cover;
        border: 1px solid #ccc;
        border-radius: 3px;
        margin-top: 7px;
        width: 300px;
        height: 150px;
      }

      .cropit-preview-background {
        opacity: .2;
      }

      input.cropit-image-zoom-input {
        position: relative;
      }

      #image-cropper {
        overflow: hidden;
      }
  </style>
  </head>

  <script>
  function img_submit() {
    var imageData = $('#image-cropper').cropit('export', {
      type: 'image/jpeg',
      quality: .9,
    });

    if (imageData)
    {
      $('#jpg-src').val(imageData);
      alert(imageData);
      return true;
    }
    else
    {
      alert('test');
      return false;
    }
  }
  </script>

  <body>

<?php
  if (isset($_POST['jpg']))
  {
    $base_img = $_POST['jpg'];
    $path = './test.jpg';
    $base_img = explode('base64,', $base_img, 2)[1];
    file_put_contents($path, base64_decode($base_img));
    echo '<script>alert("done");</script>';
  }
?>

     <div id="image-cropper">
      <div class="cropit-preview"></div>
      <input type="range" class="cropit-image-zoom-input" />
      <input type="file" class="cropit-image-input" />
      <form method="post" onsubmit="return img_submit();">
        <input type="text" id="jpg-src" name="jpg" />
        <button class="btn btn-default">btn</button>
      </form>
    </div> 

    <script>
      $('#image-cropper').cropit({
        // imageBackground: true,
        maxZoom: 1.5,
        exportZoom: 2,
      });
    </script>
  </body>
</html>
