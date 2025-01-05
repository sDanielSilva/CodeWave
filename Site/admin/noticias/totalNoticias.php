<?php
require_once 'db_config.php';

try {
    $conn = new PDO("pgsql:host=$host;port=$port;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $sql = "SELECT COUNT(*) AS total FROM public.noticias";
    $stmt = $conn->prepare($sql);

    $stmt->execute();

    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    echo $row['total'];
} catch(PDOException $e) {
    echo 'Erro ao obter o total de notícias: ' . $e->getMessage();
} finally {
    $conn = null;
}
?>
