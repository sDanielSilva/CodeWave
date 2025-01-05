<?php

$host = getenv('DB_HOST');
$dbname = getenv('DB_NAME');
$username = getenv('DB_USERNAME');
$password = getenv('DB_PASSWORD');
$port = getenv('DB_PORT');

try {

    $db = new PDO("pgsql:host=$host;port=$port;dbname=$dbname", $username, $password);
    // Configurado para lançar exceções em caso de erro
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Consulta SQL para selecionar o produto pelo ID
    $query = "SELECT * FROM produto WHERE id_produto = 15";
    $stmt = $db->prepare($query);
    $stmt->execute();

    $query2 = "SELECT * FROM produto WHERE id_produto = 16";
    $stmt2 = $db->prepare($query2);
    $stmt2->execute();

    $query3 = "SELECT * FROM produto WHERE id_produto = 17";
    $stmt3 = $db->prepare($query3);
    $stmt3->execute();

    $query4 = "SELECT * FROM produto WHERE id_produto = 18";
    $stmt4 = $db->prepare($query4);
    $stmt4->execute();

    $query5 = "SELECT * FROM produto WHERE id_produto = 19";
    $stmt5 = $db->prepare($query5);
    $stmt5->execute();

    $query6 = "SELECT * FROM produto WHERE id_produto = 20";
    $stmt6 = $db->prepare($query6);
    $stmt6->execute();

    $query7 = "SELECT * FROM produto WHERE id_produto = 21";
    $stmt7 = $db->prepare($query7);
    $stmt7->execute();

    $query8 = "SELECT * FROM produto WHERE id_produto = 22";
    $stmt8 = $db->prepare($query8);
    $stmt8->execute();

    $query9 = "SELECT * FROM produto WHERE id_produto = 23";
    $stmt9 = $db->prepare($query9);
    $stmt9->execute();

    // Procura resultados da consulta
    $produto15 = $stmt->fetch(PDO::FETCH_ASSOC);
    $produto16 = $stmt2->fetch(PDO::FETCH_ASSOC);
    $produto17 = $stmt3->fetch(PDO::FETCH_ASSOC);
    $produto18 = $stmt4->fetch(PDO::FETCH_ASSOC);
    $produto19 = $stmt5->fetch(PDO::FETCH_ASSOC);
    $produto20 = $stmt6->fetch(PDO::FETCH_ASSOC);
    $produto21 = $stmt7->fetch(PDO::FETCH_ASSOC);
    $produto22 = $stmt8->fetch(PDO::FETCH_ASSOC);
    $produto23 = $stmt9->fetch(PDO::FETCH_ASSOC);

} catch (PDOException $e) {
    // Em caso de erro na conexão ou na consulta SQL, retorna uma mensagem de erro em JSON
    echo json_encode(array("erro" => "Erro na conexão com a base de dados: " . $e->getMessage()));
}
?>