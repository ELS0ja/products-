<?php
require __DIR__ . '/../vendor/autoload.php';
$pdo = new PDO('mysql:host=127.0.0.1;dbname=nox;port=3306','root','');
$stmt = $pdo->prepare("SELECT name,price FROM products WHERE name LIKE :q ORDER BY id DESC");
$stmt->execute(['q' => '%Accessories%']);
$rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
if (empty($rows)) {
    echo "No products found matching 'Accessories'.\n";
} else {
    foreach ($rows as $r) {
        echo $r['name'] . ' - ' . $r['price'] . PHP_EOL;
    }
}
