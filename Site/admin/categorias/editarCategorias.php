<?php
require_once 'db_config.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST['id'];
    $nome = $_POST['nome'];

    try {
        if (!empty($id) && !empty($nome)) {
            $query = "UPDATE public.categoria SET nome = :nome WHERE id_categoria = :id";
            $stmt = $db->prepare($query);
            $stmt->bindParam(':nome', $nome);
            $stmt->bindParam(':id', $id);
            $stmt->execute();

            if ($stmt->rowCount() > 0) {
                echo json_encode(array('success' => true));
            } else {
                echo json_encode(array('error' => 'Nenhuma alteração foi feita ou ID não encontrado.'));
            }
        } else {
            echo json_encode(array('error' => 'Dados incompletos.'));
        }
        exit();
    } catch (PDOException $e) {
        echo json_encode(array('error' => $e->getMessage()));
        exit();
    }
}
?>
