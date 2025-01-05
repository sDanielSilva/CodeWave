<?php

$host = getenv('DB_HOST');
$dbname = getenv('DB_NAME');
$username = getenv('DB_USERNAME');
$password = getenv('DB_PASSWORD');
$port = getenv('DB_PORT'); 

try {
    $db = new PDO("pgsql:host=$host;dbname=$dbname;port=$port", $username, $password);
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Query para selecionar os feedbacks e os utilizadores correspondentes
    $query = "SELECT u.nome AS nome_utilizador, id_feedback, TO_CHAR(f.data, 'DD-MM-YYYY') AS data_formatada, f.descricao, f.avaliacao
              FROM feedback f
              INNER JOIN utilizador u ON f.id_utilizador = u.id_utilizador
              ORDER BY f.id_feedback DESC
              LIMIT 5";
    $resultado = $db->query($query);

    // Loop pelos resultados e exibir os feedbacks
    while ($row = $resultado->fetch(PDO::FETCH_ASSOC)) {
        echo '<div class="testimonial">';
        echo '<div class="testimonial-content">';
        echo '<div class="testimonial-icon">';
        echo '<i class="fa fa-quote-left"></i>';
        echo '</div>';
        echo '<p class="description">' . $row['descricao'] . '</p>';
        echo '</div>';
        echo '<h3 class="title">' . $row['nome_utilizador'] . '</h3>';
        echo '<span class="post">';
        // Exibe as estrelas com base na avaliação
        for ($i = 1; $i <= $row['avaliacao']; $i++) {
            echo '<i class="fas fa-star"></i>';
        }
        echo '</span>';
        echo '</div>';
    }
} catch (PDOException $e) {
    echo "Erro ao conectar a base de dados: " . $e->getMessage();
}
?>
