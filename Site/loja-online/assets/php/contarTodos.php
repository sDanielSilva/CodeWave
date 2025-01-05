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

    // Query para contar o número de produtos
    $query = "SELECT COUNT(*)
                FROM Produto p
                JOIN Categoria c ON p.id_categoria = c.id_categoria
                WHERE c.loja_online = TRUE AND c.visibilidade = TRUE";
    $stmt = $db->prepare($query);
    $stmt->execute();

    // Obtem o resultado da contagem
    $count = $stmt->fetchColumn();

    $db = null;
} catch (PDOException $e) {
    // Se houver algum erro na conexão, exibe uma mensagem de erro e interrompe o script
    die("Erro na conexão com a base de dados: " . $e->getMessage());
}
?>
