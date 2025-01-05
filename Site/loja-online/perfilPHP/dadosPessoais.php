<?php
// Conexão com base de dados PostgreSQL
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

// Verifica se o email está armazenado na sessão
if (!isset($_SESSION['user_email']) || empty($_SESSION['user_email'])) {
    die("Email não encontrado na sessão.");
}

// Obtém o email da sessão
$email = $_SESSION['user_email'];

// Consulta a base de dados para procurar os dados do utilizaodr associado ao email
$query = "
        SELECT nome, email, num_telemovel, newsletter  
        FROM public.utilizador 
        WHERE email = :email
        ";

try {
    $statement = $pdo->prepare($query);
    $statement->bindParam(':email', $email, PDO::PARAM_STR);
    $statement->execute();
    $user = $statement->fetch(PDO::FETCH_ASSOC);
    
    // Se o utilizador for encontrado, retorna seus dados em JSON
    if ($user) {
        header('Content-Type: application/json');
        echo json_encode($user);
    } else {
        die("Utilizador não encontrado.");
    }
} catch (PDOException $e) {
    die("Erro ao procurar o utilizador: " . $e->getMessage());
}

$pdo = null;
?>