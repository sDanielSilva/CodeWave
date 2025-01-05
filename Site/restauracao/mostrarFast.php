<?php
require_once 'db_config.php';

try {
    // Conexão com a base de dados
    $conn = new PDO("pgsql:host=$host;port=$port;dbname=$dbname;user=$username;password=$password");
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Consulta SQL para procurar os produtos com seus respectivos ids, nomes, preços e imagens
    $sql = "SELECT id_produto, nome, preco, imagem FROM produto WHERE id_categoria = 13";

    // Prepara a consulta
    $stmt = $conn->prepare($sql);

    // Executa a consulta
    $stmt->execute();

    // Procura os resultados
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Retorna os resultados como JSON
    echo json_encode($result);

} catch(PDOException $e) {
    // Retorna uma mensagem de erro em caso de exceção
    echo json_encode(array("error" => $e->getMessage()));
}

// Fecha a conexão com a base de dados
$conn = null;
?>
