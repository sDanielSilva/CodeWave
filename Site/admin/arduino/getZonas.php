<?php
header('Content-Type: application/json');

$host = getenv('DB_HOST');
$dbname = getenv('DB_NAME');
$username = getenv('DB_USERNAME');
$password = getenv('DB_PASSWORD');
$port = getenv('DB_PORT');

$id = $_GET['id'] ?? null;

if ($id === null) {
    echo json_encode(['error' => 'ID não fornecido']);
    exit;
}

try {
    
    $conn = new PDO("pgsql:host=$host;port=$port;dbname=$dbname", $username, $password);


    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Executa a consulta SQL
    $stmt = $conn->prepare("SELECT nome FROM zona WHERE id_zona = :id");
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);
    $stmt->execute();

    // Procura o resultado
    $result = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($result) {
        echo json_encode($result);
    } else {
        echo json_encode(['error' => 'Zona não encontrada']);
    }
} catch(PDOException $e) {
    echo json_encode(['error' => 'Erro: ' . $e->getMessage()]);
}

// Fecha a conexão
$conn = null;
?>
