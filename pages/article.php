<?php
include __DIR__ . '/../includes/header.php';
require_once __DIR__ . '/../includes/db.php';

$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;
if (!$id) {
    echo "<main><p>Не указан id статьи.</p></main>";
    include __DIR__ . '/../includes/footer.php';
    exit;
}

$pdo = getDbConnection();
$stmt = $pdo->prepare("SELECT title, content, created_at FROM articles WHERE id = ?");
$stmt->execute([$id]);
$article = $stmt->fetch();

if (!$article) {
    echo "<main><p>Статья не найдена.</p></main>";
} else {
    ?>
    <main>
        <h1><?= htmlspecialchars($article['title']) ?></h1>
        <small>Опубликовано: <?= $article['created_at'] ?></small>
        <div style="margin-top:1rem;"><?= nl2br(htmlspecialchars($article['content'])) ?></div>
        <p><a href="/articles.php">← Назад к списку</a></p>
    </main>
    <?php
}
include __DIR__ . '/../includes/footer.php';
?>
