<?php

session_start(); // memulai session.
session_destroy(); // menghapus seluruh session.

header("location: ../login.php"); // arahkan ke halaman login

?>