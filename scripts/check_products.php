<?php
require __DIR__ . '/../vendor/autoload.php';
$pdo = new PDO('mysql:host=127.0.0.1;dbname=nox;port=3306','root','');
$stmt = $pdo->query('SELECT name,price FROM products ORDER BY id DESC LIMIT 5');
$rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
foreach ($rows as $r) {
    echo $r['name'] . ' - ' . $r['price'] . PHP_EOL;
}
