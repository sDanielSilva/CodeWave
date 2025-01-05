<?php

// Recebe os dados de login do formulário HTML
$nome = $_POST['nome'];
$user_password = $_POST['password'];


$HOST = getenv('DB_HOST');
$DATABASE = getenv('DB_NAME');
$USER = getenv('DB_USERNAME');
$PASSWORD = getenv('DB_PASSWORD');
$PORT = getenv('DB_PORT');

try {

    $conn = new PDO("pgsql:host=$HOST;port=$PORT;dbname=$DATABASE", $USER, $PASSWORD);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Executa a consulta para verificar as credenciais de login
    $stmt = $conn->prepare("SELECT * FROM funcionarios WHERE nome = :nome AND password = :password");
    $stmt->bindParam(':nome', $nome);
    $stmt->bindParam(':password', $user_password);
    $stmt->execute();

    // Verifica se o login foi bem-sucedido
    if ($stmt->rowCount() > 0) {
        // Login bem-sucedido, redireciona para a página index.html
        header("Location: teste.html");
        exit();
    } else {
        // Login falhou, redireciona para a página login.html com um erro
        header("Location: login.html?error=1");
        exit();
    }

} catch(PDOException $e) {
    echo "Erro na conexão com a base de dados: " . $e->getMessage();
}

?>
