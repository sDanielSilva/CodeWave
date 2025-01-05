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

    // Query para recuperar as categorias, excluindo a categoria "aluguer"
    $query = "SELECT id_categoria, nome FROM categoria
              WHERE loja_online = TRUE AND visibilidade = TRUE
              ORDER BY nome";
    $stmt = $db->prepare($query);
    $stmt->execute();

    // Armazena as categorias em um array
    $categorias = $stmt->fetchAll(PDO::FETCH_ASSOC);

    $db = null;
} catch (PDOException $e) {
    // Se houver algum erro na conexão, exibe uma mensagem de erro e interrompe o script
    die("Erro na conexão com a base de dados: " . $e->getMessage());
}
?>
