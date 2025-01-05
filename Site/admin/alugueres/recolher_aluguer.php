<?php
session_start();

$host = getenv('DB_HOST');
$dbname = getenv('DB_NAME');
$username = getenv('DB_USERNAME');
$password = getenv('DB_PASSWORD');
$port = getenv('DB_PORT');

$dsn = "pgsql:host=$host;port=$port;dbname=$dbname";
$opt = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES   => false,
];
$pdo = new PDO($dsn, $username, $password, $opt);

$data = json_decode(file_get_contents('php://input'), true);
$id_aluguer = $data['id_aluguer'];
$id_funcionario = $data['id_funcionario'];
$verificationCode = $data['verificationCode'];
error_log('verificationCode: ' . $verificationCode);
error_log('id_aluguer: ' . $id_aluguer);
error_log('id_funcionario: ' . $id_funcionario);

$sql = "UPDATE Aluguer SET status = true, recolha = date_trunc('second', NOW()), id_funcionario = :id_funcionario WHERE id_aluguer = :id_aluguer";


if ($verificationCode !== "" && $verificationCode != $_SESSION['verification_code']) {
    echo json_encode(['status' => 'error', 'message' => 'Código de verificação incorreto']);
    exit();
}

$stmt = $pdo->prepare($sql);
$stmt->execute(['id_aluguer' => $id_aluguer, 'id_funcionario' => $id_funcionario]);

echo json_encode(['status' => 'success']);
