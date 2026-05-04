<?php
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');

$url = $_GET['url'] ?? '';
if (!$url) {
    http_response_code(400);
    echo json_encode(['error' => 'Missing url parameter']);
    exit;
}

// Проверяем, что URL начинается с http:// или https://
if (!preg_match('/^https?:\/\//', $url)) {
    http_response_code(400);
    echo json_encode(['error' => 'Invalid URL']);
    exit;
}

$ch = curl_init($url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false); // для тестов, можно true в проде
curl_setopt($ch, CURLOPT_TIMEOUT, 10);
$response = curl_exec($ch);
$httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
$curlError = curl_error($ch);
curl_close($ch);

if ($curlError) {
    http_response_code(500);
    echo json_encode(['error' => 'CURL error: ' . $curlError]);
} else {
    http_response_code($httpCode);
    echo $response;
}
?>
