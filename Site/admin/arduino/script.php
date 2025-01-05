<?php
$host = getenv('DB_HOST');
$dbname = getenv('DB_NAME');
$username = getenv('DB_USERNAME');
$password = getenv('DB_PASSWORD');
$port = getenv('DB_PORT');

try {
    $db = new PDO("pgsql:host=$host;port=$port;dbname=$dbname", $username, $password);
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $query = $db->query("SELECT id_luz, status FROM luzes");
    $leds = $query->fetchAll(PDO::FETCH_ASSOC);

    header('Content-Type: application/json');
    echo json_encode($leds);

} catch (PDOException $e) {
    header('Content-Type: application/json', true, 500);
    echo json_encode(["error" => "Erro na conexão com a base de dados: " . $e->getMessage()]);
}
?>
