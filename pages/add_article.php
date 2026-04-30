<?php
include __DIR__ . '/../includes/header.php';
require_once __DIR__ . '/../includes/db.php';

$message = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = trim($_POST['title'] ?? '');
    $content = trim($_POST['content'] ?? '');
    if ($title && $content) {
        try {
            $pdo = getDbConnection();
            $stmt = $pdo->prepare("INSERT INTO articles (title, content) VALUES (?, ?)");
            if ($stmt->execute([$title, $content])) {
                $message = '<p style="color:green;">Статья добавлена!</p>';
            } else {
                $message = '<p style="color:red;">Ошибка добавления.</p>';
            }
        } catch (PDOException $e) {
            $message = '<p style="color:red;">Ошибка БД: ' . htmlspecialchars($e->getMessage()) . '</p>';
        }
    } else {
        $message = '<p style="color:red;">Заполните все поля.</p>';
    }
}
?>
<main>
    <h1>Добавить статью</h1>
    <?= $message ?>
    <form method="post">
        <input type="text" name="title" placeholder="Заголовок" required>
        <textarea name="content" placeholder="Текст статьи" rows="10" required></textarea>
        <button type="submit">Сохранить</button>
    </form>
    <p><a href="/articles.php">← К списку статей</a></p>
</main>
<?php include __DIR__ . '/../includes/footer.php'; ?>
