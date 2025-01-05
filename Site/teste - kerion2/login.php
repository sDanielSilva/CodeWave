<?php
// Verifica se o formulário foi enviado
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $dsn = getenv('DB_DSN');
    $username = getenv('DB_USERNAME');
    $password = getenv('DB_PASSWORD');
    try {
        $conn = new PDO($dsn, $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $nome = $_POST['your_name'];
        $senha = $_POST['your_pass'];

        // Prepara a consulta SQL para verificar o login
        $stmt = $conn->prepare("SELECT * FROM utilizador WHERE email = :nome AND password = :senha");
        $stmt->bindParam(':nome', $nome);
        $stmt->bindParam(':senha', $senha);
        $stmt->execute();

        // Verifica se encontrou algum registro
        if ($stmt->rowCount() > 0) {
            echo "Login bem-sucedido!";
        } else {
            echo "Nome de utilizador ou password incorretos.";
        }
    } catch(PDOException $e) {
        echo "Erro ao autenticar: " . $e->getMessage();
    }
    $conn = null;
}
?>
