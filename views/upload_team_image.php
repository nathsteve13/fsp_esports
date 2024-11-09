<?php
// uploadgambar.php

$nama_file = $_POST['namaFile'];
$photo = $_FILES['photo'];

// Validasi hanya file .jpg yang diperbolehkan
$imageFileType = strtolower(pathinfo($photo['name'], PATHINFO_EXTENSION));
if ($imageFileType != 'jpg' && $imageFileType != 'jpeg') {
    echo "Only JPG files are allowed.";
    exit;
}

// Lokasi penyimpanan file
$targetDir = $_SERVER['DOCUMENT_ROOT'] . "/public/images/teams/";
$targetFile = $targetDir . $nama_file . ".jpg";

// Buat folder jika belum ada
if (!is_dir($targetDir)) {
    mkdir($targetDir, 0777, true);
}

// Simpan file
if (move_uploaded_file($photo['tmp_name'], $targetFile)) {
    echo "Image uploaded successfully";
} else {
    echo "Failed to upload image";
}
?>
