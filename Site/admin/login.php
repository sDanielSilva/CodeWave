<?php
session_start();

// Recebe os dados de login do formulário HTML
$email = $_POST['email'];
$user_password = md5($_POST['password']);


$HOST = getenv('DB_HOST');
$DATABASE = getenv('DB_NAME');
$USER = getenv('DB_USERNAME');
$PASSWORD = getenv('DB_PASSWORD');
$PORT = getenv('DB_PORT');

try {

    $conn = new PDO("pgsql:host=$HOST;port=$PORT;dbname=$DATABASE", $USER, $PASSWORD);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Executa a consulta para verificar as credenciais do login
    $stmt = $conn->prepare("SELECT nome, img, id_funcionario FROM funcionario WHERE email = :email AND password = :password");
    $stmt->bindParam(':email', $email);
    $stmt->bindParam(':password', $user_password);
    $stmt->execute();

    // Verifica se o login foi bem-sucedido
    if ($stmt->rowCount() > 0) {
        // Login bem-sucedido, procura informações do utilizador
        $userf = $stmt->fetch(PDO::FETCH_ASSOC);
        $userf_id = $userf['id_funcionario']; // Obtém o ID do utilizador
        $userf_email = $userf['email'];
        $userf_password = $userf['password'];
        $userf_name = $userf['nome']; // Obtém o nome do utilizador
        $userf_img = $userf['img']; // Obtém a imagem do utilizador
    
        // Armazena o nome e a imagem do utilizador na sessão
        $_SESSION['userf_email'] = $userf_email;
        $_SESSION['userf_password'] = $userf_password;
        $_SESSION['userf_name'] = $userf_name;
        $_SESSION['userf_img'] = $userf_img;
        $_SESSION['userf_id'] = $userf_id;


        // Executa uma nova consulta para obter o id_cargo do funcionário
        $stmt = $conn->prepare("SELECT id_cargo FROM public.progressao WHERE id_funcionario = :id_funcionario");
        $stmt->bindParam(':id_funcionario', $userf_id);
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            $cargo = $stmt->fetch(PDO::FETCH_ASSOC);
            $id_cargo = $cargo['id_cargo'];

            $_SESSION['userf_cargo'] = $id_cargo;
            echo "<script type='text/javascript'>alert('O id_cargo é ' + $id_cargo);</script>";

            // Verifica o id_cargo e redireciona para a página apropriada
            if ($id_cargo == 1) {
                header("Location: index.php");
            } elseif ($id_cargo == 2) {
                header("Location: bilhetes.php");
            } else { 
                echo "<script type='text/javascript'>console.log('Não foi possível iniciar sessão');</script>";
               
            }
        } else {
            // O funcionário não tem um registo na tabela de progressão
            echo "<script type='text/javascript'>console.log('Não foi possível iniciar sessão');</script>";
        }
    } else {
        // Login falhou, redireciona para a página login.html com um erro
        echo "<script type='text/javascript'>console.log('Não foi possível iniciar sessão'); window.location.href = 'login.html';</script>";
    }

} catch(PDOException $e) {
    echo "Erro na conexão com a base de dados: " . $e->getMessage();
}

$conn = null;
?>
