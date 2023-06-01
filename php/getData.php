<?php

header('Content-Type: application/json');
include "./config.php";

// Get the data from the database.
$sql = "SELECT * FROM events WHERE id = " . $_GET['id'];
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
        'id' => $row['id']
    );
}

// Convert the array to JSON.
$json_data = json_encode($events);

// echo the JSON data.
echo $json_data;