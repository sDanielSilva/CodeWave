<?php
require_once 'db_config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['nomeFuncionario']) && !empty($_POST['nomeFuncionario']) &&
        isset($_POST['emailFuncionario']) && !empty($_POST['emailFuncionario']) &&
        isset($_POST['passwordFuncionario']) && !empty($_POST['passwordFuncionario']) &&
        isset($_POST['imagemUrl']) && !empty($_POST['imagemUrl']) &&
        isset($_POST['cargo_funcionario']) && !empty($_POST['cargo_funcionario'])) {

        $nome = $_POST['nomeFuncionario'];
        $email = $_POST['emailFuncionario'];
        $password = md5($_POST['passwordFuncionario']);
        $imagemUrl = $_POST['imagemUrl'];
        $cargo = $_POST['cargo_funcionario'];
        $dataAtual = date("Y-m-d");

        try {
            $db->beginTransaction();

            // Insere na tabela funcionario
            $queryFuncionario = "INSERT INTO funcionario (nome, email, password, img) VALUES (:nome, :email, :password, :imagem)";
            $stmtFuncionario = $db->prepare($queryFuncionario);
            $stmtFuncionario->bindParam(':nome', $nome);
            $stmtFuncionario->bindParam(':email', $email);
            $stmtFuncionario->bindParam(':password', $password);
            $stmtFuncionario->bindParam(':imagem', $imagemUrl);
            $stmtFuncionario->execute();

            // Recupera o id_funcionario inserido
            $idFuncionario = $db->lastInsertId();

            // Insere na tabela progressao
            $queryProgressao = "INSERT INTO progressao (id_funcionario, id_cargo, ano_inicio) VALUES (:id_funcionario, :id_cargo, :ano_inicio)";
            $stmtProgressao = $db->prepare($queryProgressao);
            $stmtProgressao->bindParam(':id_funcionario', $idFuncionario);
            $stmtProgressao->bindParam(':id_cargo', $cargo);
            $stmtProgressao->bindParam(':ano_inicio', $dataAtual);
            $stmtProgressao->execute();

            $db->commit();

            header("Location: " . $_SERVER["HTTP_REFERER"]);
            exit();
        } catch (PDOException $e) {
            $db->rollBack();
            echo "Erro ao inserir dados: " . $e->getMessage();
            exit();
        }
    } else {
        header("Location: " . $_SERVER["HTTP_REFERER"] . "?error=empty_field");
        exit();
    }
} else {
    echo "O formulário não foi submetido.";
}
?>
