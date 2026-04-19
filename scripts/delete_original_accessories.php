<?php
require __DIR__ . '/../vendor/autoload.php';
$pdo = new PDO('mysql:host=127.0.0.1;dbname=nox;port=3306','root','');
$stmt = $pdo->prepare("DELETE FROM products WHERE name = :name AND price = :price");
$stmt->execute(['name' => 'Accessories', 'price' => 49.99]);
echo "Deleted rows: " . $stmt->rowCount() . PHP_EOL;
