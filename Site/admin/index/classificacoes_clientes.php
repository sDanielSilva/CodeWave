<?php
include 'db_connect.php';

$periodo = isset($_GET['periodo']) ? $_GET['periodo'] : 'sempre';
$classificacoes = array('1' => 0, '2' => 0, '3' => 0, '4' => 0, '5' => 0);

$sql = "SELECT avaliacao, COUNT(*) AS contagem FROM Feedback";

if ($periodo == 'este_mes') {
    $sql .= " WHERE DATE_TRUNC('month', data) = DATE_TRUNC('month', CURRENT_DATE)";
} elseif ($periodo == 'este_ano') {
    $sql .= " WHERE DATE_TRUNC('year', data) = DATE_TRUNC('year', CURRENT_DATE)";
}

$sql .= " GROUP BY avaliacao ORDER BY avaliacao;";
$result = pg_query($conn, $sql);

if (!$result) {
    die("Erro na consulta a base de dados: " . pg_last_error());
}

while ($row = pg_fetch_assoc($result)) {
    $classificacoes[$row['avaliacao']] = (int)$row['contagem']; 
}

$totalAvaliacoes = array_sum($classificacoes);
$media = $totalAvaliacoes > 0 ? array_sum(array_map(function($valor, $quantidade) {
    return $valor * $quantidade;
}, array_keys($classificacoes), $classificacoes)) / $totalAvaliacoes : 0;

$data = array('classificacoes' => $classificacoes, 'media' => $media);
echo json_encode($data);

pg_close($conn);
?>
