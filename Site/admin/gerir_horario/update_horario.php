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

$data = json_decode(file_get_contents('php://input'), true);

var_dump($data); // debugging

if (isset($data['modalidade']) && isset($data['horarios'])) {
    $modalidade = $data['modalidade'];
    $horarios = $data['horarios'];

    foreach ($horarios as $horario) {
        $dia = $horario['dia'];
        $abertura = $horario['abertura'];
        $fecho = $horario['fecho'];

        $query = "UPDATE horario SET hora_a = $1, hora_f = $2 WHERE dia = $3 AND modalidade = $4";
        $params = [$abertura, $fecho, $dia, $modalidade];

        $result = pg_query_params($conn, $query, $params);

        if (!$result) {
            die("Erro na atualização dos horários: " . pg_last_error());
        }
    }

    echo "Horários atualizados com sucesso!";
} else {
    echo "Dados inválidos recebidos.";
}
