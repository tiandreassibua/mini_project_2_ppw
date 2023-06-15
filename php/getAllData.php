<?php

header('Content-Type: application/json');
// Create a connection to the database.
include "./config.php";
session_start();

$userId = $_SESSION["id_user"];

// Get the data from the database.
$sql = "SELECT DISTINCT day, month, year FROM events WHERE id_user = '$userId'";
$results = $db->query($sql);

// Convert the results to an array.
$events = [];
foreach ($results as $row) {
    $events[] = array(
        'day' => $row['day'],
        'month' => $row['month'],
        'year' => $row['year'],
        'events' => array()
    );
}

for ($i=0; $i < count($events); $i++) { 
    $sql = 'SELECT * FROM events WHERE day = ' . $events[$i]['day'] . ' AND month = ' . $events[$i]['month'] . ' AND year = ' . $events[$i]['year']. ' AND id_user = '. $userId .'  ORDER BY level DESC';
    $results = $db->query($sql);
    foreach ($results as $row) {
        $events[$i]['events'][] = array(
            'id' => $row['id'],
            'title' => $row['title'],
            'description' => $row['description'],
            'location' => $row['location'],
            'time' => $row['time'],
            'level' => $row['level'],
            'duration' => $row['duration'],
            'start_time' => $row['start_time'],
            'end_time' => $row['end_time']
        );
    }
}

// Convert the array to JSON.
$json_data = json_encode($events);

// echo the JSON data.
echo $json_data;

?>