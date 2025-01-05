<?php
require_once 'db_config.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST['id'];
    $loja_online = filter_var($_POST['loja_online'], FILTER_VALIDATE_BOOLEAN);

    try {
        if (!empty($id)) {
            $query = "UPDATE public.categoria SET loja_online = :loja_online WHERE id_categoria = :id";
            $stmt = $db->prepare($query);
            $stmt->bindParam(':loja_online', $loja_online, PDO::PARAM_BOOL);
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->execute();

            if ($stmt->rowCount() > 0) {
                echo json_encode(array('success' => true));
            } else {
                echo json_encode(array('error' => 'Nenhuma alteração foi feita ou ID não encontrado.'));
            }
        } else {
            echo json_encode(array('error' => 'ID da categoria não fornecido.'));
        }
        exit();
    } catch (PDOException $e) {
        echo json_encode(array('error' => $e->getMessage()));
        exit();
    }
}
?>