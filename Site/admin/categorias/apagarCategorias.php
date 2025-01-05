<?php
require_once 'db_config.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST['id'];

    try {
        $query = "UPDATE public.categoria SET visibilidade = false WHERE id_categoria = :id";
        $stmt = $db->prepare($query);
        $stmt->bindParam(':id', $id);
        $stmt->execute();

        echo json_encode(array('success' => 'Registro deletado com sucesso.'));
        exit();
    } catch (PDOException $e) {
        echo json_encode(array('error' => $e->getMessage()));
        exit();
    }
}
?>