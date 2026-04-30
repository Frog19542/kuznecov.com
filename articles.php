<?php
include __DIR__ . '/includes/header.php';
require_once __DIR__ . '/includes/db.php';

$pdo = getDbConnection();
$page = isset($_GET['page']) ? max(1, (int)$_GET['page']) : 1;
$limit = 5;
$offset = ($page - 1) * $limit;


$totalStmt = $pdo->query("SELECT COUNT(*) FROM articles");
$total = $totalStmt->fetchColumn();
$totalPages = ceil($total / $limit);

$stmt = $pdo->prepare("SELECT id, title, created_at FROM articles ORDER BY created_at DESC LIMIT ? OFFSET ?");
$stmt->execute([$limit, $offset]);
$articles = $stmt->fetchAll();
?>
<main>
    <h1>Статьи</h1>
    <p><a href="/pages/add_article.php">➕ Добавить новую статью</a></p>
    <?php if (count($articles) === 0): ?>
        <p>Пока нет статей. Создайте первую!</p>
    <?php else: ?>
        <?php foreach ($articles as $article): ?>
            <div style="border-bottom:1px solid #ccc; margin-bottom:1rem;">
                <h2><?= htmlspecialchars($article['title']) ?></h2>
                <small><?= $article['created_at'] ?></small>
                <p><a href="/pages/article.php?id=<?= $article['id'] ?>">Читать далее →</a></p>
            </div>
        <?php endforeach; ?>


        <div class="pagination">
            <?php for ($i = 1; $i <= $totalPages; $i++): ?>
                <a href="?page=<?= $i ?>" <?= $i == $page ? 'class="active"' : '' ?>><?= $i ?></a>
            <?php endfor; ?>
        </div>
    <?php endif; ?>
</main>
<?php include __DIR__ . '/includes/footer.php'; ?>
