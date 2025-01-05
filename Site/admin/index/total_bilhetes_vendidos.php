<?php
include 'db_connect.php';

// Faz a consulta SQL
$sql = "SELECT COUNT(*) as total FROM bilhete";
$result = pg_query($conn, $sql);

if (!$result) {
    die("Erro na consulta a base de dados: " . pg_last_error());
}

// Verifica se há resultados
if (pg_num_rows($result) > 0) {
    // Saída dos dados de cada linha
    while ($row = pg_fetch_assoc($result)) {
        echo $row["total"];
    }
} else {
    echo "0 results";
}
pg_close($conn);
