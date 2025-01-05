<?php
// Conexão com a base de dados
$host = getenv('DB_HOST');
$dbname = getenv('DB_NAME');
$username = getenv('DB_USERNAME');
$password = getenv('DB_PASSWORD');
$port = getenv('DB_PORT');

try {
    $conn = new PDO("pgsql:host=$host;port=$port;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
    echo 'Erro de conexão: ' . $e->getMessage();
}

// Verifica se foi enviado um ID de evento via POST
if(isset($_POST['id_evento'])) {
    $id_evento = $_POST['id_evento'];

    // Atualiza o status de aprovação do evento para TRUE
    $sql = "UPDATE public.evento SET aprovado = TRUE WHERE id_evento = :id_evento";

    try {
        // Prepara e executa a consulta
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':id_evento', $id_evento);
        $stmt->execute();

        // Retorna uma resposta a indicar sucesso
       header('Location: ../eventos.php?status=success');
    } catch(PDOException $e) {
        echo 'Erro ao aprovar o evento: ' . $e->getMessage();
    }
} else {
    echo "ID do evento não fornecido.";
}
?>
