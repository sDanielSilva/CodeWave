<?php
// Conexão com a base de dados
require_once 'db_config.php';

$noticias_por_pagina = 7;
$pagina_atual = isset($_GET['pagina']) ? (int)$_GET['pagina'] : 1;
$primeira_noticia = ($pagina_atual - 1) * $noticias_por_pagina;

try {
    $conn = new PDO("pgsql:host=$host;port=$port;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
    echo 'Erro de conexão: ' . $e->getMessage();
    exit;
}

$sql = "SELECT 
            e.id_evento,
            e.data_inicio,
            e.data_fim,
            e.tipo,
            e.descricao,
            e.num_convidados,
            e.id_utilizador,
            u.nome AS nome_utilizador,
            e.id_zona,
            z.nome AS nome_zona,
            e.aprovado
        FROM 
            public.evento e
        INNER JOIN 
            public.utilizador u ON e.id_utilizador = u.id_utilizador
        INNER JOIN 
            public.zona z ON e.id_zona = z.id_zona
        ORDER BY e.id_evento ASC
        LIMIT ? OFFSET ?";

try {
    $stmt = $conn->prepare($sql);
    $stmt->bindValue(1, $noticias_por_pagina, PDO::PARAM_INT);
    $stmt->bindValue(2, $primeira_noticia, PDO::PARAM_INT);
    $stmt->execute();

    $eventos = array();
    if ($stmt->rowCount() > 0) {
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $eventos[] = array(
                'id_evento' => htmlspecialchars($row['id_evento']),
                'data_inicio' => htmlspecialchars($row['data_inicio']),
                'data_fim' => htmlspecialchars($row['data_fim']),
                'tipo' => htmlspecialchars($row['tipo']),
                'descricao' => htmlspecialchars($row['descricao']),
                'num_convidados' => htmlspecialchars($row['num_convidados']),
                'id_utilizador' => htmlspecialchars($row['id_utilizador']),
                'nome_utilizador' => htmlspecialchars($row['nome_utilizador']),
                'id_zona' => htmlspecialchars($row['id_zona']),
                'nome_zona' => htmlspecialchars($row['nome_zona']),
                'aprovado' => $row['aprovado']
            );
        }
    }

    // Consulta para contar o total de eventos
    $query = "SELECT COUNT(*) AS total FROM public.evento";
    $stmt = $conn->prepare($query);
    $stmt->execute();
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    $total_eventos = $row['total'];

    // Retorna os dados como JSON
    header('Content-Type: application/json');
    echo json_encode(array(
        'eventos' => $eventos,
        'total' => $total_eventos
    ));
} catch (PDOException $e) {
    die("Erro na consulta a base de dados: " . $e->getMessage());
}
?>
