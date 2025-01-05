<?php
require_once 'db_config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['nomeCargo']) && !empty($_POST['nomeCargo'])) {
        $descricao = $_POST['nomeCargo'];

        try {
            $query = "INSERT INTO cargo (descricao) VALUES (:descricao)";
            $stmt = $db->prepare($query);
            $stmt->bindParam(':descricao', $descricao);
            $stmt->execute();

            header("Location: ".$_SERVER["HTTP_REFERER"]);
            exit();
        } catch (PDOException $e) {
            header("Location: ".$_SERVER["HTTP_REFERER"]."?error=1");
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