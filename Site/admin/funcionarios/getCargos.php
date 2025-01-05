<?php
require_once 'db_config.php';

try {
    $query = "SELECT id_cargo, descricao FROM cargo";
    $stmt = $db->prepare($query);
    $stmt->execute();

    $categorias = $stmt->fetchAll(PDO::FETCH_ASSOC);

    header('Content-Type: application/json');
    echo json_encode($categorias);
} catch (PDOException $e) {
    die("Erro na consulta a base de dados: " . $e->getMessage());
}
?>