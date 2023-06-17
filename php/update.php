<?php

include "config.php";
// header('Content-Type: application/json');
session_start();
// $data = json_decode(file_get_contents("php://input"), true);

$data = $_POST;
$id = $data['id'];

$fetch = $conn->query("SELECT * FROM events_dev WHERE id = '$id'")->fetch_assoc();

$fileName = NULL;
$image;
if (!empty($_FILES['image']['name'])) {
    $image = $_FILES['image'];
    $ext = strtolower(pathinfo($image['name'], PATHINFO_EXTENSION));
    $fileName = $_SESSION["nama"] . "_" . time() . '.' . $ext;
    unlink('../images/' . $fetch['image']);
    move_uploaded_file($image['tmp_name'], '../images/' . $fileName);
}

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

$sql = "UPDATE events_dev SET day = '$day', month = '$month', year = '$year', title = '$title', description = '$description', location = '$location', start_time = '$startTime', end_time = '$endTime', level = '$level', time = '$time', duration = '$duration' WHERE id = '$id'";
if ($fileName != NULL) {
    $sql = "UPDATE events_dev SET day = '$day', month = '$month', year = '$year', title = '$title', description = '$description', location = '$location', start_time = '$startTime', end_time = '$endTime', level = '$level', time = '$time', duration = '$duration', image = '$fileName' WHERE id = '$id'";
}

$result = mysqli_query($conn, $sql);

$message = "Terjadi kesalahan saat mengubah kegiatan!";
if ($result) $message = "Kegiatan berhasil diubah!";

echo $message;
