<?php
require_once 'db_config.php';

// Carrega a biblioteca PHPMailer
require '../eventos/PHPMailer-master/src/Exception.php';
require '../eventos/PHPMailer-master/src/PHPMailer.php';
require '../eventos/PHPMailer-master/src/SMTP.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Valida e sanitiza os dados recebidos do formulário
    $imagem = isset($_POST['imagemUrl']) ? $_POST['imagemUrl'] : '';
    $titulo = isset($_POST['titulo']) ? $_POST['titulo'] : '';
    $funcionario = isset($_POST['funcionario']) ? $_POST['funcionario'] : '';
    $descricao = isset($_POST['descricao']) ? $_POST['descricao'] : '';

    // Se nenhuma imagem foi enviada, usa a imagem padrão
    if (empty($imagem)) {
        $imagem = "https://i.imgur.com/lIAac6h.jpeg";
    }

    try {
        $conn = new PDO("pgsql:host=$host;port=$port;dbname=$dbname", $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Prepara a instrução SQL para inserir a notícia na tabela
        $sql = "INSERT INTO public.noticias (imagem_capa, titulo_noticia, funcionario_criador, descricao_noticia, data_hora) VALUES (?, ?, ?, ?, date_trunc('minute', current_timestamp))";
        $stmt = $conn->prepare($sql);

        // Executa a instrução SQL
        $stmt->execute([$imagem, $titulo, $funcionario, $descricao]);

        echo "Notícia inserida com sucesso.";

        // Configurações do servidor SMTP do Gmail
        $mail = new PHPMailer(true);
        try {
            // Configurações do servidor SMTP
            $mail->isSMTP();
            $mail->Host       = 'smtp.gmail.com';
            $mail->SMTPAuth   = true;
            $mail->Username   = 'codewaveptw@gmail.com';
            $mail->Password   = 'teps kyra uimm tprv';
            $mail->SMTPSecure = 'tls';
            $mail->Port       = 587;
            $mail->CharSet = 'UTF-8';

            // Define o prefixo do administrador e nome do utilizador
            $admin_prefix = 'Newsletter Codewave - Notícia';

            // Remetente
            $mail->setFrom('codewaveptw@gmail.com', $admin_prefix);

            // Consulta SQL para selecionar todos os utilizadores com newsletter verdadeira
            $sql = "SELECT id_utilizador, nome, email FROM utilizador WHERE newsletter = true";
            // Execute a consulta
            $resultado = $conn->query($sql);

            // Verifica se a consulta foi bem-sucedida
            if ($resultado) {
                // Loop através dos resultados
                while ($linha = $resultado->fetch(PDO::FETCH_ASSOC)) {
                    // Adiciona destinatário
                    $mail->addAddress($linha['email'], $linha['nome']);

                    // Conteúdo do e-mail
                    $mail->isHTML(true);
                    $mail->Subject = "Nova Notícia: " . $titulo;
                    $mail->Body    = "<h1>" . $titulo . "</h1>"
                        . "<p>" . $descricao . "</p>"
                        . "<p>Por: " . $funcionario . "</p>"
                        . "<p>Data: " . date('Y-m-d H:i:s') . "</p>";

                    // Envia o email
                    $mail->send();

                    // Limpa os destinatários para o próximo e-mail
                    $mail->clearAddresses();
                }
                header('Location: ../noticias.php');
                exit;
            } else {
                echo 'Erro ao executar a consulta para envio de e-mails.';
            }
        } catch (Exception $e) {
            echo "Erro ao enviar o email: {$e->getMessage()}";
        }
    } catch (PDOException $e) {
        echo 'Erro de conexão ou na consulta: ' . $e->getMessage();
    } finally {
        // Fecha a conexão com a base de dados
        $conn = null;
    }
} else {
    echo "Erro: o formulário não foi enviado.";
}
