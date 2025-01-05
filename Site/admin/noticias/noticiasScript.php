<?php
require_once 'db_config.php';

$noticias_por_pagina = 7;
$pagina_atual = isset($_GET['pagina']) ? (int)$_GET['pagina'] : 1;
$primeira_noticia = ($pagina_atual - 1) * $noticias_por_pagina;

try {
    $conn = new PDO("pgsql:host=$host;port=$port;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $sql = "SELECT COUNT(*) AS total FROM public.noticias";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $total_noticias = $stmt->fetchColumn();

    $sql = "SELECT * FROM public.noticias ORDER BY id_noticia DESC LIMIT ? OFFSET ?";
    $stmt = $conn->prepare($sql);

    $stmt->bindValue(1, $noticias_por_pagina, PDO::PARAM_INT);
    $stmt->bindValue(2, $primeira_noticia, PDO::PARAM_INT);
    $stmt->execute();

    $noticias = $stmt->fetchAll(PDO::FETCH_ASSOC);
    echo json_encode(['total' => $total_noticias, 'noticias' => $noticias]);
} catch (PDOException $e) {
    echo 'Erro ao obter a lista de notícias: ' . $e->getMessage();
} finally {
    $conn = null;
}
