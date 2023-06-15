<?php

include "config.php";
// header('Content-Type: application/json');
session_start();

$data = json_decode(file_get_contents("php://input"), true);

$id = $data['id'];
$day = $data['day'];
$month = $data['month'];
$year = $data['year'];
$title = $data['title'];
$description = $data['description'];
$location = $data['location'];
$startTime = $data['startTime'];
$endTime = $data['endTime'];
$level = $data['level'];
$time = $data['time'];
$duration = $data['duration'];

$sql = "UPDATE events SET day = '$day', month = '$month', year = '$year', title = '$title', description = '$description', location = '$location', start_time = '$startTime', end_time = '$endTime', level = '$level', time = '$time', duration = '$duration' WHERE id = '$id'";
$result = mysqli_query($conn, $sql);

$message = "Terjadi kesalahan saat mengubah kegiatan!";
if ($result) $message = "Kegiatan berhasil diubah!";

echo $message;

?>