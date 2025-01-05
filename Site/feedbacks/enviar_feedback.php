<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Captura os valores do formulário
    $descricao = isset($_POST['descricao']) ? $_POST['descricao'] : '';
    $avaliacao = isset($_POST['avaliacao']) ? $_POST['avaliacao'] : '';

    // Verifica se o utilizador está com sessão iniciada e se 'user_id' está definido na sessão
    if (isset($_SESSION['user_id'])) {
        // Se estiver com sessão iniciada, captura o ID do utilizador da sessão
        $id_utilizador = $_SESSION['user_id'];

        // Conectar a base de dados
        $host = getenv('DB_HOST');
        $dbname = getenv('DB_NAME');
        $username = getenv('DB_USERNAME');
        $password = getenv('DB_PASSWORD');
        $port = getenv('DB_PORT');

        try {
            $pdo = new PDO("pgsql:host=$host;port=$port;dbname=$dbname", $username, $password);
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            // Prepara e executa a consulta SQL para inserir o feedback na tabela Feedback
            $stmt = $pdo->prepare("INSERT INTO Feedback (data, descricao, avaliacao, id_utilizador) VALUES (CURRENT_DATE, ?, ?, ?)");
            $stmt->execute([$descricao, $avaliacao, $id_utilizador]);

            echo "<script>alert('O seu feedback foi recebido, muito obrigado!'); window.location.href = 'dar_feedback.php';</script>";
        } catch (Exception $e) {
            echo "Erro ao inserir feedback: " . $e->getMessage();
        } finally {
            // Fecha a conexão
            $pdo = null;
        }
    } else {
        // Se o utilizador não estiver com sessão iniciada, redirecioná-lo para a página de login
        $_SESSION['redirectURL'] = $_SERVER['PHP_SELF'];
        header("Location: ../loja-online/login.html");
        exit;
    }
}
?>
