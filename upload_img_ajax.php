<?php
    $dir = $_POST["dir"];
    require_once('config.php');
    if (!is_dir(IMG_FILE_STORE_PATH . DIRECTORY_SEPARATOR . $dir))
    {
        mkdir(IMG_FILE_STORE_PATH . DIRECTORY_SEPARATOR . $dir, 0777, true);
    }

    if ($_FILES) {
        if (!$_FILES['file']['error']) {
            list($usec, $sec) = explode(" ", microtime());
            $name = ((float)$usec + (float)$sec) * 10000;
            $ext = explode('.', $_FILES['file']['name']);
            $filename = $name . '.' . $ext[1];
            $location = $_FILES["file"]["tmp_name"];
            $destination = IMG_FILE_STORE_PATH . DIRECTORY_SEPARATOR . $dir . DIRECTORY_SEPARATOR . $filename;
            move_uploaded_file($location, $destination);
            echo IMG_FILE_PATH . DIRECTORY_SEPARATOR . $dir . DIRECTORY_SEPARATOR . $filename;
        } else {
            echo $message = 'upload img error:  ' . $_FILES['file']['error'];
        }
    }

?>
