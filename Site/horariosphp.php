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

$query = "SELECT dia, hora_a, hora_f, modalidade FROM horario";
$result = pg_query($conn, $query);

if (!$result) {
    die("Erro na consulta a base de dados: " . pg_last_error());
}

$hours = ['geral' => [], 'escolas' => []];

while ($row = pg_fetch_assoc($result)) {
    $day = $row['dia'];
    $openingTime = $row['hora_a'] ? $row['hora_a'] : "Encerrado";
    $closingTime = $row['hora_f'] ? $row['hora_f'] : "Encerrado";
    $modalidade = $row['modalidade'];

    if ($modalidade === 'escolas' && $openingTime === 'Encerrado' && $closingTime === 'Encerrado') {
        continue; // Não adiciona este horário se a modalidade for "escolas" e a hora de abertura e fecho forem "Encerrado"
    }

    $hours[$modalidade][$day] = [$openingTime, $closingTime];
}

header('Content-Type: application/json');
echo json_encode($hours);
?>
