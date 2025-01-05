<?php
require_once 'db_config.php';

if (isset($_GET['id_funcionario'])) {
    try {
        $query = "DELETE FROM funcionario WHERE id_funcionario = :id_funcionario";
        $stmt = $db->prepare($query);
        $stmt->bindParam(':id_funcionario', $_GET['id_funcionario'], PDO::PARAM_INT);
        $stmt->execute();

        header("Location: " . $_SERVER["HTTP_REFERER"]);
        exit();
    } catch (PDOException $e) {
        header("Location: " . $_SERVER["HTTP_REFERER"] . "?error=1");
        exit();
    }
} else {
    header("Location: " . $_SERVER["HTTP_REFERER"] . "?error=missing_id");
    exit();
}
?>