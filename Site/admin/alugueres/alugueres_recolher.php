<?php
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
$filter = isset($data['filter']) ? $data['filter'] : 'all';



// Para alugueres por recolher
$sql = "SELECT utilizador.nome as utilizador, 
               CASE WHEN produto.id_categoria = 8 THEN 'Aluguer' WHEN produto.id_categoria = 12 THEN 'Alojamento' END as tipo, 
               produto.nome as produto, 
               aluguer.hora_inicio, 
               aluguer.id_aluguer,
               aluguer.hora_fim 
        FROM aluguer 
        JOIN compra ON aluguer.id_compra = compra.id_compra 
        JOIN utilizador ON compra.id_utilizador = utilizador.id_utilizador 
        JOIN produto ON aluguer.id_produto = produto.id_produto
        WHERE aluguer.status = false";

if ($filter == 'today') {
    $sql .= " AND DATE(aluguer.hora_inicio) = CURRENT_DATE";
} elseif ($filter == 'thisMonth') {
    $sql .= " AND EXTRACT(MONTH FROM aluguer.hora_inicio) = EXTRACT(MONTH FROM CURRENT_DATE)";
}
$stmt = $pdo->query($sql);
$data = [];
while ($row = $stmt->fetch()) {
    $data[] = $row;
}
echo json_encode($data);