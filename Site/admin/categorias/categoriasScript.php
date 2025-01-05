<?php
require_once 'db_config.php';

$page = isset($_GET['page']) ? intval($_GET['page']) : 1;
$limit = isset($_GET['limit']) ? intval($_GET['limit']) : 10;
$offset = ($page - 1) * $limit;

try {
    // Consulta para obter os dados paginados
    $query = "SELECT * FROM public.categoria where visibilidade = true ORDER BY id_categoria LIMIT :limit OFFSET :offset";
    $stmt = $db->prepare($query);
    $stmt->bindParam(':limit', $limit, PDO::PARAM_INT);
    $stmt->bindParam(':offset', $offset, PDO::PARAM_INT);
    $stmt->execute();
    $data = array();
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        $data[] = array(
            'id_categoria' => $row['id_categoria'],
            'nome' => $row['nome'],
            'loja_online' => $row['loja_online']
        );
    }

    // Consulta para obter o total de categorias
    $countQuery = "SELECT COUNT(*) as total FROM public.categoria";
    $countStmt = $db->query($countQuery);
    $total = $countStmt->fetch(PDO::FETCH_ASSOC)['total'];

    echo json_encode([
        'data' => $data,
        'total' => $total,
        'page' => $page,
        'limit' => $limit,
    ]);
    exit();
} catch (PDOException $e) {
    echo json_encode(array('error' => $e->getMessage()));
    exit();
}
?>
