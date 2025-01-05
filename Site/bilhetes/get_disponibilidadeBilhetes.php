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

if (!isset($_POST['id_produto'], $_POST['data_inicio'])) {
    error_log('Missing POST data');
    echo json_encode(['error' => 'Missing data']);
    exit;
}

$id_produto = $_POST['id_produto'];
$data_inicio = $_POST['data_inicio'];

// Get total number of tickets (bilhetes) issued for the product on the specified start date
$sql = "SELECT count(*) as total_bilhetes FROM public.bilhete WHERE id_produto = :id_produto AND data_inicio = :data_inicio";
$stmt = $pdo->prepare($sql);
$stmt->execute(['id_produto' => $id_produto, 'data_inicio' => $data_inicio]);
$total_bilhetes = $stmt->fetchColumn();

// Get the capacity of the product
$sql = "SELECT capacidade FROM Produto WHERE id_produto = :id_produto";
$stmt = $pdo->prepare($sql);
$stmt->execute(['id_produto' => $id_produto]);
$capacidade = $stmt->fetchColumn();

// Calculate availability
$disponibilidade = $capacidade - $total_bilhetes;

header('Content-Type: application/json');
$json = json_encode(['disponibilidade' => $disponibilidade]);
error_log($json);
echo $json;
?>