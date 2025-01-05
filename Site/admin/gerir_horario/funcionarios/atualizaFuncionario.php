<?php
require_once 'db_config.php';

if (isset($_POST['edit_id_funcionario'], $_POST['edit_nomeFuncionario'], $_POST['edit_password'], $_POST['edit_email'], $_POST['edit_img'])) {
    try {
        $id_funcionario = $_POST['edit_id_funcionario'];
        $novo_nome_funcionario = $_POST['edit_nomeFuncionario'];
        $nova_password = $_POST['edit_password'];
        $novo_email = $_POST['edit_email'];
        $nova_img = $_POST['edit_img'];
        
        $query = "UPDATE funcionario SET nome = :nome, password = :password, email = :email, img = :img WHERE id_funcionario = :id_funcionario";
        $stmt = $db->prepare($query);
        $stmt->bindParam(':id_funcionario', $id_funcionario, PDO::PARAM_INT);
        $stmt->bindParam(':nome', $novo_nome_funcionario, PDO::PARAM_STR);
        $stmt->bindParam(':password', $nova_password, PDO::PARAM_STR);
        $stmt->bindParam(':email', $novo_email, PDO::PARAM_STR);
        $stmt->bindParam(':img', $nova_img, PDO::PARAM_STR);
        $stmt->execute();
        
        // Verifica se houve alguma linha afetada
        if ($stmt->rowCount() > 0) {
            echo "Atualização bem-sucedida.";
        } else {
            echo "Nenhuma alteração foi feita.";
        }
    } catch (PDOException $e) {
        echo "Erro ao atualizar funcionário: " . $e->getMessage();
    }
} else {
    echo "Parâmetros ausentes.";
}
?>
