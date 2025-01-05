<?php
require_once 'db_config.php';

if (isset($_GET['id_noticia'])) {
    try {
        $query = "DELETE FROM public.noticias WHERE id_noticia = :id_noticia";
        $stmt = $db->prepare($query);
        $stmt->bindParam(':id_noticia', $_GET['id_noticia'], PDO::PARAM_INT);
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
