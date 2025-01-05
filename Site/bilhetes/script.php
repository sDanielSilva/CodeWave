<?php
// Verifica se o formulário foi enviado
if ($_SERVER["REQUEST_METHOD"] == "POST") {
 
    $dsn = getenv('DB_DSN');
    $username = getenv('DB_USERNAME');
    $password = getenv('DB_PASSWORD');

    try {
        $conn = new PDO($dsn, $username, $password);

        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $email = $_POST['email'];

        // Verifica se o email já existe
        $stmt = $conn->prepare("SELECT * FROM utilizador WHERE email = :email");
        $stmt->bindParam(':email', $email);
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            // Nome de utilizador ou password incorretos, exibe mensagem de erro
            $error_message = "Já existe uma conta criada com este email, por favor faça login!";

            // Cria um array para enviar a resposta JSON com a mensagem de erro
            $response = array(
                'success' => false,
                'error_message' => $error_message
            );

            // Envia a resposta como JSON
            header('Content-Type: application/json');
            echo json_encode($response);
            exit();
        } else {
            // O email não existe, continua com o registro
            $name = $_POST['name'];
            $password = md5($_POST['pass']);
            $phone = $_POST['phone'];

            // Prepara a declaração SQL para evitar injeção de SQL
            $stmt = $conn->prepare("INSERT INTO utilizador (nome, email, password, num_telemovel) VALUES (:name, :email, :password, :phone)");

            // Substitui os parâmetros na declaração preparada e executa
            $stmt->bindParam(':name', $name);
            $stmt->bindParam(':email', $email);
            $stmt->bindParam(':password', $password);
            $stmt->bindParam(':phone', $phone);

            $stmt->execute();

            // Login bem-sucedido, redireciona para a página de sucesso
            $response = array(
                'success' => true,
                'redirectURL' => 'login.html' // Default redirect URL
            );

            if (isset($_POST['redirectURL']) && !empty($_POST['redirectURL'])) {
                $response['redirectURL'] = $_POST['redirectURL'];
            }

            // Envia a resposta como JSON
            header('Content-Type: application/json');
            echo json_encode($response);
            exit();
        }
    } catch (PDOException $e) {
        // Se ocorrer uma exceção, envia uma resposta JSON com a mensagem de erro
        $error_message = "Erro ao autenticar: " . $e->getMessage();
        $response = array(
            'success' => false,
            'error_message' => $error_message
        );

        // Envia a resposta como JSON
        header('Content-Type: application/json');
        echo json_encode($response);
        exit();
    }
}
?>