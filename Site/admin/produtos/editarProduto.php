<?php

$host = getenv('DB_HOST');
$dbname = getenv('DB_NAME');
$username = getenv('DB_USERNAME');
$password = getenv('DB_PASSWORD');
$port = getenv('DB_PORT');

try {
    // Estabelece conexão com a base de dados
    $db = new PDO("pgsql:host=$host;port=$port;dbname=$dbname", $username, $password);
    // Configurado para lançar exceções em caso de erro
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    // Se houver algum erro na conexão, exibe uma mensagem de erro e interrompe o script
    die("Erro na conexão com a base de dados: " . $e->getMessage());
}

// Verifica se o formulário de edição foi submetido
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['id'], $_POST['nome'], $_POST['preco'], $_POST['capacidade'], $_POST['iva'], $_POST['categoria'], $_POST['imagem'])) {
    // Recebe os dados do formulário
    $id_produto = $_POST['id'];
    $nome = $_POST['nome'];
    $preco = $_POST['preco'];
    $capacidade = $_POST['capacidade'];
    $iva = $_POST['iva'];
    $categoria = $_POST['categoria'];
    $imagem = $_POST['imagem'];

    // Query para atualizar o produto com os novos dados
    $query = "UPDATE produto SET nome = :nome, preco = :preco, capacidade = :capacidade, iva = :iva, id_categoria = :id_categoria, imagem = :imagem WHERE id_produto = :id";
    $stmt = $db->prepare($query);
    $stmt->bindParam(':nome', $nome);
    $stmt->bindParam(':preco', $preco);
    $stmt->bindParam(':capacidade', $capacidade);
    $stmt->bindParam(':iva', $iva);
    $stmt->bindParam(':id_categoria', $categoria);
    $stmt->bindParam(':imagem', $imagem);
    $stmt->bindParam(':id', $id_produto);

    try {
        $stmt->execute();
        header("Location: /CodeWave/Site/admin/produtos.php");
        exit();
    } catch (PDOException $e) {
        // Se houver algum erro durante a execução da consulta, exibe uma mensagem de erro
        echo "Erro ao editar produto: " . $e->getMessage();
    }
}
?>
