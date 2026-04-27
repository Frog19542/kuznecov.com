<?php
include __DIR__ . '/../includes/header.php';
?>

<main>
    <h1>Контакты</h1>
    <form method="post" action="">
        <input type="text" name="name" placeholder="Имя" required>
        <input type="email" name="email" placeholder="Email" required>
        <textarea name="message" placeholder="Сообщение" required></textarea>
        <button type="submit">Отправить</button>
    </form>

    <?php
    	if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $name = trim($_POST['name'] ?? '');
        $email = trim($_POST['email'] ?? '');
        $message = trim($_POST['message'] ?? '');
        if ($name && $email && $message) {
            $entry = date('Y-m-d H:i:s') . " | $name | $email | $message" . PHP_EOL;
            file_put_contents(__DIR__ . '/../messages.txt', $entry, FILE_APPEND);
            echo '<p style="color: green;">Сообщение отправлено. Спасибо!</p>';
        } else {
            echo '<p style="color: red;">Заполните все поля.</p>';
        }
    }
    ?>
</main>

<?php
include __DIR__ . '/../includes/footer.php';
?>

