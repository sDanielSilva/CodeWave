<?php

// Conexão com a base de dados PostgreSQL
$host = getenv('DB_HOST');
$port = getenv('DB_PORT');
$dbname = getenv('DB_NAME');
$username = getenv('DB_USERNAME');
$password = getenv('DB_PASSWORD');

try {
    $pdo = new PDO("pgsql:host=$host;port=$port;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Erro na conexão com a base de dados: " . $e->getMessage());
}

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION['user_id']) || empty($_SESSION['user_id'])) {
    die("Id não encontrado na sessão.");
}

$id_utilizador = $_SESSION['user_id'];

$pagina = isset($_GET['pagina']) ? (int)$_GET['pagina'] : 1;
$itens_por_pagina = isset($_GET['itens_por_pagina']) ? (int)$_GET['itens_por_pagina'] : 10;
$offset = ($pagina - 1) * $itens_por_pagina;

$query_bilhetes = "
    SELECT id_bilhete, data_inicio, data_fim, tipo, codigo, status, preco, data_compra
    FROM public.bilhete
    WHERE id_utilizador = :id_utilizador
    ORDER BY status ASC, data_compra DESC
    LIMIT :itens_por_pagina OFFSET :offset
";

$query_count = "
    SELECT COUNT(*)
    FROM public.bilhete
    WHERE id_utilizador = :id_utilizador
";

try {
    // Fetching tickets
    $statement_bilhetes = $pdo->prepare($query_bilhetes);
    $statement_bilhetes->bindParam(':id_utilizador', $id_utilizador, PDO::PARAM_INT);
    $statement_bilhetes->bindParam(':itens_por_pagina', $itens_por_pagina, PDO::PARAM_INT);
    $statement_bilhetes->bindParam(':offset', $offset, PDO::PARAM_INT);
    $statement_bilhetes->execute();
    $bilhetes = $statement_bilhetes->fetchAll(PDO::FETCH_ASSOC);

    // Counting total tickets
    $statement_count = $pdo->prepare($query_count);
    $statement_count->bindParam(':id_utilizador', $id_utilizador, PDO::PARAM_INT);
    $statement_count->execute();
    $total_bilhetes = $statement_count->fetchColumn();

    $total_paginas = ceil($total_bilhetes / $itens_por_pagina);

    header('Content-Type: application/json');
    echo json_encode(['bilhetes' => $bilhetes, 'total_paginas' => $total_paginas]);

} catch (PDOException $e) {
    die("Erro ao procurar dados: " . $e->getMessage());
}

$pdo = null;
?>
