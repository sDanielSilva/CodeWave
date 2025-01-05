<?php
require_once 'db_config.php';

if (isset($_POST['edit_id_zona'], $_POST['edit_nomeZona'])) {
    try {
        $id_zona = $_POST['edit_id_zona'];
        $novo_nome_zona = $_POST['edit_nomeZona'];
        
        $query = "UPDATE zona SET nome = :nome WHERE id_zona = :id_zona";
        $stmt = $db->prepare($query);
        $stmt->bindParam(':id_zona', $id_zona, PDO::PARAM_INT);
        $stmt->bindParam(':nome', $novo_nome_zona, PDO::PARAM_STR);
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
