<?php
require_once 'db_config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['nomeFuncionario']) && !empty($_POST['nomeFuncionario']) &&
        isset($_POST['emailFuncionario']) && !empty($_POST['emailFuncionario']) &&
        isset($_POST['passwordFuncionario']) && !empty($_POST['passwordFuncionario']) &&
        isset($_POST['imagemUrl']) && !empty($_POST['imagemUrl'])) {

        $nome = $_POST['nomeFuncionario'];
        $email = $_POST['emailFuncionario'];
        $password = $_POST['passwordFuncionario'];
        $imagemUrl = $_POST['imagemUrl'];

        try {
            $query = "INSERT INTO funcionario (nome, email, password, img) VALUES (:nome, :email, :password, :imagem)";
            $stmt = $db->prepare($query);
            $stmt->bindParam(':nome', $nome);
            $stmt->bindParam(':email', $email);
            $stmt->bindParam(':password', $password);
            $stmt->bindParam(':imagem', $imagemUrl);
            $stmt->execute();

            header("Location: ".$_SERVER["HTTP_REFERER"]);
            exit();
        } catch (PDOException $e) {
            echo "Erro ao inserir dados: " . $e->getMessage();
            exit();
        }
    } else {
        header("Location: ".$_SERVER["HTTP_REFERER"]."?error=empty_field");
        exit();
    }
} else {
    echo "O formulário não foi submetido.";
}
?>
