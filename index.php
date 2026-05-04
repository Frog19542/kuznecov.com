<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Главная - Мой сайт</title>
    <link rel="stylesheet" href="/assets/css/style.css">
    <link rel="icon" href="/favicon.ico" type="image/x-icon">
</head>
<body>
    <?php include __DIR__ . '/includes/header.php'; ?>
    <main>
        <h1>Добро пожаловать!</h1>
        <p>Это главная страница сайта.</p>
        <!-- Добавим картинку фото -->
        <img src="/foto.png" alt="Фото" style="max-width: 100%; height: auto; margin-top: 20px;">
    </main>
    <?php include __DIR__ . '/includes/footer.php'; ?>
</body>
</html>
