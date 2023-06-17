<?php

header('Content-Type: application/json');
include "./config.php";
session_start();

$userId = $_SESSION["id_user"];

// Get the data from the database.
$id = $_GET["id"];
$sql = "SELECT * FROM events_dev WHERE id = '$id' AND id_user = '$userId'";
$results = $db->query($sql);

// Convert the results to an array.
$events = [];
foreach ($results as $row) {
    $events[] = array(
        'day' => $row['day'],
        'month' => $row['month'],
        'year' => $row['year'],
        'title' => $row['title'],
        'time' => $row['time'],
        'location' => $row['location'],
        'description' => $row['description'],
        'start_time' => $row['start_time'],
        'end_time' => $row['end_time'],
        'level' => $row['level'],
        'duration' => $row['duration'],
        'id' => $row['id'],
        'image' => $row['image']
    );
}

$json_data = json_encode($events);
echo $json_data;