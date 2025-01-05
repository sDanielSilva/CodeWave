<?php
require_once 'db_config.php';

$consumivel_por_pagina = 7;
$pagina_atual = isset($_GET['pagina']) ? (int)$_GET['pagina'] : 1;
$primeiro_consumivel = ($pagina_atual - 1) * $consumivel_por_pagina;

try {
    // Consulta para procurar todos os produtos com as informações de categoria, filtrando por id_categoria 10, 13, ou 14
    $query = "SELECT p.id_produto, p.nome, p.preco, p.capacidade, p.iva, c.nome AS nome_categoria, p.imagem 
              FROM produto p 
              INNER JOIN categoria c ON p.id_categoria = c.id_categoria 
              WHERE p.id_categoria IN (10, 13, 14)
              ORDER BY p.id_produto ASC
              LIMIT :limite OFFSET :offset";
    $stmt = $db->prepare($query);
    $stmt->bindParam(':limite', $consumivel_por_pagina, PDO::PARAM_INT);
    $stmt->bindParam(':offset', $primeiro_consumivel, PDO::PARAM_INT);
    $stmt->execute();

    $produtos = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Conta o total de consumíveis
    $query_count = "SELECT COUNT(*) AS total FROM produto WHERE id_categoria IN (10, 13, 14)";
    $stmt_count = $db->prepare($query_count);
    $stmt_count->execute();
    $row_count = $stmt_count->fetch(PDO::FETCH_ASSOC);
    $total_consumiveis = $row_count['total'];

    // Retorna os dados como JSON
    header('Content-Type: application/json');
    echo json_encode(array(
        'produtos' => $produtos,
        'total' => $total_consumiveis
    ));
} catch (PDOException $e) {
    die("Erro na consulta a base de dados: " . $e->getMessage());
}
?>
