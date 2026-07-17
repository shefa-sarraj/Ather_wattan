<?php
header('Content-Type: application/json');
include 'connection.php';

$sql = "SELECT * FROM cities";
$result = $conn->query($sql);
$cities = [];

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $cities[] = [
            'id' => $row['id'],
            'name' => $row['name'],
            'region' => $row['region'],
            'cover_image' => $row['cover_image']
        ];
    }
}

echo json_encode($cities);
$conn->close();
?>