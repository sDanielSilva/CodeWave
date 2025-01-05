<?php
require_once 'db_config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Verifica se todos os campos estão preenchidos
    if (
        isset($_POST['nomeConsumivel']) && !empty($_POST['nomeConsumivel']) &&
        isset($_POST['preco']) && !empty($_POST['preco']) &&
        isset($_POST['capacidade']) && !empty($_POST['capacidade']) &&
        isset($_POST['iva']) && !empty($_POST['iva']) &&
        isset($_POST['categoria']) && !empty($_POST['categoria']) &&
        isset($_POST['imagem']) && !empty($_POST['imagem'])
    ) {
        $nomeConsumivel = $_POST['nomeConsumivel'];
        $preco = $_POST['preco'];
        $capacidade = $_POST['capacidade'];
        $iva = $_POST['iva'];
        $categoria = $_POST['categoria'];
        $imagem = $_POST['imagem'];

        try {
            // Insere os dados na base de dados
            $query = "INSERT INTO produto (nome, preco, capacidade, iva, id_categoria, imagem) 
                      VALUES (:nomeConsumivel, :preco, :capacidade, :iva, :categoria, :imagem)";
            $stmt = $db->prepare($query);
            $stmt->bindParam(':nomeConsumivel', $nomeConsumivel);
            $stmt->bindParam(':preco', $preco);
            $stmt->bindParam(':capacidade', $capacidade);
            $stmt->bindParam(':iva', $iva);
            $stmt->bindParam(':categoria', $categoria);
            $stmt->bindParam(':imagem', $imagem);
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
        // Redireciona de volta para a página anterior com erro de campo vazio
        header("Location: " . $_SERVER["HTTP_REFERER"] . "?error=empty_field");
        exit();
    }
} else {
    echo "O formulário não foi submetido.";
}
?>
