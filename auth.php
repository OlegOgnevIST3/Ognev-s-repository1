<?php
session_start();
include 'db.php'; // БД

// Регистрация
if (isset($_POST['register'])) {
    $username = $_POST['username'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT); // Шифрование пароля
    $bg_color = $_POST['bg_color'];
    $font_color = $_POST['font_color'];

    $stmt = $db->prepare("INSERT INTO users (username, password, bg_color, font_color) VALUES (?, ?, ?, ?)");
    if ($stmt->execute([$username, $password, $bg_color, $font_color])) {
        echo "Регистрация успешна!";
    } else {
        echo "Ошибка при регистрации!";
    }
}

// Авторизация
if (isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $stmt = $db->prepare("SELECT * FROM users WHERE username = ?");
    $stmt->execute([$username]);
    $user = $stmt->fetch();

    if ($user && password_verify($password, $user['password'])) {
        // Сохранение параметров в cookies
        setcookie('bg_color', $user['bg_color'], time() + 3600, '/');
        setcookie('font_color', $user['font_color'], time() + 3600, '/');
        $_SESSION['user'] = $user['username'];
        echo "Добро пожаловать, $username!";
    } else {
        echo "Неверные данные!";
    }
}

// Разлогин
if (isset($_GET['logout'])) {
    session_destroy();
    setcookie('bg_color', '', time() - 3600, '/');
    setcookie('font_color', '', time() - 3600, '/');
    header('Location: login.php');
    exit;
}
?>
