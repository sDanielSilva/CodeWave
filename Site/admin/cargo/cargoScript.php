<?php
require_once 'db_config.php';

$cargos_por_pagina = 7;
$pagina_atual = isset($_GET['pagina']) ? (int)$_GET['pagina'] : 1;
$primeiro_cargo = ($pagina_atual - 1) * $cargos_por_pagina;

try {
    $query = "SELECT id_cargo, descricao FROM cargo ORDER BY id_cargo ASC LIMIT ? OFFSET ?";
    $stmt = $db->prepare($query);
    $stmt->bindValue(1, $cargos_por_pagina, PDO::PARAM_INT);
    $stmt->bindValue(2, $primeiro_cargo, PDO::PARAM_INT);
    $stmt->execute();

    $cargos = array();
    if ($stmt->rowCount() > 0) {
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $cargos[] = array(
                'id_cargo' => htmlspecialchars($row['id_cargo']),
                'descricao' => htmlspecialchars($row['descricao'])
            );
        }
    }

    // Conta o total de cargos
    $query = "SELECT COUNT(*) AS total FROM cargo";
    $stmt = $db->prepare($query);
    $stmt->execute();
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    $total_cargos = $row['total'];

    // Retorna os dados como JSON
    header('Content-Type: application/json');
    echo json_encode(array(
        'cargos' => $cargos,
        'total' => $total_cargos
    ));
} catch (PDOException $e) {
    die("Erro na consulta a base de dados: " . $e->getMessage());
}
