<?php
require_once 'db_config.php';

if (isset($_POST['edit_id_cargo'], $_POST['edit_nomeCargo'])) {
    try {
        $id_cargo = $_POST['edit_id_cargo'];
        $novo_nome_cargo = $_POST['edit_nomeCargo'];
        
        $query = "UPDATE cargo SET descricao = :descricao WHERE id_cargo = :id_cargo";
        $stmt = $db->prepare($query);
        $stmt->bindParam(':id_cargo', $id_cargo, PDO::PARAM_INT);
        $stmt->bindParam(':descricao', $novo_nome_cargo, PDO::PARAM_STR);
        $stmt->execute();
        
        header("Location: ".$_SERVER["HTTP_REFERER"]);
        exit();
    } catch (PDOException $e) {
        header("Location: ".$_SERVER["HTTP_REFERER"]."?error=1");
        exit();
    }
} else {
    header("Location: ".$_SERVER["HTTP_REFERER"]."?error=missing_params");
    exit();
}
?>
