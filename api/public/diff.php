<?php
require_once 'config.php';
if (!isset($_GET['date1'], $_GET['date2'])) {
    http_response_code(400);
    echo json_encode(['error' => 'Missing date1 or date2']);
    exit;
}
$ts1 = strtotime($_GET['date1']);
$ts2 = strtotime($_GET['date2']);
if (!$ts1 || !$ts2) {
    http_response_code(400);
    echo json_encode(['error' => 'Invalid date format, use YYYY-MM-DD']);
    exit;
}
$diff = abs($ts2 - $ts1) / (60 * 60 * 24);
echo json_encode(['diff_days' => (int)$diff]);

