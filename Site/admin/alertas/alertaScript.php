<?php
require_once 'db_config.php';

$alertas_por_pagina = 10;
$pagina_atual = isset($_GET['pagina']) ? (int)$_GET['pagina'] : 1;
$primeiro_alerta = ($pagina_atual - 1) * $alertas_por_pagina;

try {
    $query = "SELECT id_alerta, data, mensagem FROM alertas ORDER BY id_alerta ASC LIMIT ? OFFSET ?";
    $stmt = $db->prepare($query);
    $stmt->bindValue(1, $alertas_por_pagina, PDO::PARAM_INT);
    $stmt->bindValue(2, $primeiro_alerta, PDO::PARAM_INT);
    $stmt->execute();

    $alertas = array();
    if ($stmt->rowCount() > 0) {
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $alertas[] = array(
                'id_alerta' => htmlspecialchars($row['id_alerta']),
                'data' => htmlspecialchars($row['data']),
                'mensagem' => htmlspecialchars($row['mensagem'])
            );
        }
    }

    $query = "SELECT COUNT(*) AS total FROM alertas";
    $stmt = $db->prepare($query);
    $stmt->execute();
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    $total_alertas = $row['total'];

    header('Content-Type: application/json');
    echo json_encode(array(
        'alertas' => $alertas,
        'total' => $total_alertas
    ));
} catch (PDOException $e) {
    die("Erro na consulta a base de dados: " . $e->getMessage());
}
?>
