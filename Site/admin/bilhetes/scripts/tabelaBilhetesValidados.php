<?php

$host = getenv('DB_HOST');
$dbname = getenv('DB_NAME');
$username = getenv('DB_USERNAME');
$password = getenv('DB_PASSWORD');
$port = getenv('DB_PORT');

header('Content-Type: application/json');

try {
    $conn = new PDO("pgsql:host=$host;port=$port;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo json_encode(['error' => 'Erro de conexão: ' . $e->getMessage()]);
    exit;
}

// Consulta SQL para procurar bilhetes validados
$sql = "SELECT bilhete.data_fim, bilhete.tipo, bilhete.codigo, bilhete.preco, funcionario.nome
        FROM public.bilhete
        INNER JOIN public.funcionario ON bilhete.id_funcionario = funcionario.id_funcionario
        WHERE bilhete.status = true";

try {
    // Prepara e executa a consulta
    $stmt = $conn->prepare($sql);
    $stmt->execute();

    // Fetch all rows into an array
    $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Output the rows as JSON
    echo json_encode($rows);
} catch (PDOException $e) {
    echo json_encode(['error' => 'Erro na consulta: ' . $e->getMessage()]);
}
