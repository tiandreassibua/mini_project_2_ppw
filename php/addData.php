<?php

include "./config.php";
session_start();

// $data = json_decode(file_get_contents("php://input"), true);
$data = $_POST;
$userId = $_SESSION["id_user"];

$fileName = NULL;
$image;
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

$message = "Kegiatan berhasil ditambahkan!";
if (!$results) {
    $message = "Kegiatan gagal ditambahkan!";
}

echo $message;




// move_uploaded_file($_FILES['image']['tmp_name'], '../images/' . $image_name);


// $image_name = $image['name'];
// $day = $data['day'];
// $month = $data['month'];
// $year = $data['year'];
// $title = $data['title'];
// $time = $data['time'];
// $location = $data['location'];
// $description = $data['description'];
// $level = $data['level'];
// $startTime = $data['startTime'];
// $endTime = $data['endTime'];
// $duration = $data['duration'];


// $sql = "INSERT INTO events_dev (day, month, year, title, location, description, level, start_time, end_time, duration, time, id_user, image) VALUES ('$day', '$month', '$year', '$title', '$location', '$description', '$level', '$startTime', '$endTime', '$duration', '$time', '$userId', '$image_name')";
// $results = $db->query($sql);


// $message = "Kegiatan berhasil ditambahkan!";
// if (!$results) {
//     $message = "Kegiatan gagal ditambahkan!";
// }

// echo $message;
