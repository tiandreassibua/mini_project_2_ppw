<?php

$db = new PDO('mysql:host=localhost;dbname=my_calendar', 'root', '') or die("PDO connect error");
$conn = new mysqli("localhost", "root", "", "my_calendar") or die("new mysqli connect error");

?>