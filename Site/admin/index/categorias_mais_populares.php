<?php

include 'db_connect.php';

$periodo = $_GET['periodo'];
if ($periodo == 'este_mes') {
  $sql = "SELECT DATE_TRUNC('month', compra_detalhe.data_hora) as month, categoria.nome, SUM(compra_detalhe.quantidade) as total_vendido
  FROM categoria
  JOIN produto ON categoria.id_categoria = produto.id_categoria
  JOIN compra_detalhe ON produto.id_produto = compra_detalhe.id_produto
  WHERE DATE_TRUNC('month', compra_detalhe.data_hora) = DATE_TRUNC('month', CURRENT_DATE)
  GROUP BY month, categoria.nome
  ORDER BY total_vendido DESC;";
} elseif ($periodo == 'este_ano') {
  $sql = "SELECT DATE_TRUNC('year', compra_detalhe.data_hora) as year, categoria.nome, SUM(compra_detalhe.quantidade) as total_vendido
  FROM categoria
  JOIN produto ON categoria.id_categoria = produto.id_categoria
  JOIN compra_detalhe ON produto.id_produto = compra_detalhe.id_produto
  WHERE DATE_TRUNC('year', compra_detalhe.data_hora) = DATE_TRUNC('year', CURRENT_DATE)
  GROUP BY year, categoria.nome
  ORDER BY total_vendido DESC;";
} else {
  $sql = "SELECT categoria.nome, SUM(compra_detalhe.quantidade) as total_vendido
  FROM categoria
  JOIN produto ON categoria.id_categoria = produto.id_categoria
  JOIN compra_detalhe ON produto.id_produto = compra_detalhe.id_produto
  GROUP BY categoria.nome
  ORDER BY total_vendido DESC;";
}

$result = pg_query($conn, $sql);

if (!$result) {
  die("Erro na consulta a base de dados: " . pg_last_error());
}

$categorias = array();
$total_vendido = array();

while ($row = pg_fetch_assoc($result)) {
  $categorias[] = $row['nome'];
  $total_vendido[] = $row['total_vendido'];
}

$data = array('categorias' => $categorias, 'total_vendido' => $total_vendido);
echo json_encode($data);

pg_close($conn);
