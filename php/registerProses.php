<?php

header('Content-Type: application/json');
include "./config.php";

$fname = $_POST["fullname"];
$uname = $_POST["username"];
$pwd = $_POST["password"];

$pwd = md5($pwd);


$sql = "INSERT INTO users (nama_lengkap, username, password) VALUES ('$fname', '$uname', '$pwd')";
$result = $db->query($sql);

$msg = array();


if ($result) {
    $msg["status"] = 1;
    $msg["message"] = "Registrasi berhasil, silahkan login!";
} else {
    $msg["status"] = 0;
    $msg["message"] = "Tidak dapat melakukan registrasi!";  
}


$json_data = json_encode($msg);
echo $json_data;

?>