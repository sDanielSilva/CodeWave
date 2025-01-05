<?php
// Verifica se o formulário foi enviado
if ($_SERVER["REQUEST_METHOD"] == "POST") {
 
    $dsn = getenv('DB_DSN');
    $username = getenv('DB_USERNAME');
    $password = getenv('DB_PASSWORD');

    try {
        $conn = new PDO($dsn, $username, $password);
  
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    
        $name = $_POST['name'];
        $email = $_POST['email'];
        $password = $_POST['pass'];
        $phone = $_POST['phone'];

        // Prepara a declaração SQL para evitar injeção de SQL
        $stmt = $conn->prepare("INSERT INTO utilizador (nome, email, password, num_telemovel) VALUES (:name, :email, :password, :phone)");

        // Substitui os parâmetros na declaração preparada e executa
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':password', $password);
        $stmt->bindParam(':phone', $phone);

        $stmt->execute();

        echo "Registo efetuado com sucesso!";
    } catch(PDOException $e) {
        echo "Erro ao registar: " . $e->getMessage();
    }

    // Fecha a conexão
    $conn = null;
}
?>
