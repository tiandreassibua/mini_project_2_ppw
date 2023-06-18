<?php

include "./config.php";

$data = json_decode(file_get_contents("php://input"), true); // mengambil data dari request.

$fname = $data["fullname"]; // mengambil fullname dari request
$uname = $data["username"]; // mengambil username dari request
$pwd = $data["password"]; // mengambil password dari request

$pwd = md5($pwd); // mengenkripsi password menggunakan md5
$msg = array(); // membuat response untuk dikirim kembali ke client.

// membuat query untuk mengecek apakah username sudah digunakan atau belum.
$sql = "SELECT username FROM users WHERE username = '$uname'";

// mengeksekusi query.
$cekUname = $conn->query($sql);

// mengecek apakah username sudah digunakan atau belum.
if (mysqli_num_rows($cekUname) > 0) {
    $msg["status"] = 0;
    $msg["message"] = "Username sudah digunakan!";
} else {
    // membuat query untuk menyimpan data user ke database.
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

$json_data = json_encode($msg); // mengkonversi array ke JSON.
echo $json_data; // mengirim response ke client.

?>