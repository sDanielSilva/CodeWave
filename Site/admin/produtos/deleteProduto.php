<?php
require_once 'db_config.php';

if (isset($_GET['id_produto'])) {
    try {
        $query = "DELETE FROM produto WHERE id_produto = :id_produto";
        $stmt = $db->prepare($query);
        $stmt->bindParam(':id_produto', $_GET['id_produto'], PDO::PARAM_INT);
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