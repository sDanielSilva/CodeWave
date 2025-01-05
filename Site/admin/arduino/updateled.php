<?php
$host = getenv('DB_HOST');
$dbname = getenv('DB_NAME');
$username = getenv('DB_USERNAME');
$password = getenv('DB_PASSWORD');
$port = getenv('DB_PORT');

// Verifica se os dados foram recebidos corretamente
$data = json_decode(file_get_contents("php://input"), true);

if (isset($data['ledId']) && isset($data['newState'])) {
    $ledId = $data['ledId'];
    $newState = $data['newState'] ? 'ON' : 'OFF';

    try {
        $db = new PDO("pgsql:host=$host;port=$port;dbname=$dbname", $username, $password);
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Atualiza o estado da luz na base de dados
        $stmt = $db->prepare("UPDATE luzes SET status = :newState WHERE id_luz = :ledId");
        $stmt->bindParam(':newState', $newState);
        $stmt->bindParam(':ledId', $ledId);
        $stmt->execute();

        // Responde ao cliente com sucesso
        header('Content-Type: application/json');
        echo json_encode(["success" => true]);

    } catch (PDOException $e) {
        // Responde ao cliente com erro
        header('Content-Type: application/json', true, 500);
        echo json_encode(["error" => "Erro na conexão com a base de dados: " . $e->getMessage()]);
    }
} else {
    // Responde ao cliente com erro se os dados estiverem a faltar
    header('Content-Type: application/json', true, 400);
    echo json_encode(["error" => "Dados incompletos ou inválidos recebidos."]);
}
?>
