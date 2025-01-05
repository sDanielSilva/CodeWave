<?php
session_start(); // Inicia a sessão

// Verifica se o formulário foi enviado
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $dsn = getenv('DB_DSN');
    $username = getenv('DB_USERNAME');
    $password = getenv('DB_PASSWORD');
    try {
        $conn = new PDO($dsn, $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $nome = $_POST['your_name'];
        $senha = md5($_POST['your_pass']);  // Aqui é onde a senha é convertida em um hash MD5

        // Prepara a consulta SQL para verificar o login
        $stmt = $conn->prepare("SELECT * FROM utilizador WHERE email = :nome AND password = :senha");
        $stmt->bindParam(':nome', $nome);
        $stmt->bindParam(':senha', $senha);
        $stmt->execute();

        // Verifica se encontrou algum registro
        if ($stmt->rowCount() > 0) {
            $user = $stmt->fetch(PDO::FETCH_ASSOC); // Recupera os dados do utilizador como um array associativo
            $user_name = $user['nome']; // Assume que o nome do utilizador está na coluna 'nome'
            $user_email = $user['email'];
            $user_id = $user['id_utilizador'];
            $user_num_telemovel = $user['num_telemovel'];
            $_SESSION['user_name'] = $user_name;
            $_SESSION['user_email'] = $user_email;
            $_SESSION['user_id'] = $user_id;
            $_SESSION['user_num_telemovel'] = $user_num_telemovel;

            // Login bem-sucedido, redirecionar para a página de sucesso
            $response = array(
                'success' => true,
                'redirectURL' => 'index.php' // Default redirect URL
            );

            if (isset($_POST['redirectURL']) && !empty($_POST['redirectURL'])) {
                $response['redirectURL'] = $_POST['redirectURL'];
            }

            // Envie a resposta como JSON
            header('Content-Type: application/json');
            echo json_encode($response);
            exit();

        } else {
            // Nome de utilizador ou password incorretos, exibir mensagem de erro
            $error_message = "Email ou password incorretos.";

            // Crie um array para enviar a resposta JSON com a mensagem de erro
            $response = array(
                'success' => false,
                'error_message' => $error_message
            );

            // Envie a resposta como JSON
            header('Content-Type: application/json');
            echo json_encode($response);
            exit();
        }
    } catch (PDOException $e) {
        // Se ocorrer uma exceção, envie uma resposta JSON com a mensagem de erro
        $error_message = "Erro ao autenticar: " . $e->getMessage();
        $response = array(
            'success' => false,
            'error_message' => $error_message
        );

        // Envie a resposta como JSON
        header('Content-Type: application/json');
        echo json_encode($response);
        exit();
    }
}
