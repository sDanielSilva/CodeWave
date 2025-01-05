<?php
$dbhost = getenv('DB_HOST');
$dbname = getenv('DB_NAME');
$dbuser = getenv('DB_USERNAME');
$dbpass = getenv('DB_PASSWORD');
$dbport = getenv('DB_PORT');

$conn = pg_connect("host=$dbhost port=$dbport dbname=$dbname user=$dbuser password=$dbpass");

if (!$conn) {
    die("Erro na conexão com a base de dados: " . pg_last_error());
}
?>