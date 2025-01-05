<?php
require_once 'db_config.php';

if (isset($_GET['id_feedback'])) {
    try {
        $query = "DELETE FROM feedback WHERE id_feedback = :id_feedback";
        $stmt = $db->prepare($query);
        $stmt->bindParam(':id_feedback', $_GET['id_feedback'], PDO::PARAM_INT);
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
