<?php

function check_upload_file() {
    $imgDir = "img/big/";
    $imgFile = $imgDir . basename($_FILES['img_file']['name']);
    $imgInfo = getimagesize($_FILES['img_file']['tmp_name']);

    if (file_exists($imgFile)) {
        echo "Файл с таким названием уже существует!";
        return false;
    }

    if ($_FILES['img_file']['size'] > 1024 * 1024 * 5) {
        echo "Размер файла не должен превышать 5 МБ!";
        return false;
    }

    if ($imgInfo['mime'] != 'image/jpeg') {
        echo "Можно загружать только jpg-файлы.";
        return false;
    }

    return true;
}