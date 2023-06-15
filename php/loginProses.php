<?php

// header('Content-Type: application/json');
include "config.php";

$data = json_decode(file_get_contents("php://input"), true);

$uname = $data["username"];
$pwd_hash = md5($data["password"]);

$sql = "SELECT * FROM users WHERE username = '$uname' AND password = '$pwd_hash'";
$result = $conn->query($sql);

$msg = array(
    "status" => null,
    "message" => ""
);

if (mysqli_num_rows($result) > 0) {
    session_start();
    $user = mysqli_fetch_assoc($result);
    $_SESSION["isLogin"] = true;
    $_SESSION["id_user"] = $user["id_user"];
    $_SESSION["nama"] = $user["nama_lengkap"];
    
    $msg["status"] = 1;
    $msg["message"] = "Login berhasil";
    $msg["user"] = $user["nama_lengkap"];
} else {
    $msg["status"] = 0;
    $msg["message"] = "Username atau password salah!";  
}

$json = json_encode($msg);

echo $json;
