<?php
require_once 'db_config.php';

if (isset($_POST['id_produto_edit'], $_POST['nome_edit_consumivel'], $_POST['preco_edit'], $_POST['capacidade_edit'], $_POST['iva_edit'], $_POST['categoria_edit'], $_POST['imagem_edit'])) {
    try {
        $id_produto = $_POST['id_produto_edit'];
        $nome = $_POST['nome_edit_consumivel'];
        $preco = $_POST['preco_edit'];
        $capacidade = $_POST['capacidade_edit'];
        $iva = $_POST['iva_edit'];
        $categoria = $_POST['categoria_edit'];
        $imagem = $_POST['imagem_edit'];


        // Query para atualizar o produto com os novos dados
        $query = "UPDATE produto SET nome = :nome, preco = :preco, capacidade = :capacidade, iva = :iva, id_categoria = :categoria, imagem = :imagem WHERE id_produto = :id_produto";
        $stmt = $db->prepare($query);
        
        $stmt->bindParam(':id_produto', $id_produto, PDO::PARAM_INT);
        $stmt->bindParam(':nome', $nome, PDO::PARAM_STR);
        $stmt->bindParam(':preco', $preco, PDO::PARAM_STR);
        $stmt->bindParam(':capacidade', $capacidade, PDO::PARAM_STR);
        $stmt->bindParam(':iva', $iva, PDO::PARAM_STR);
        $stmt->bindParam(':categoria', $categoria   , PDO::PARAM_STR);
        $stmt->bindParam(':imagem', $imagem, PDO::PARAM_STR);

        $stmt->execute();

        // Redireciona de volta para a página anterior após o sucesso
        header("Location: " . $_SERVER["HTTP_REFERER"]);
        exit();
    } catch (PDOException $e) {
        // Redireciona de volta para a página anterior com erro
        header("Location: " . $_SERVER["HTTP_REFERER"] . "?error=1");
        exit();
    }
} else {
    // Redireciona de volta para a página anterior com erro de parâmetro ausente
    header("Location: " . $_SERVER["HTTP_REFERER"] . "?error=missing_params");
    exit();
}
?>