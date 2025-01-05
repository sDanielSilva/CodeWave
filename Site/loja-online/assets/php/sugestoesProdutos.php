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

    // Query para recuperar as categorias
    $query = "SELECT 
                p.nome AS nome_produto,
                p.preco,
                p.imagem,
                p.id_produto,
                c.nome AS nome_categoria,
                c.id_categoria
              FROM 
                categoria c
              LEFT JOIN (
              SELECT 
                id_produto,
                nome,
                preco,
                id_categoria,
                imagem,
                ROW_NUMBER() OVER (PARTITION BY id_categoria ORDER BY id_produto) AS rn
              FROM 
                produto) p ON c.id_categoria = p.id_categoria AND p.rn = 1
              WHERE
                c.loja_online = TRUE AND c.visibilidade = TRUE
              ORDER BY 
                c.nome;";
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