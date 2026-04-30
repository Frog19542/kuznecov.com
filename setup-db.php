<?php
if (php_sapi_name() !== 'cli' && $_SERVER['REMOTE_ADDR'] !== '127.0.0.1') {
    die("Доступ запрещён");
}
require_once 'includes/migrate.php';
$pdo = getDbConnection();
if (runMigrations($pdo)) {
    echo "Все миграции применены успешно.";
} else {
    echo "Ошибка при применении миграций.";
}
