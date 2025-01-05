<?php
require_once 'db_config.php';

try {
    $db = new PDO("pgsql:host=$host;dbname=$dbname;port=$port", $username, $password);
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Query para selecionar os feedbacks e os utilizadores correspondentes
    $query = "SELECT u.nome AS nome_utilizador, id_feedback, TO_CHAR(f.data, 'DD-MM-YYYY') AS data_formatada, f.descricao, f.avaliacao
              FROM feedback f
              INNER JOIN utilizador u ON f.id_utilizador = u.id_utilizador
              ORDER BY f.id_feedback DESC";
    $resultado = $db->query($query);
    $feedbacks = $resultado->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    echo "Erro na conexão com a base de dados: " . $e->getMessage();
}
?>
