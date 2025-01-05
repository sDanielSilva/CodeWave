<?php

$host = getenv('DB_HOST');
$dbname = getenv('DB_NAME');
$username = getenv('DB_USERNAME');
$password = getenv('DB_PASSWORD');
$port = getenv('DB_PORT');

try {
    $conn = new PDO("pgsql:host=$host;port=$port;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Query para selecionar 3 produtos aleatórios
    $query = "SELECT p.id_produto, p.nome, p.preco, p.imagem, c.nome AS nome_categoria, c.id_categoria FROM produto p JOIN Categoria c ON p.id_categoria = c.id_categoria
    WHERE c.loja_online = TRUE AND c.visibilidade = TRUE ORDER BY p.id_produto DESC LIMIT 3;";
    $stmt = $conn->prepare($query);
    $stmt->execute();

    // Armazena as categorias em um array
    $categorias = $stmt->fetchAll(PDO::FETCH_ASSOC);

    $conn = null;
} catch (PDOException $e) {
    // Se houver algum erro na conexão, exibe uma mensagem de erro e interrompe o script
    die("Erro na conexão com a base de dados: " . $e->getMessage());
}
?>