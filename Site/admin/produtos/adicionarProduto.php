<?php
// Conexão com a base de dados
$host = getenv('DB_HOST');
$dbname = getenv('DB_NAME');
$username = getenv('DB_USERNAME');
$password = getenv('DB_PASSWORD');
$port = getenv('DB_PORT');

try {
    // Estabelece conexão com a base de dados
    $db = new PDO("pgsql:host=$host;port=$port;dbname=$dbname", $username, $password);
    // Configura para lançar exceções em caso de erro
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Verifica se o formulário de adição foi submetido
    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["nomeFuncionario"]) && isset($_POST["categoria_produto"]) && isset($_POST["precoProduto"]) && isset($_POST["stockProduto"]) && isset($_POST["ivaProduto"]) && isset($_POST["imagemUrl"])) {
        // Recebe os dados do formulário
        $nome = $_POST['nomeFuncionario'];
        $categoria = $_POST['categoria_produto'];
        $preco = $_POST['precoProduto'];
        $stock = $_POST['stockProduto'];
        $iva = $_POST['ivaProduto'];
        $imagem = $_POST['imagemUrl'];

        // Prepara e executa a query para adicionar o produto
        $query = "INSERT INTO produto (nome, id_categoria, preco, capacidade, iva, imagem) VALUES (:nome, :categoria, :preco, :stock, :iva, :imagem)";
        $stmt = $db->prepare($query);
        $stmt->bindParam(':nome', $nome);
        $stmt->bindParam(':categoria', $categoria);
        $stmt->bindParam(':preco', $preco);
        $stmt->bindParam(':stock', $stock);
        $stmt->bindParam(':iva', $iva);
        $stmt->bindParam(':imagem', $imagem);
        $stmt->execute();

        // Redireciona de volta para a página de produtos após adicionar o produto
        header("Location: /CodeWave/Site/admin/produtos.php");
        exit();
    }
} catch (PDOException $e) {
    // Se houver algum erro na conexão ou na execução da query, exibe uma mensagem de erro
    echo "Erro ao adicionar produto: " . $e->getMessage();
}
?>
