<?php
require __DIR__ . '/../vendor/autoload.php';
$pdo = new PDO('mysql:host=127.0.0.1;dbname=nox;port=3306','root','');

$products = [
    ['name' => 'Phone Case', 'price' => 19.99, 'description' => 'Protective phone case'],
    ['name' => 'Screen Protector', 'price' => 9.99, 'description' => 'Tempered glass screen protector'],
    ['name' => 'Wireless Charger', 'price' => 29.99, 'description' => 'Fast wireless charger pad'],
    ['name' => 'Phone Stand', 'price' => 14.99, 'description' => 'Adjustable phone stand'],
    ['name' => 'Bluetooth Headset', 'price' => 39.99, 'description' => 'Noise-cancelling headset'],
];

$insert = $pdo->prepare("INSERT INTO products (name, slug, description, price, created_at, updated_at) VALUES (:name, :slug, :description, :price, :created_at, :updated_at)");
$now = date('Y-m-d H:i:s');
$rows = 0;
foreach ($products as $p) {
    $slug = strtolower(preg_replace('/[^a-z0-9]+/i', '-', trim($p['name']))).'-'.substr(md5(uniqid('', true)), 0, 6);
    $insert->execute([
        'name' => $p['name'],
        'slug' => $slug,
        'description' => $p['description'],
        'price' => $p['price'],
        'created_at' => $now,
        'updated_at' => $now,
    ]);
    $rows += $insert->rowCount();
}

echo "Inserted rows: {$rows}\n";
