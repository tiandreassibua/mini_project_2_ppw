<?php

header('Content-Type: application/json');
include "./config.php";

$fname = $_POST["fullname"];
$uname = $_POST["username"];
$pwd = $_POST["password"];

$pwd = md5($pwd);
$msg = array();

$sql = "SELECT username FROM users WHERE username = '$uname'";
$cekUname = $conn->query($sql);

if (mysqli_num_rows($cekUname) > 0) {
    $msg["status"] = 0;
    $msg["message"] = "Username sudah digunakan!";
} else {
    $sql = "INSERT INTO users (nama_lengkap, username, password) VALUES ('$fname', '$uname', '$pwd')";
    $result = $db->query($sql);

    if ($result) {
        $msg["status"] = 1;
        $msg["message"] = "Registrasi berhasil, silahkan login!";
    } else {
        $msg["status"] = 0;
        $msg["message"] = "Tidak dapat melakukan registrasi!";
    }
}


$json_data = json_encode($msg);
echo $json_data;

?>