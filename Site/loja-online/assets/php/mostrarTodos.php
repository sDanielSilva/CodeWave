<?php

$host = getenv('DB_HOST');
$dbname = getenv('DB_NAME');
$username = getenv('DB_USERNAME');
$password = getenv('DB_PASSWORD');
$port = getenv('DB_PORT');

try {
    // Estabelece conexão com a base de dados
    $db = new PDO("pgsql:host=$host;port=$port;dbname=$dbname", $username, $password);

    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Query para recuperar as categorias excluindo a categoria "aluguer"
    $query = "SELECT c.nome AS nome_categoria, p.nome AS nome_produto, p.preco, p.imagem, p.id_produto
                FROM produto p
                INNER JOIN categoria c ON p.id_categoria = c.id_categoria
                WHERE c.loja_online = TRUE AND c.visibilidade = TRUE
                ORDER BY c.nome";
    $stmt = $db->prepare($query);
    $stmt->execute();

    // Armazenar as categorias em um array
    $categorias = $stmt->fetchAll(PDO::FETCH_ASSOC);

    $db = null;
} catch (PDOException $e) {
    // Se houver algum erro na conexão, exibe uma mensagem de erro e interrompe o script
    die("Erro na conexão com a base de dados: " . $e->getMessage());
}
?>
