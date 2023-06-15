<?php

include "./config.php";
session_start();

$data = json_decode(file_get_contents("php://input"), true);

$userId = $_SESSION["id_user"];

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

$sql = "INSERT INTO events (day, month, year, title, location, description, level, start_time, end_time, duration, time, id_user) VALUES ('$day', '$month', '$year', '$title', '$location', '$description', '$level', '$startTime', '$endTime', '$duration', '$time', '$userId')";
$results = $db->query($sql);


$message = "Kegiatan berhasil ditambahkan!";
if (!$results) {
    $message = "Kegiatan gagal ditambahkan!";
}

echo $message;

?>