<?php
// Conexão com a base de dados
$host = getenv('DB_HOST');
$dbname = getenv('DB_NAME');
$username = getenv('DB_USERNAME');
$password = getenv('DB_PASSWORD');
$port = getenv('DB_PORT');

try {
    // Estabelece conexão com a base de dados
    $conn = new PDO("pgsql:host=$host;port=$port;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Consulta SQL para contar o número de linhas na tabela "progressao"
    $sql = "SELECT COUNT(*) AS total_rows FROM public.progressao";

    // Prepara e executa a consulta
    $stmt = $conn->prepare($sql);
    $stmt->execute();

    // Obtem o resultado da consulta
    $result = $stmt->fetch(PDO::FETCH_ASSOC);

    // Exibe o número total de linhas na tabela
    echo '<span id="numeroFuncionarios">' . $result['total_rows'] . '</span>';

} catch(PDOException $e) {
    echo 'Erro de conexão: ' . $e->getMessage();
}
?>
