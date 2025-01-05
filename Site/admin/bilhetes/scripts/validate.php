<?php
session_start();    
// Recebe o código do bilhete da solicitação AJAX
$codigo = $_POST['codigo'];
$id_funcionario = $_SESSION['userf_id'];

// Conexão com a base de dados
$HOST = getenv('DB_HOST');
$DATABASE = getenv('DB_NAME');
$USER = getenv('DB_USERNAME');
$PASSWORD = getenv('DB_PASSWORD');
$PORT = getenv('DB_PORT');

try {
  
    $conn = new PDO("pgsql:host=$HOST;port=$PORT;dbname=$DATABASE", $USER, $PASSWORD);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Executa a consulta para validar o bilhete
    $stmt = $conn->prepare("SELECT * FROM public.bilhete WHERE codigo = :codigo AND status = false");
    $stmt->bindParam(':codigo', $codigo);
    $stmt->execute();

    // Verifica se o bilhete é válido
    if ($stmt->rowCount() > 0) {
        // O bilhete é válido, atualiza o status para false
        $updateStmt = $conn->prepare("UPDATE public.bilhete SET status = true, data_fim = CURRENT_DATE, id_funcionario = :id_funcionario WHERE codigo = :codigo");
        $updateStmt->bindParam(':codigo', $codigo);
        $updateStmt->bindParam(':id_funcionario', $id_funcionario);
        $updateStmt->execute();

        echo "O bilhete foi validado com sucesso.";
    } else {
        echo "O bilhete não é válido.";
    }

} catch(PDOException $e) {
    echo "Erro na conexão com a base de dados: " . $e->getMessage();
}

$conn = null;
?>
