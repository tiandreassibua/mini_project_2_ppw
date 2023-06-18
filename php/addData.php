<?php

include "./config.php";
session_start();

$data = $_POST;
$userId = $_SESSION["id_user"];

$fileName = NULL;
$image;

// memvalidasi apakah ada file yang diupload.
// jika ada, maka file akan diupload ke folder images.
if (!empty($_FILES['image']['name'])) {
    $image = $_FILES['image'];
    $ext = strtolower(pathinfo($image['name'], PATHINFO_EXTENSION));
    $fileName = $_SESSION["nama"] . "_" . time() . '.' . $ext;
    move_uploaded_file($image['tmp_name'], '../images/' . $fileName);
}

$day = $data['day'];
$month = $data['month'];
$year = $data['year'];
$title = $data['title'];
$time = $data['time'];
$location = $data['location'];
$description = $data['description'];
$level = $data['level'];
$startTime = $data['startTime'];
$endTime = $data['endTime'];
$duration = $data['duration'];

$sql = "INSERT INTO events_dev (day, month, year, title, location, description, level, start_time, end_time, duration, time, id_user, image) VALUES ('$day', '$month', '$year', '$title', '$location', '$description', '$level', '$startTime', '$endTime', '$duration', '$time', '$userId', '$fileName')";
$results = $db->query($sql);

// menampilkan pesan apakah data berhasil ditambahkan atau tidak.
// sebagai defaultnya, data berhasil ditambahkan.
$message = "Kegiatan berhasil ditambahkan!";
if (!$results) {
    // jika gagal maka akan menampilkan pesan gagal.
    $message = "Kegiatan gagal ditambahkan!";
}

echo $message;