<?php
$host = getenv('DB_HOST');
$port = getenv('DB_PORT');
$db   = getenv('DB_NAME');
$user = getenv('DB_USER');
$pass = getenv('DB_PASS');
$charset = 'utf8mb4';

$dsn = "pgsql:host=$host;port=$port;dbname=$db";
$opt = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES   => false,
];
$pdo = new PDO($dsn, $user, $pass, $opt);

$sql = "SELECT * FROM produto WHERE id_categoria = 12";
$stmt = $pdo->prepare($sql);
$stmt->execute();
$products = $stmt->fetchAll();
$products = array_filter($products, function ($product) {
    return isset($product['id_produto']);
});

error_log(print_r($products, true));

header('Content-Type: application/json');
echo json_encode($products);

