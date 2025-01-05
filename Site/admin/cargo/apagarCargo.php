<?php
require_once 'db_config.php';

if (isset($_GET['id_cargo'])) {
    try {
        $query = "DELETE FROM cargo WHERE id_cargo = :id_cargo";
        $stmt = $db->prepare($query);
        $stmt->bindParam(':id_cargo', $_GET['id_cargo'], PDO::PARAM_INT);
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
