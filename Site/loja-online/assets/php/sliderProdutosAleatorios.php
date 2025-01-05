<?php
// Conexão com a base de dados
$host = getenv('DB_HOST');
$dbname = getenv('DB_NAME');
$username = getenv('DB_USERNAME');
$password = getenv('DB_PASSWORD');
$port = getenv('DB_PORT');

try {
    $conn = new PDO("pgsql:host=$host;port=$port;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Query para selecionar 3 produtos aleatórios
    $query = "SELECT p.id_produto, p.nome, p.preco, p.imagem, c.nome AS nome_categoria, c.id_categoria
                FROM produto p 
                JOIN Categoria c ON p.id_categoria = c.id_categoria
                WHERE c.loja_online = TRUE AND c.visibilidade = TRUE
                AND p.id_produto IN (
                    SELECT DISTINCT ON (c.id_categoria) p.id_produto
                    FROM produto p 
                    JOIN Categoria c ON p.id_categoria = c.id_categoria
                    WHERE c.loja_online = TRUE AND c.visibilidade = TRUE
                    ORDER BY c.id_categoria, random()
                )
                ORDER BY c.id_categoria, p.id_produto DESC;
                ";
    $stmt = $conn->prepare($query);
    $stmt->execute();

    // Armazena as categorias em um array
    $categorias = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Exibe os resultados formatados
    foreach ($categorias as $categoria) {
        echo '<div class="row">';
        echo '<div class="col-12 col-md-12 p-5 mt-3 text-center">';
        echo '<img src="' . $categoria['imagem'] . '" alt="' . $categoria['nome'] . '" class="rounded-circle img-fluid border" style="width: 200px; height: 200px;">';
        echo '<h3 class="text-center mt-3 mb-3">' . $categoria['nome'] . '</h3>';
        echo '<h3 class="text-center mt-3 mb-3">' . $categoria['preco'] . ' €</h3>';
        echo '<p class="text-center"><a class="btn btn-success" onclick="redirectToCategory(\'produto-' . $categoria['id_produto'] . '\')">Ver Produto</a></p>';
        echo '</div>';
        echo '</div>';
    }

    $conn = null;
} catch (PDOException $e) {
    // Se houver algum erro na conexão, exibe uma mensagem de erro e interrompe o script
    echo "Erro na conexão com a base de dados: " . $e->getMessage();
}
?>
