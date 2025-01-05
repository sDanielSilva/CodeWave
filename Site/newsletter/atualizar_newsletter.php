<?php
session_start();
$host = getenv('DB_HOST');
$dbname = getenv('DB_NAME');
$username = getenv('DB_USERNAME');
$password = getenv('DB_PASSWORD');
$port = getenv('DB_PORT');

// Conexão com a base de dados
$conexao = pg_connect("host=$host port=$port dbname=$dbname user=$username password=$password");

if (!$conexao) {
    die("Falha na conexão: " . pg_last_error());
}

if(isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id'];
    // Atualiza o atributo 'newsletter' para verdadeiro na tabela 'utilizador'
    $sql = "UPDATE utilizador SET newsletter = true WHERE id_utilizador = $user_id";
    $resultado = pg_query($conexao, $sql);
    if($resultado) {
        echo 'sucesso';
    } else {
        echo 'erro';
    }
}
?>
