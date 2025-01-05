<?php
require_once 'db_config.php';

try {

    $db = new PDO("pgsql:host=$host;port=$port;dbname=$dbname", $username, $password);

    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    // Consulta SQL para contar o número total de feedbacks
    $query = "SELECT COUNT(*) AS total FROM feedback";
    $stmt = $db->prepare($query);
    $stmt->execute();
    // Verifica se a consulta foi bem-sucedida
    if ($stmt) {
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        // Verifica se o resultado está disponível
        if ($result) {
            $totalFeedback = $result['total'];
            echo $totalFeedback; // Exibe o total de cargos
        } else {
            $totalFeedback = 0;
        }
    } else {
        $totalFeedback = 0;
    }
} catch (PDOException $e) {
    // Em caso de erro na conexão ou na consulta SQL, exibe mensagem de erro e interrompe o script
    die("Erro na conexão com a base de dados: " . $e->getMessage());
}
?>
