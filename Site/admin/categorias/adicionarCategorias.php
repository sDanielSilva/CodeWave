<?php
require_once 'db_config.php';

header("Content-Type: application/json");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['nomeCategoria']) && !empty($_POST['nomeCategoria'])) {
        $nome = $_POST['nomeCategoria'];

        try {
            $query = "INSERT INTO categoria (nome) VALUES (:nome)";
            $stmt = $db->prepare($query);
            $stmt->bindParam(':nome', $nome);
            $stmt->execute();

            echo json_encode(['success' => true]);
        } catch (PDOException $e) {
            echo json_encode(['success' => false, 'message' => "Erro na consulta SQL: " . $e->getMessage()]);
        }
    } else {
        echo json_encode(['success' => false, 'message' => "O campo nome da categoria está vazio."]);
    }
} else {
    echo json_encode(['success' => false, 'message' => "O formulário não foi submetido corretamente."]);
}
?>
