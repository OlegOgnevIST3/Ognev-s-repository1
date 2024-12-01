<?php
try {
    $db = new PDO('mysql:host=localhost;dbname=database1', 'root', 'Popkorn11');
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Ошибка подключения: " . $e->getMessage());
}
?>
