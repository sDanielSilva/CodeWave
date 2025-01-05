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

if (!isset($_POST['id_produto'], $_POST['data_inicio'], $_POST['data_fim'])) {
    error_log('Missing POST data');
    echo json_encode(['error' => 'Missing data']);
    exit;
}

$id_produto = $_POST['id_produto'];
$data_inicio = $_POST['data_inicio'];
$data_fim = $_POST['data_fim'];

$sql = "SELECT SUM(quantidade) as total_alugueres FROM Aluguer WHERE id_produto = :id_produto AND (DATE(hora_inicio) BETWEEN DATE(:data_inicio) AND DATE(:data_fim) OR DATE(hora_fim) BETWEEN DATE(:data_inicio) AND DATE(:data_fim) OR DATE(:data_inicio) BETWEEN DATE(hora_inicio) AND DATE(hora_fim) OR DATE(:data_fim) BETWEEN DATE(hora_inicio) AND DATE(hora_fim))";

$stmt = $pdo->prepare($sql);
$stmt->execute(['id_produto' => $id_produto, 'data_inicio' => $data_inicio, 'data_fim' => $data_fim]);
$total_alugueres = $stmt->fetchColumn();

$sql = "SELECT capacidade FROM Produto WHERE id_produto = :id_produto";
$stmt = $pdo->prepare($sql);
$stmt->execute(['id_produto' => $id_produto]);
$capacidade = $stmt->fetchColumn();

$disponibilidade = $capacidade - $total_alugueres;

header('Content-Type: application/json');
$json = json_encode(['disponibilidade' => $disponibilidade]);
error_log($json);
echo $json;
