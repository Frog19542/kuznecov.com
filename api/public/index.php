<?php
require_once 'config.php';

$action = $_GET['action'] ?? '';

switch ($action) {
    case 'all':
        $stmt = $pdo->query("SELECT * FROM cities");
        echo json_encode($stmt->fetchAll());
        break;

    case 'get':
        $id = $_GET['id'] ?? 0;
        $stmt = $pdo->prepare("SELECT * FROM cities WHERE id = ?");
        $stmt->execute([$id]);
        $city = $stmt->fetch();
        if ($city) echo json_encode($city);
        else { http_response_code(404); echo json_encode(['error' => 'Not found']); }
        break;

    case 'del':
        $id = $_GET['id'] ?? 0;
        $stmt = $pdo->prepare("DELETE FROM cities WHERE id = ?");
        $stmt->execute([$id]);
        echo json_encode(['deleted' => $stmt->rowCount()]);
        break;

    case 'edit':
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            http_response_code(405);
            echo json_encode(['error' => 'Method not allowed']);
            break;
        }
        $id = $_GET['id'] ?? 0;
        $input = json_decode(file_get_contents('php://input'), true);
        $name = $input['name'] ?? '';
        $country_id = $input['country_id'] ?? 0;
        $stmt = $pdo->prepare("UPDATE cities SET name = ?, country_id = ? WHERE id = ?");
        $stmt->execute([$name, $country_id, $id]);
        echo json_encode(['updated' => $stmt->rowCount()]);
        break;

    default:
        http_response_code(400);
        echo json_encode(['error' => 'Invalid action']);
}
