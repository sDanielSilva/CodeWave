<?php
require_once 'db_config.php';

try {
    $dsn = "pgsql:host=$host;port=$port;dbname=$dbname";
    $db = new PDO($dsn, $username, $password, [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    ]);

    $query = "SELECT COUNT(*) as total FROM produto WHERE id_categoria IN (10, 13, 14)";
    $stmt = $db->prepare($query);
    $stmt->execute();

    if ($stmt) {
        $result = $stmt->fetch();
        if ($result) {
            $totalConsumivel = $result['total'];
            echo $totalConsumivel;
        } else {
            echo "Nenhum consumível encontrado.";
        }
    } else {
        echo "Erro na consulta SQL.";
    }
} catch (PDOException $e) {
    die("Erro na consulta SQL: " . $e->getMessage());
}
?>
