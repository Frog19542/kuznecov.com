<?php
require_once 'config.php';
if (!isset($_GET['country'])) {
    http_response_code(400);
    echo json_encode(['error' => 'Missing country parameter']);
    exit;
}
$country = $_GET['country'];
$stmt = $pdo->prepare("SELECT cities.name FROM cities JOIN countries ON cities.country_id = countries.id WHERE countries.name = ?");
$stmt->execute([$country]);
$cities = $stmt->fetchAll(PDO::FETCH_COLUMN);
echo json_encode(['country' => $country, 'cities' => $cities]);
