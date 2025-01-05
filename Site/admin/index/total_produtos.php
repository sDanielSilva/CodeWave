<?php
include 'db_connect.php';

if (!$conn) {
    die("Erro na conexão com a base de dados: " . pg_last_error());
}

$sql = "SELECT COUNT(*) as total FROM produto";
$result = pg_query($conn, $sql);

if (!$result) {
    die("Erro na consulta a base de dados: " . pg_last_error());
}

if (pg_num_rows($result) > 0) {
    while ($row = pg_fetch_assoc($result)) {
        echo $row["total"];
    }
} else {
    echo "0";
}
pg_close($conn);
