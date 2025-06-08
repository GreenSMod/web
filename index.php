<?php
    include 'upload.php';

    function gallery_log() {
        if (!is_dir('logs/')) {
            mkdir('logs/');
        }
        $log = date('l, Y/m/d. H:i:s, e.') . PHP_EOL;
        $dest = 'logs/log.txt';
        if (count(file($dest)) > 9) {
            $log_files_number = count(array_slice(scandir('logs'), 2)) - 1;
            rename($dest, 'logs/log' . $log_files_number . '.txt');
        }
        file_put_contents($dest, $log, FILE_APPEND);
    }

    gallery_log();

    $messages = [
        'ok' => "Файл загружен",
        'error' => "Ошибка загрузки"
    ];

    if (!empty($_FILES)) {
        $path = "img/big/" . $_FILES["img_file"]["name"];
        if (check_upload_file()) {
            if (move_uploaded_file($_FILES['img_file']['tmp_name'], $path)) {
                $img = imagecreatefromjpeg($path);
                $imgScale = imagescale($img , 200);
                imagejpeg($imgScale, "img/small/" . $_FILES["img_file"]["name"]);
                $message = "ok";
            }
            else {
                $message = "error";
            }
        }
        else {
            $message = "error";
        }
        header("Location: index.php?status=$message");
        die();
    }

    $message = '';
    if(!empty($_GET['status'])) {
        $message = $messages[$_GET['status']];
    }

    function createGallery($path)
    {
        if (!is_dir($path)) {
            mkdir($path);
        }
        if (!is_dir($path . 'big')) {
            mkdir($path . 'big');
        }
        if (!is_dir($path . 'small')) {
            mkdir($path . 'small');
        }
        foreach (array_slice(scandir($path . 'big'), 2) as $image) {
            echo '<a target="_blank" href="' . $path . 'big/' . $image . '">
            <img src="' . $path . 'small/' . $image . '" alt="\'$image\'"></a>';
        }
    }
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gallery</title>
</head>
<body>
    <?=$message?>
    <form method="post" enctype="multipart/form-data">
        <input type="file" name="img_file">
        <input type="submit" value="Загрузить">
    </form>
    <?php
        createGallery('img/');
    ?>
</body>
</html>