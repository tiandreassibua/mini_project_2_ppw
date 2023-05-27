<?php

header('Content-Type: application/json');
include "./config.php";

$day = $_POST['day'];
$month = $_POST['month'];
$year = $_POST['year'];
$title = $_POST['title'];
$time = $_POST['time'];
$location = $_POST['location'];
$description = $_POST['description'];
$level = $_POST['level'];

$sql = "INSERT INTO events (day, month, year, title, location, description, level, time) VALUES ('$day', '$month', '$year', '$title', '$location', '$description', '$level', '$time')";
$results = $db->query($sql);


$message = "Kegiatan berhasil ditambahkan!";
if (!$results) {
    $message = "Kegiatan gagal ditambahkan!";
}

$json_data = json_encode($message);
echo $json_data;

?>