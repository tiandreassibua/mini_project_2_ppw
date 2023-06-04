<?php

header('Content-Type: application/json');
include "./config.php";
session_start();

$userId = $_SESSION["id_user"];

$id = $_POST['id'];
$sql = "DELETE FROM events_dev WHERE id = '$id' AND id_user = '$userId'";
$results = $db->query($sql);

$message = "Kegiatan berhasil dihapus!";

if (!$results) {
    $message = "Kegiatan gagal dihapus!";
}

$json_data = json_encode($message);
echo $json_data;

?>