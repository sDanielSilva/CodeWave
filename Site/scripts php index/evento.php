<?php

$host = getenv('DB_HOST');
$dbname = getenv('DB_NAME');
$username = getenv('DB_USERNAME');
$password = getenv('DB_PASSWORD');
$port = getenv('DB_PORT'); 

try {

    $db = new PDO("pgsql:host=$host;dbname=$dbname;port=$port", $username, $password);
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Query SQL
    $query = "SELECT TO_CHAR(Evento.data_inicio, 'DD-MM-YYYY') AS data_inicio,
                TO_CHAR(Evento.data_fim, 'DD-MM-YYYY') AS data_fim,
                EXTRACT(MONTH FROM Evento.data_inicio) AS mes_inicio,
                Evento.tipo,
                Evento.descricao,
                Evento.num_convidados,
                Zona.nome AS nome_zona
                FROM Evento
                INNER JOIN Zona ON Evento.id_zona = Zona.id_zona
                ORDER BY Evento.num_convidados DESC";

    // Executa a query
    $resultado = $db->query($query);
} catch (PDOException $e) {
    echo "Erro ao conectar a base de dados: " . $e->getMessage();
}
?>
