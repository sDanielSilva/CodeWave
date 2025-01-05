<?php
require_once 'db_config.php';

$zonas_por_pagina = 7;
$pagina_atual = isset($_GET['pagina']) ? (int)$_GET['pagina'] : 1;
$primeira_zona = ($pagina_atual - 1) * $zonas_por_pagina;

try {
    $query = "SELECT id_zona, nome FROM zona ORDER BY id_zona ASC LIMIT ? OFFSET ?";
    $stmt = $db->prepare($query);
    $stmt->bindValue(1, $zonas_por_pagina, PDO::PARAM_INT);
    $stmt->bindValue(2, $primeira_zona, PDO::PARAM_INT);
    $stmt->execute();

    $zonas = array();
    if ($stmt->rowCount() > 0) {
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $zonas[] = array(
                'id_zona' => htmlspecialchars($row['id_zona']),
                'nome' => htmlspecialchars($row['nome'])
            );
        }
    }

    // Conta o total de zonas
    $query = "SELECT COUNT(*) AS total FROM zona";
    $stmt = $db->prepare($query);
    $stmt->execute();
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    $total_zonas = $row['total'];

    // Retorna os dados como JSON
    header('Content-Type: application/json');
    echo json_encode(array(
        'zonas' => $zonas,
        'total' => $total_zonas
    ));
} catch (PDOException $e) {
    die("Erro na consulta a base de dados: " . $e->getMessage());
}
?>
