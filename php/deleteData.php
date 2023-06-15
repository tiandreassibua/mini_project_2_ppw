<?php

include "./config.php";
session_start();

$data = json_decode(file_get_contents("php://input"), true);

$userId = $_SESSION["id_user"];

$id = $data['id'];
$sql = "DELETE FROM events WHERE id = '$id' AND id_user = '$userId'";
$results = $db->query($sql);

$message = "Kegiatan berhasil dihapus!";

if (!$results) $message = "Kegiatan gagal dihapus!";

echo $message;

?>