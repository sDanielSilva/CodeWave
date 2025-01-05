<?php

$host = 'your_host';
$dbname = 'your_dbname';
$username = 'your_username';
$password = 'your_password';
$port = 'your_port';

try {
    // Estabelece conexão com a base de dados
    $db = new PDO("pgsql:host=$host;port=$port;dbname=$dbname", $username, $password);

    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Query para recuperar as categorias
    $query = "SELECT id_categoria, nome FROM categoria
              ORDER BY nome";
    $stmt = $db->prepare($query);
    $stmt->execute();

    // Armazena as categorias em um array
    $categorias = $stmt->fetchAll(PDO::FETCH_ASSOC);
    echo json_encode($categorias);
} catch (PDOException $e) {
    // Se houver algum erro na conexão, exibe uma mensagem de erro e interrompe o script
    die("Erro na conexão com a base de dados: " . $e->getMessage());
}
?>