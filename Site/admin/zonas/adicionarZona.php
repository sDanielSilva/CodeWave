<?php
require_once 'db_config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['nomeZona']) && !empty($_POST['nomeZona'])) {
        $nome = $_POST['nomeZona'];

        try {
            $query = "INSERT INTO zona (nome) VALUES (:nome)";
            $stmt = $db->prepare($query);
            $stmt->bindParam(':nome', $nome);
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