<?php
include 'db_connect.php';

$sql = "SELECT DATE_TRUNC('month', compra_detalhe.data_hora) as month, produto.nome, SUM(compra_detalhe.quantidade) as total_vendido
FROM produto
JOIN compra_detalhe ON produto.id_produto = compra_detalhe.id_produto
GROUP BY month, produto.nome
ORDER BY month, total_vendido DESC;
";

$result = pg_query($conn, $sql);

if (!$result) {
    die("Erro na consulta a base de dados: " . pg_last_error());
}

$months = array();
$total_vendido = array();
$produto_mais_vendido = array();

while ($row = pg_fetch_assoc($result)) {
    $months[] = $row['month'];
    $total_vendido[] = $row['total_vendido'];
    $produto_mais_vendido[] = $row['nome'];
}

$data = array('months' => $months, 'total_vendido' => $total_vendido, 'produto_mais_vendido' => $produto_mais_vendido);
echo json_encode($data);

pg_close($conn);
