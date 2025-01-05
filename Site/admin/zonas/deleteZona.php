<?php
require_once 'db_config.php';

if (isset($_GET['id_zona'])) {
    try {
        $query = "DELETE FROM zona WHERE id_zona = :id_zona";
        $stmt = $db->prepare($query);
        $stmt->bindParam(':id_zona', $_GET['id_zona'], PDO::PARAM_INT);
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