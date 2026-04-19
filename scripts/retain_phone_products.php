<?php
require __DIR__ . '/../vendor/autoload.php';
$pdo = new PDO('mysql:host=127.0.0.1;dbname=nox;port=3306','root','');

$keep = [
    'Phone Case',
    'Screen Protector',
    'Wireless Charger',
    'Phone Stand',
    'Bluetooth Headset',
];

// Build placeholders for the IN clause
$placeholders = implode(',', array_fill(0, count($keep), '?'));
$sql = "DELETE FROM products WHERE name NOT IN ($placeholders)";
$stmt = $pdo->prepare($sql);
$stmt->execute($keep);

echo "Deleted rows: " . $stmt->rowCount() . PHP_EOL;
