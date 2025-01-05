<?php


include 'db_connect.php';

$periodo = isset($_GET['periodo']) ? $_GET['periodo'] : 'sempre';

switch ($periodo) {
    case 'este_mes':
        $sql = "SELECT c.nome AS categoria, SUM(cd.preco_total) AS receita_total
                FROM Categoria c
                JOIN Produto p ON c.id_categoria = p.id_categoria
                JOIN Compra_Detalhe cd ON p.id_produto = cd.id_produto
                WHERE DATE_TRUNC('month', cd.data_hora) = DATE_TRUNC('month', CURRENT_DATE)
                GROUP BY c.nome;";
        break;
    case 'este_ano':
        $sql = "SELECT c.nome AS categoria, SUM(cd.preco_total) AS receita_total
                FROM Categoria c
                JOIN Produto p ON c.id_categoria = p.id_categoria
                JOIN Compra_Detalhe cd ON p.id_produto = cd.id_produto
                WHERE DATE_TRUNC('year', cd.data_hora) = DATE_TRUNC('year', CURRENT_DATE)
                GROUP BY c.nome;";
        break;
    default:
        $sql = "SELECT c.nome AS categoria, SUM(cd.preco_total) AS receita_total
                FROM Categoria c
                JOIN Produto p ON c.id_categoria = p.id_categoria
                JOIN Compra_Detalhe cd ON p.id_produto = cd.id_produto
                GROUP BY c.nome;";
        break;
}

$result = pg_query($conn, $sql);

if (!$result) {
    die("Erro na consulta a base de dados: " . pg_last_error());
}

$categorias = array();
$total_receita = array();

while ($row = pg_fetch_assoc($result)) {
    $categorias[] = $row['categoria'];
    $total_receita[] = $row['receita_total'];
}

$data = array('categorias' => $categorias, 'total_receita' => $total_receita);
echo json_encode($data);

pg_close($conn);
?>
