<?php
require_once 'db_config.php';

$feedback_por_pagina = 7;
$pagina_atual = isset($_GET['pagina']) ? (int)$_GET['pagina'] : 1;
$primeiro_feedback = ($pagina_atual - 1) * $feedback_por_pagina;

try {
    $db = new PDO("pgsql:host=$host;dbname=$dbname;port=$port", $username, $password);
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Query para selecionar os feedbacks e os utilizadores correspondentes
    $query = "SELECT u.nome AS nome_utilizador, id_feedback, TO_CHAR(f.data, 'DD-MM-YYYY') AS data_formatada, f.descricao, f.avaliacao
              FROM feedback f
              INNER JOIN utilizador u ON f.id_utilizador = u.id_utilizador
              ORDER BY f.id_feedback DESC
              LIMIT :limite OFFSET :offset";
    $stmt = $db->prepare($query);
    $stmt->bindParam(':limite', $feedback_por_pagina, PDO::PARAM_INT);
    $stmt->bindParam(':offset', $primeiro_feedback, PDO::PARAM_INT);
    $stmt->execute();

    $feedbacks = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Conta o total de feedbacks
    $query_count = "SELECT COUNT(*) AS total FROM feedback";
    $stmt_count = $db->prepare($query_count);
    $stmt_count->execute();
    $row_count = $stmt_count->fetch(PDO::FETCH_ASSOC);
    $total_feedbacks = $row_count['total'];

    // Retorna os dados como JSON
    header('Content-Type: application/json');
    echo json_encode(array(
        'feedbacks' => $feedbacks,
        'total' => $total_feedbacks
    ));

} catch (PDOException $e) {
    // Lida com exceções PDO
    die("Erro na consulta a base de dados: " . $e->getMessage());
} catch (Exception $e) {
    // Lida com outras exceções
    die("Erro: " . $e->getMessage());
}
?>
