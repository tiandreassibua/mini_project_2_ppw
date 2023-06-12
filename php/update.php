<?php

include "config.php";
header('Content-Type: application/json');
session_start();

$id = $_POST['id'];
$day = $_POST['day'];
$month = $_POST['month'];
$year = $_POST['year'];
$title = $_POST['title'];
$description = $_POST['description'];
$location = $_POST['location'];
$startTime = $_POST['startTime'];
$endTime = $_POST['endTime'];
$level = $_POST['level'];
$time = $_POST['time'];
$duration = $_POST['duration'];

$sql = "UPDATE events_dev SET day = '$day', month = '$month', year = '$year', title = '$title', description = '$description', location = '$location', start_time = '$startTime', end_time = '$endTime', level = '$level', time = '$time', duration = '$duration' WHERE id = '$id'";
$result = mysqli_query($conn, $sql);

$message = "Terjadi kesalahan saat mengubah kegiatan!";

if ($result) {
    $message = "Kegiatan berhasil diubah!";
}

$json_data = json_encode($message);
echo $json_data;




?>