<?php
include 'db_connect.php';
$sql = "SELECT AVG(num_convidados) as media_convidados FROM Evento";
$result = pg_query($conn, $sql);

if (!$result) {
    die("Erro na consulta a base de dados: " . pg_last_error());
}

if (pg_num_rows($result) > 0) {
    while ($row = pg_fetch_assoc($result)) {
        echo round($row["media_convidados"], 2);
    }
} else {
    echo "0";
}
pg_close($conn);
