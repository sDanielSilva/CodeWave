<?php
require_once 'db_config.php';

try {
    $query = "SELECT COUNT(*) AS total FROM produto";
    $stmt = $db->prepare($query);
    $stmt->execute();

    if ($stmt) {
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($result) {
            $totalFuncionarios = $result['total'];
            echo $totalFuncionarios;
        } else {
            $totalCargos = 0;
            echo "Nenhum produto encontrado.";
        }
    } else {
        $totalCargos = 0;
        echo "Erro na consulta SQL.";
    }
} catch (PDOException $e) {
    die("Erro na consulta SQL: " . $e->getMessage());
}
?>
