<?php
require_once 'db_config.php';

header('Content-Type: application/json');

// Procura os cargos na base de dados
try {
    $queryCargos = "SELECT id_cargo, descricao FROM cargo";
    $stmtCargos = $db->prepare($queryCargos);
    $stmtCargos->execute();
    $cargos = $stmtCargos->fetchAll(PDO::FETCH_ASSOC);

    echo json_encode($cargos);
} catch (PDOException $e) {
    echo json_encode(['error' => "Erro ao carregar cargos: " . $e->getMessage()]);
    exit();
}
?>
