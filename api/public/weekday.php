<?php
require_once 'config.php';
if (!isset($_GET['date'])) {
    http_response_code(400);
    echo json_encode(['error' => 'Missing date parameter']);
    exit;
}
$date = $_GET['date'];
$timestamp = strtotime($date);
if (!$timestamp) {
    http_response_code(400);
    echo json_encode(['error' => 'Invalid date format, use YYYY-MM-DD']);
    exit;
}
$weekdays = ['Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday'];
$weekday = $weekdays[date('w', $timestamp)];
echo json_encode(['date' => $date, 'weekday' => $weekday]);
