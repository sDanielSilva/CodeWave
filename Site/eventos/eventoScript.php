<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    // Se o utilizador não estiver com sessão iniciada, redireciona para a página de login
    header("Location: login.php");
    exit();
}

$host = getenv('DB_HOST');
$port = getenv('DB_PORT');
$db = getenv('DB_NAME');
$user = getenv('DB_USER');
$pass = getenv('DB_PASS');

// Conexão com a base de dados
$conn = pg_connect("host=$host port=$port dbname=$db user=$user password=$pass");

if (!$conn) {
    die("Connection failed: " . pg_last_error());
}

// Recuperação dos dados do formulário
$data_inicio = $_POST['data_inicio'];
$data_fim = $_POST['data_fim'];
$tipo = $_POST['tipo'];
$outro_tipo = $_POST['outro_tipo'];
$num_convidados = $_POST['num_convidados'];
$descricao = $_POST['descricao'];
$id_zona = $_POST['id_zona'];

// Verifica se o tipo de evento é "Outro" e ajusta o tipo conforme necessário
$tipo_evento = ($tipo === 'Outro') ? $outro_tipo : $tipo;

// Obtém o ID do utilizador da sessão
$id_utilizador = $_SESSION['user_id'];

// Preparação da query de inserção
$query = "INSERT INTO public.evento (data_inicio, data_fim, tipo, descricao, num_convidados, id_utilizador, id_zona) VALUES ($1, $2, $3, $4, $5, $6, $7)";

// Prepara a query
$stmt = pg_prepare($conn, "insert_evento", $query);

// Executa a query com parâmetros
$result = pg_execute($conn, "insert_evento", array($data_inicio, $data_fim, $tipo_evento, $descricao, $num_convidados, $id_utilizador, $id_zona));

if ($result) {
    // Se o evento foi adicionado com sucesso, redireciona para a página de origem ou para uma página padrão
    header("Location: ../eventos.php?sucesso=1");
    exit();
} else {
    echo "Erro ao adicionar evento: " . pg_last_error($conn);
}

// Fecha a conexão com a base de dados
pg_close($conn);
?>