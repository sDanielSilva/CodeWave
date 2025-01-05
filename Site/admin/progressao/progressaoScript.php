<?php
require_once 'db_config.php';

$progressoes_por_pagina = 7;
$pagina_atual = isset($_GET['pagina']) ? (int)$_GET['pagina'] : 1;
$primeira_progressao = ($pagina_atual - 1) * $progressoes_por_pagina;

try {
    $query = "SELECT 
                p.*,
                f.nome,
                f.img,
                c.descricao
            FROM 
                public.progressao p
            JOIN 
                public.funcionario f ON p.id_funcionario = f.id_funcionario
            JOIN 
                public.cargo c ON p.id_cargo = c.id_cargo
            LIMIT ? OFFSET ?";
    $stmt = $db->prepare($query);
    $stmt->bindValue(1, $progressoes_por_pagina, PDO::PARAM_INT);
    $stmt->bindValue(2, $primeira_progressao, PDO::PARAM_INT);
    $stmt->execute();

    $progressoes = array();
    if ($stmt->rowCount() > 0) {
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $progressoes[] = array(
                'nome' => htmlspecialchars($row['nome']),
                'img' => htmlspecialchars($row['img']),
                'descricao' => htmlspecialchars($row['descricao']),
                'local' => htmlspecialchars($row['local']),
                'idade' => htmlspecialchars($row['idade']),
                'ano_inicio' => htmlspecialchars($row['ano_inicio']),
                'ano_fim' => htmlspecialchars($row['ano_fim']),
                'salario' => number_format($row['salario'], 2, ',', '.')
            );
        }
    }

    // Conta o total de progressoes
    $query = "SELECT COUNT(*) AS total FROM public.progressao";
    $stmt = $db->prepare($query);
    $stmt->execute();
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    $total_progressoes = $row['total'];

    // Retorna os dados como JSON
    header('Content-Type: application/json');
    echo json_encode(array(
        'progressoes' => $progressoes,
        'total' => $total_progressoes
    ));
} catch (PDOException $e) {
    die("Erro na consulta a base de dados: " . $e->getMessage());
}
?>
