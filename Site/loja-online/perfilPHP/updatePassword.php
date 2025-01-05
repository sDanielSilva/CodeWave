<?php
// Conectar a base de dados
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

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Verifica se o email está armazenado na sessão
if (!isset($_SESSION['user_id']) || empty($_SESSION['user_id'])) {
    die("Id não encontrado na sessão.");
}

// Obter dados do POST
$data = json_decode(file_get_contents('php://input'), true);
$currentPassword = md5($data['currentPassword']);  // Aqui é onde a senha atual é convertida em um hash MD5
$newPassword = md5($data['newPassword']);  // Aqui é onde a nova senha é convertida em um hash MD5

// Obter o utilizador atual
$userId = $_SESSION['user_id'];

// Procurar a senha atual do utilizador na base de dados
$stmt = $pdo->prepare('SELECT password FROM utilizador WHERE id_utilizador = ?');
$stmt->execute([$userId]);
$user = $stmt->fetch();

// Verificar se a senha atual está correta
if ($currentPassword != $user['password']) {
    echo json_encode(['success' => false, 'message' => 'Senha atual incorreta'. $user['password'] . $currentPassword]);
    exit;
}

// Atualizar a senha do utilizador
$stmt = $pdo->prepare('UPDATE utilizador SET password = ? WHERE id_utilizador = ?');
$stmt->execute([$newPassword, $userId]);

echo json_encode(['success' => true]);

$pdo = null;
?>
