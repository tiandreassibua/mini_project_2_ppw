<?php

$host = "localhost"; // host dari database
$username = "root"; // username dari database
$password = ""; // password dari database
$dbname = "test"; // nama database

// membuat koneksi ke database
$conn = new mysqli($host, $username, $password, $dbname) or die("Koneksi ke database gagal!");

// koneksi database PDO
$db = new PDO("mysql:host=$host;dbname=$dbname", $username, $password) or die("Koneksi ke database gagal!"); 