<?php

header('Content-Type: application/json'); // membuat response menjadi json

include "./config.php"; // memanggil koneksi ke database.
session_start(); // memulai session.

$userId = $_SESSION["id_user"]; // mengambil id user dari session.

// mengambil semua data dari database
$id = $_GET["id"];
$sql = "SELECT * FROM events_dev WHERE id = '$id' AND id_user = '$userId'";
$results = $db->query($sql);

// mengkonversi hasil query ke array.
$events = [];
foreach ($results as $row) {
    $events[] = array(
        'day' => $row['day'],
        'month' => $row['month'],
        'year' => $row['year'],
        'title' => $row['title'],
        'time' => $row['time'],
        'location' => $row['location'],
        'description' => $row['description'],
        'start_time' => $row['start_time'],
        'end_time' => $row['end_time'],
        'level' => $row['level'],
        'duration' => $row['duration'],
        'id' => $row['id'],
        'image' => $row['image']
    );
}

// mengkonversi array ke JSON
$json_data = json_encode($events);

// menampilkan data json.
echo $json_data;