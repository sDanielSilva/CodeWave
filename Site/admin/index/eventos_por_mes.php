<?php
include 'db_connect.php';

$sql = "SELECT DATE_TRUNC('month', data_inicio) as month, COUNT(*) as num_eventos
FROM Evento
GROUP BY month
ORDER BY month;
";
$result = pg_query($conn, $sql);

if (!$result) {
    die("Erro na consulta a base de dados: " . pg_last_error());
}

$months = array();
$num_eventos = array();

while ($row = pg_fetch_assoc($result)) {
    $months[] = $row['month'];
    $num_eventos[] = $row['num_eventos'];
}

$data = array('months' => $months, 'num_eventos' => $num_eventos);
echo json_encode($data);

pg_close($conn);
?>
