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

// Verifica se o email está armazenado na sessão
if (!isset($_SESSION['user_id']) || empty($_SESSION['user_id'])) {
    die("Email não encontrado na sessão.");
}

// Obtem o corpo da requisição
$request = json_decode(file_get_contents('php://input'), true);

// Obtem o estado da subscrição da newsletter
$isSubscribed = $request['newsletter'] ? 'true' : 'false';

// Obtem o ID do utilizador da sessão
$userId = $_SESSION['user_id'];

// Prepara a consulta SQL
$stmt = $pdo->prepare('UPDATE public.utilizador SET newsletter = :newsletter WHERE id_utilizador = :id_utilizador');

// Executa a consulta SQL
$stmt->execute(['newsletter' => $isSubscribed, 'id_utilizador' => $userId]);

// Verifica se a consulta foi bem-sucedida
if ($stmt->rowCount() > 0) {
  echo json_encode(['success' => true]);
} else {
  echo json_encode(['success' => false]);
}
?>