<?php
require_once 'db_config.php';

try {
    $query = "SELECT id_cargo, descricao FROM public.cargo";
    $stmt = $db->prepare($query);
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

    // Retornar os dados como JSON
    header('Content-Type: application/json');
    echo json_encode($cargos);
} catch (PDOException $e) {
    die("Erro na consulta a base de dados: " . $e->getMessage());
}
?>
