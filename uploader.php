<?php
// if (empty($_FILES['file'])) {
//     // No files found for upload.
//     echo json_encode(['error'=>'未发现文件']); 
//     return; 
// }

$images = $_FILES['file'];
$filenames = $images['name'];
$filetypes = $images['type'];
$filesizes = $images['size'];
$filetmps = $images['tmp_name'];

echo $filenames;

require_once('config.php');
if (!is_dir(TEMP_FILE_PATH))
{
    mkdir(TEMP_FILE_PATH, 0777, true);
}

$success = null;
for($i=0; $i < count($filenames); $i++){
    $ext = explode('.', basename($filenames));
    $target = TEMP_FILE_PATH . DIRECTORY_SEPARATOR . $filenames;
    if(move_uploaded_file($filetmps, $target)) {
        $success = true;
    } else {
        $success = false;
        break;
    }
}

if ($success === true) {
    $output = ['success'=>'上传成功'];
} else {
    $output = ['error'=>'上传失败'];
} 

echo json_encode($output);

// echo json_encode([
//     'initialPreview' => [
//         "img/logo.png"
//     ],
//     'initialPreviewConfig' => [
//         ['caption' => "Sports-logo.png", 'size' => 627392, 'width' => '120px'],
//     ],
//     'append' => true // whether to append these configurations to initialPreview.
//                      // if set to false it will overwrite initial preview
//                      // if set to true it will append to initial preview
//                      // if this propery not set or passed, it will default to true.
// ]);
?>