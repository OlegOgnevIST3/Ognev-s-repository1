<?php
require 'vendor/autoload.php';

// Подключение к базе данных
try {
    $dsn = 'mysql:host=localhost;dbname=database1;charset=utf8';
    $username = 'your_username';
    $password = 'your_password';

    $pdo = new PDO($dsn, $username, $password, [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    ]);

    echo "Подключение к базе данных успешно установлено.";
} catch (PDOException $e) {
    // Вывод ошибки, если база данных не найдена или подключение не удалось
    die("Ошибка подключения к базе данных: " . $e->getMessage());
}
?>