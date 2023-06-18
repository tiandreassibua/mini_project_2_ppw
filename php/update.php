<?php

include "config.php"; // memanggil koneksi ke database.
session_start(); // memulai session.

$data = $_POST; // mengambil data dari form.
$id = $data['id']; // mengambil id dari form.

// mengambil data dari database.
$fetch = $conn->query("SELECT * FROM events_dev WHERE id = '$id'")->fetch_assoc();

$fileName = NULL;
$image;

// validasi apakah ada gambar yang diupload.
if (!empty($_FILES['image']['name'])) {
    $image = $_FILES['image'];
    $ext = strtolower(pathinfo($image['name'], PATHINFO_EXTENSION));
    $fileName = $_SESSION["nama"] . "_" . time() . '.' . $ext;
    
    unlink('../images/' . $fetch['image']); // menghapus gambar yang lama
    move_uploaded_file($image['tmp_name'], '../images/' . $fileName); // mengupload gambar baru
}

$day = $data['day']; // mengambil data day dari form.
$month = $data['month']; // mengambil data month dari form.
$year = $data['year']; // mengambil data year dari form.
$title = $data['title']; // mengambil data title dari form.
$description = $data['description']; // mengambil data description dari form.
$location = $data['location']; // mengambil data location dari form.
$startTime = $data['startTime']; // mengambil data waktu mulai dari form.
$endTime = $data['endTime']; // mengambil data waktu selesai dari form.
$level = $data['level']; // mengambil data level dari form.
$time = $data['time']; // mengambil data time dari form.
$duration = $data['duration']; // mengambil data durasi dari form.

// query sql untuk mengubah data tanpa gambar
$sql = "UPDATE events_dev SET day = '$day', month = '$month', year = '$year', title = '$title', description = '$description', location = '$location', start_time = '$startTime', end_time = '$endTime', level = '$level', time = '$time', duration = '$duration' WHERE id = '$id'";
if ($fileName != NULL) {
    // query sql untuk mengubah data dengan gambar
    $sql = "UPDATE events_dev SET day = '$day', month = '$month', year = '$year', title = '$title', description = '$description', location = '$location', start_time = '$startTime', end_time = '$endTime', level = '$level', time = '$time', duration = '$duration', image = '$fileName' WHERE id = '$id'";
}

$result = mysqli_query($conn, $sql); //

$message = "Terjadi kesalahan saat mengubah kegiatan!";
if ($result) $message = "Kegiatan berhasil diubah!";

echo $message;
