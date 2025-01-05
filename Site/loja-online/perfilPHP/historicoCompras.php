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

// Primeiro, recuperamos todas as compras do utilizador
$query_all = "
    SELECT c.id_compra, c.morada_entrega, cd.data_hora, cd.quantidade, cd.preco_total, p.nome AS nome_produto
    FROM public.utilizador u
    INNER JOIN public.compra c ON u.id_utilizador = c.id_utilizador
    INNER JOIN public.compra_detalhe cd ON c.id_compra = cd.id_compra
    INNER JOIN public.produto p ON cd.id_produto = p.id_produto
    WHERE u.id_utilizador = :id_utilizador
    ORDER BY c.id_compra DESC
";

try {
    $statement_all = $pdo->prepare($query_all);
    $statement_all->bindParam(':id_utilizador', $id_utilizador, PDO::PARAM_INT);
    $statement_all->execute();
    $result_all = $statement_all->fetchAll(PDO::FETCH_ASSOC);

    // Agrupamos os resultados por id_compra
    $compras = [];
    foreach ($result_all as $row) {
        $id_compra = $row['id_compra'];
        if (!isset($compras[$id_compra])) {
            $compras[$id_compra] = [
                'id_compra' => $id_compra,
                'morada_entrega' => $row['morada_entrega'] ?? 'Aluguer',
                'data_hora' => $row['data_hora'],
                'produtos' => []
            ];
        }
        $compras[$id_compra]['produtos'][] = [
            'nome_produto' => $row['nome_produto'],
            'quantidade' => $row['quantidade'],
            'preco_total' => $row['preco_total']
        ];
    }

    // Convertemos as compras para um array indexado
    $compras_indexed = array_values($compras);
    $total_compras = count($compras_indexed);
    $total_paginas = ceil($total_compras / $itens_por_pagina);

    // Aplicamos a paginação
    $compras_paginadas = array_slice($compras_indexed, $offset, $itens_por_pagina);

    header('Content-Type: application/json');
    if ($compras_paginadas) {
        echo json_encode(['compras' => $compras_paginadas, 'total_paginas' => $total_paginas]);
    } else {
        echo json_encode(['compras' => [], 'total_paginas' => 0]);
    }
} catch (PDOException $e) {
    die("Erro ao procurar utilizador: " . $e->getMessage());
}

$pdo = null;
?>
