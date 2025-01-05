<?php
require_once "db_config.php";

$produtos_por_pagina = 7;
$pagina_atual = isset($_GET['pagina']) ? (int)$_GET['pagina'] : 1;
$primeiro_produto = ($pagina_atual - 1) * $produtos_por_pagina;

try {
    // Consulta para obter os produtos da página atual
    $query = "SELECT p.id_produto, p.nome, p.preco, p.capacidade, p.iva, c.id_categoria, c.nome AS nome_categoria, p.imagem
    FROM produto p
    INNER JOIN categoria c ON p.id_categoria = c.id_categoria
    ORDER BY id_produto ASC LIMIT :limite OFFSET :offset";
    $stmt = $db->prepare($query);
    $stmt->bindParam(':limite', $produtos_por_pagina, PDO::PARAM_INT);
    $stmt->bindParam(':offset', $primeiro_produto, PDO::PARAM_INT);
    $stmt->execute();

    $produtos = array(); // Array para armazenar os produtos

    if ($stmt->rowCount() > 0) {
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            // Adiciona os dados do produto ao array de produtos
            $produtos[] = array(
                'id_produto' => $row['id_produto'],
                'nome' => $row['nome'],
                'preco' => $row['preco'],
                'capacidade' => $row['capacidade'],
                'iva' => $row['iva'],
                'id_categoria' => $row['id_categoria'],
                'nome_categoria' => $row['nome_categoria'],
                'imagem' => $row['imagem']
            );
        }
    }

    // Consulta para contar o número total de produtos
    $count_query = "SELECT COUNT(*) AS total FROM produto";
    $count_stmt = $db->query($count_query);
    $total_produtos = $count_stmt->fetch(PDO::FETCH_ASSOC)['total'];

    // Retorna os dados como JSON, incluindo o número total de produtos
    header('Content-Type: application/json');
    echo json_encode(array(
        'produtos' => $produtos,
        'total' => $total_produtos // Total de produtos encontrados
    ));
} catch (PDOException $e) {
    // Em caso de erro, retorna uma mensagem de erro em JSON
    echo json_encode(array(
        'error' => 'Erro na consulta a base de dados: ' . $e->getMessage()
    ));
}
?>
