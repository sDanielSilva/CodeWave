<?php
// Conexão com a base de dados PostgreSQL
$host = getenv('DB_HOST');
$port = getenv('DB_PORT');
$dbname = getenv('DB_NAME');
$username = getenv('DB_USERNAME');
$password = getenv('DB_PASSWORD');

try {
    $pdo = new PDO("pgsql:host=$host;port=$port;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Erro na conexão com a base de dados: " . $e->getMessage());
}

// Verifica se a sessão não está ativa antes de iniciá-la
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Verifica se o id do utilizador está armazenado na sessão
if (!isset($_SESSION['user_id']) || empty($_SESSION['user_id'])) {
    die("ID do utilizador não encontrado na sessão.");
}

// Obtém o id do utilizador da sessão
$id_utilizador = $_SESSION['user_id'];

// Obtém os dados do utilizador do corpo da requisição
$data = json_decode(file_get_contents('php://input'), true);
$nome = $data['nome'];
$email = $data['email'];
$num_telemovel = $data['num_telemovel'];

// Atualiza os dados do utilizador na base de dados
$query = "UPDATE public.utilizador SET nome = :nome, email = :email, num_telemovel = :num_telemovel WHERE id_utilizador = :id_utilizador";
try {
    $statement = $pdo->prepare($query);
    $statement->bindParam(':nome', $nome, PDO::PARAM_STR);
    $statement->bindParam(':email', $email, PDO::PARAM_STR);
    $statement->bindParam(':num_telemovel', $num_telemovel, PDO::PARAM_STR);
    $statement->bindParam(':id_utilizador', $id_utilizador, PDO::PARAM_INT);
    $statement->execute();
    
    echo json_encode(['status' => 'success']);
} catch (PDOException $e) {
    die("Erro ao atualizar utilizador: " . $e->getMessage());
}

$pdo = null;


?>
