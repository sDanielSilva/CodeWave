<?php

$host = getenv('DB_HOST');
$dbname = getenv('DB_NAME');
$username = getenv('DB_USERNAME');
$password = getenv('DB_PASSWORD');
$port = getenv('DB_PORT');

try {
    // Conexão com a base de dados
    $pdo = new PDO("pgsql:host=$host;port=$port;dbname=$dbname;user=$username;password=$password");

    // Prepara e executa a consulta SQL
    $query = "SELECT e.data_inicio, e.tipo, z.nome 
              FROM public.evento AS e 
              JOIN public.zona AS z ON e.id_zona = z.id_zona 
              WHERE e.aprovado = true ORDER BY e.data_inicio DESC";
    $statement = $pdo->query($query);

    // Verifica se há eventos com a data de hoje
    while ($row = $statement->fetch(PDO::FETCH_ASSOC)) {
        $data_inicio = $row['data_inicio'];
        $today = date('Y-m-d');
        if ($data_inicio === $today) {
            header('Content-Type: application/json');
            echo json_encode($row);
            exit(); // Para a execução após encontrar o primeiro evento de hoje
        }
    }

    // Se nenhum evento de hoje for encontrado
    echo json_encode(["message" => "Nenhum evento encontrado para hoje"]);

} catch (PDOException $e) {
    // Em caso de erro na conexão ou na consulta
    echo "Erro: " . $e->getMessage();
}
?>
