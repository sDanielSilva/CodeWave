<?php
require_once 'db_config.php';

$noticias_por_pagina = 7;
$pagina_atual = isset($_GET['pagina']) ? (int)$_GET['pagina'] : 1;
$primeira_noticia = ($pagina_atual - 1) * $noticias_por_pagina;

try {
    $query = "SELECT id_funcionario, img, nome, password, email FROM funcionario ORDER BY id_funcionario ASC LIMIT ? OFFSET ?";
    $stmt = $db->prepare($query);
    $stmt->bindValue(1, $noticias_por_pagina, PDO::PARAM_INT);
    $stmt->bindValue(2, $primeira_noticia, PDO::PARAM_INT);
    $stmt->execute();

    $funcionarios = array();
    if ($stmt->rowCount() > 0) {
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $funcionarios[] = array(
                'id_funcionario' => htmlspecialchars($row['id_funcionario']),
                'img' => htmlspecialchars($row['img']),
                'nome' => htmlspecialchars($row['nome']),
                'password' => htmlspecialchars($row['password']),
                'email' => htmlspecialchars($row['email'])
            );
        }
    }

    // Conta o total de funcionarios
    $query = "SELECT COUNT(*) AS total FROM funcionario";
    $stmt = $db->prepare($query);
    $stmt->execute();
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    $total_funcionarios = $row['total'];

    // Retorna os dados como JSON
    header('Content-Type: application/json');
    echo json_encode(array(
        'funcionarios' => $funcionarios,
        'total' => $total_funcionarios
    ));
} catch (PDOException $e) {
    die("Erro na consulta a base de dados: " . $e->getMessage());
}
?>
