<?php
$host = getenv('DB_HOST');
$port = getenv('DB_PORT');
$db = getenv('DB_NAME');
$user = getenv('DB_USER');
$pass = getenv('DB_PASS');

$conn = pg_connect("host=$host port=$port dbname=$db user=$user password=$pass");

if (!$conn) {
    die("Connection failed: " . pg_last_error());
}

$query = "SELECT id_zona, nome FROM public.zona"; 
$result = pg_query($conn, $query);

if (!$result) {
    echo "Erro ao prucurar zonas: " . pg_last_error($conn);
    exit;
}

$zonas = [];
while ($row = pg_fetch_assoc($result)) {
    $zonas[] = $row;
}

pg_close($conn);
?>
