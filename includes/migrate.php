<?php
require_once __DIR__ . '/db.php';

function runMigrations(PDO $pdo) { 
    $pdo->exec("CREATE TABLE IF NOT EXISTS migrations (
        id SERIAL PRIMARY KEY,
        migration_file VARCHAR(255) UNIQUE NOT NULL,
        applied_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
    )");
 
    $stmt = $pdo->query("SELECT migration_file FROM migrations");
    $applied = $stmt->fetchAll(PDO::FETCH_COLUMN);
 
    $files = glob(__DIR__ . '/../migrations/*.sql');
    sort($files);

    foreach ($files as $file) {
        $fileName = basename($file);
        if (!in_array($fileName, $applied)) {
            echo "Применяется миграция: $fileName ... ";
            $sql = file_get_contents($file);
            try {
                $pdo->exec($sql);
                $stmt = $pdo->prepare("INSERT INTO migrations (migration_file) VALUES (?)");
                $stmt->execute([$fileName]);
                echo "OK\n";
            } catch (PDOException $e) {
                echo "Ошибка: " . $e->getMessage() . "\n";
                return false;
            }
        }
    }
    return true;
}

if (php_sapi_name() === 'cli') {
    $pdo = getDbConnection();
    runMigrations($pdo);
}
?>
