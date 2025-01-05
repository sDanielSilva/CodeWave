<?php
include 'db_connect.php';

$sql = "SELECT DATE_TRUNC('month', data_inicio) as month, SUM(preco) as total_revenue FROM bilhete GROUP BY month ORDER BY month;";
$result = pg_query($conn, $sql);

if (!$result) {
    die("Erro na consulta a base de dados: " . pg_last_error());
}

$months = array();
$total_revenue = array();

while ($row = pg_fetch_assoc($result)) {
    $months[] = $row['month'];
    $total_revenue[] = $row['total_revenue'];
}

$data = array('months' => $months, 'total_revenue' => $total_revenue);
echo json_encode($data);

pg_close($conn);
?>
