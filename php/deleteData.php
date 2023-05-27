<?php

header('Content-Type: application/json');
include "./config.php";

$id = $_POST['id'];
$sql = "DELETE FROM events WHERE id = '$id'";
$results = $db->query($sql);

$message = "Kegiatan berhasil dihapus!";

if (!$results) {
    $message = "Kegiatan gagal dihapus!";
}

$json_data = json_encode($message);
echo $json_data;

?>