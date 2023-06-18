<?php

include "config.php"; // memanggil koneksi ke database.

$data = json_decode(file_get_contents("php://input"), true); // mengambil data dari request.

$uname = $data["username"]; // mengambil username dari request.

// mengambil password dari request kemudian di hash menggunakan md5.
// md5 adalah salah satu algoritma hash yang digunakan untuk mengenkripsi data.
$pwd_hash = md5($data["password"]);

// membuat query untuk mengambil data user dari database apakah ada atau tidak.
$sql = "SELECT * FROM users WHERE username = '$uname' AND password = '$pwd_hash'";
$result = $conn->query($sql);

// membuat response untuk dikirim kembali ke client.
$msg = array(
    "status" => null,
    "message" => ""
);

if (mysqli_num_rows($result) > 0) {
    // jika data user ada maka login berhasil.
    session_start();
    $user = mysqli_fetch_assoc($result);

    // membuat session untuk menyimpan data user.
    $_SESSION["isLogin"] = true;
    $_SESSION["id_user"] = $user["id_user"];
    $_SESSION["nama"] = $user["nama_lengkap"];
    
    // membuat response untuk dikirim kembali ke client.
    $msg["status"] = 1;
    $msg["message"] = "Login berhasil";
    $msg["user"] = $user["nama_lengkap"];
} else {
    // jika gagal maka login gagal.
    // kemudian membuat response untuk dikirim kembali ke client.
    $msg["status"] = 0;
    $msg["message"] = "Username atau password salah!";  
}

// mengkonversi array ke JSON.
$json = json_encode($msg);


echo $json;
