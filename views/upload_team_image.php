<?php

$nama_file = $_POST['namaFile'];
$photo = $_FILES['photo'];

$imageFileType = strtolower(pathinfo($photo['name'], PATHINFO_EXTENSION));
if ($imageFileType != 'jpg' && $imageFileType != 'jpeg') {
    echo "Only JPG files are allowed.";
    exit;
}

$targetDir = "../public/images/teams/";
$targetFile = $targetDir . $nama_file . ".jpg";

if (!is_dir($targetDir)) {
    mkdir($targetDir, 0777, true);
}

if (move_uploaded_file($photo['tmp_name'], $targetFile)) {
    echo "Image uploaded successfully";
} else {
    echo "Failed to upload image";
}
?>
