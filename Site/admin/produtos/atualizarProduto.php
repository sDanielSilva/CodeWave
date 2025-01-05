<?php
require_once 'db_config.php';

if (isset($_POST['edit_id_produto'], $_POST['edit_nomeProduto'], $_POST['edit_preco'], $_POST['edit_stock'], $_POST['edit_iva'], $_POST['edit_img'])) {
    try {
        $id_produto = $_POST['edit_id_produto'];
        $novo_nome_produto = $_POST['edit_nomeProduto'];
        $novo_preco = $_POST['edit_preco'];
        $novo_stock = $_POST['edit_stock'];
        $novo_iva = $_POST['edit_iva'];
        $nova_img = $_POST['edit_img'];
        
        $query = "UPDATE produto SET nome = :nome, preco = :preco, capacidade = :capacidade, iva = :iva, imagem = :imagem WHERE id_produto = :id_produto";
        $stmt = $db->prepare($query);
        $stmt->bindParam(':id_produto', $id_produto, PDO::PARAM_INT);
        $stmt->bindParam(':nome', $novo_nome_produto, PDO::PARAM_STR);
        $stmt->bindParam(':preco', $novo_preco, PDO::PARAM_STR);
        $stmt->bindParam(':capacidade', $novo_stock, PDO::PARAM_INT);
        $stmt->bindParam(':iva', $novo_iva, PDO::PARAM_INT);
        $stmt->bindParam(':imagem', $nova_img, PDO::PARAM_STR);
        $stmt->execute();
        
        // Verifica se houve alguma linha afetada
        if ($stmt->rowCount() > 0) {
            echo "Atualização bem-sucedida.";
        } else {
            echo "Nenhuma alteração foi feita.";
        }
    } catch (PDOException $e) {
        echo "Erro ao atualizar produto: " . $e->getMessage();
    }
} else {
    echo "Parâmetros ausentes.";
}
?>
