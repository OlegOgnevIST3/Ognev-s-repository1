<?php
session_start();
require 'vendor/autoload.php';
require 'db.php'; // Подключение к БД

// Проверка авторизации
if (isset($_SESSION['user'])) {
    // Пользователь авторизован, применяем настройки из cookies
    $bg_color = $_COOKIE['bg_color'] ?? '#ffffff'; // Если cookie нет, задаем значение по умолчанию
    $font_color = $_COOKIE['font_color'] ?? '#000000';

    echo "<style>body { background-color: $bg_color; color: $font_color; }</style>";
    echo "Добро пожаловать, {$_SESSION['user']}!";
    echo '<br><a href="auth.php?logout=true">Выйти</a>';
} elseif (isset($_COOKIE['bg_color']) && isset($_COOKIE['font_color'])) {
    // Автоматическая авторизация (если cookies присутствуют)
    $_SESSION['user'] = 'Гость'; // Или можно загрузить имя пользователя, если оно сохраняется в cookies
    $bg_color = $_COOKIE['bg_color'];
    $font_color = $_COOKIE['font_color'];

    echo "<style>body { background-color: $bg_color; color: $font_color; }</style>";
    echo "Добро пожаловать! Вы авторизованы автоматически.";
    echo '<br><a href="auth.php?logout=true">Выйти</a>';
} else {
    // Пользователь не авторизован, перенаправляем на страницу логина
    header('Location: login.php');
    exit;
}

// Подключение к базе данных (для примера, оставляем ваш код)
try {
    $dsn = 'mysql:host=localhost;dbname=database1;charset=utf8';
    $username = 'your_username';
    $password = 'your_password';

    $pdo = new PDO($dsn, $username, $password, [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    ]);

    echo "<br>Подключение к базе данных успешно установлено.";
} catch (PDOException $e) {
    // Вывод ошибки, если база данных не найдена или подключение не удалось
    die("Ошибка подключения к базе данных: " . $e->getMessage());
}
?>
