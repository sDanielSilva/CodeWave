<?php
require_once 'db_config.php';

try {
    $query = "SELECT COUNT(*) AS total FROM categoria where visibilidade = true";
    $stmt = $db->prepare($query);
    $stmt->execute();

    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    $totalCategorias = $result ? $result['total'] : 0;

    // Retorna o total de categorias em formato JSON
    echo json_encode(['total' => $totalCategorias]);

} catch (PDOException $e) {
    // Retorna o erro em formato JSON
    echo json_encode(['error' => "Erro na consulta SQL: " . $e->getMessage()]);
}
?>