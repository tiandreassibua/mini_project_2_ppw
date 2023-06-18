<?php

header('Content-Type: application/json');
// memanggil koneksi ke database.
include "./config.php";
session_start();

$userId = $_SESSION["id_user"];

// mengambil seluruh kegiatan dari database.
$sql = "SELECT DISTINCT day, month, year FROM events_dev WHERE id_user = '$userId'";
$results = $conn->query($sql);

// konversi hasil query ke array.
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
    $sql = 'SELECT * FROM events_dev WHERE day = ' . $events[$i]['day'] . ' AND month = ' . $events[$i]['month'] . ' AND year = ' . $events[$i]['year']. ' AND id_user = '. $userId .'  ORDER BY level DESC';
    $results = $conn->query($sql);
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
            'end_time' => $row['end_time'],
            'image' => $row['image'],
        );
    }
}

// mengkonversi array ke JSON
$json_data = json_encode($events);

// menampilkan data json.
echo $json_data;

?>