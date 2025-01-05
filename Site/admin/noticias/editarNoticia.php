<?php
require_once 'db_config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id_noticia = isset($_POST['edit_id_noticia']) ? $_POST['edit_id_noticia'] : '';
    $titulo = isset($_POST['edit_tituloNoticia']) ? htmlspecialchars($_POST['edit_tituloNoticia']) : '';
    $descricao = isset($_POST['edit_descricaoNoticia']) ? htmlspecialchars($_POST['edit_descricaoNoticia']) : '';
    $imagem = isset($_POST['edit_imagemUrl']) ? $_POST['edit_imagemUrl'] : '';

    try {
        $conn = new PDO("pgsql:host=$host;port=$port;dbname=$dbname", $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $sql = "UPDATE public.noticias SET titulo_noticia = ?, descricao_noticia = ?, imagem_capa = ? WHERE id_noticia = ?";
        $stmt = $conn->prepare($sql);
        $stmt->execute([$titulo, $descricao, $imagem, $id_noticia]);

        header("Location: ../noticias.php?msg=sucesso");
        exit();
    } catch(PDOException $e) {
        header("Location: ../noticias.php?msg=erro&detalhes=" . urlencode($e->getMessage()));
        exit();
    } finally {
        $conn = null;
    }
} else {
    echo "Erro: o formulário não foi enviado.";
}
?>
