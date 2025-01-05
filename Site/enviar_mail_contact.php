<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// Carrega a biblioteca PHPMailer
require 'admin/eventos/PHPMailer-master/src/Exception.php';
require 'admin/eventos/PHPMailer-master/src/PHPMailer.php';
require 'admin/eventos/PHPMailer-master/src/SMTP.php';

// Verifica se o formulário foi enviado
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtem os valores do formulário
    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $telemovel = $_POST['telemovel'];
    $assunto = $_POST['assunto'];
    $mensagem = $_POST['mensagem'];

    // Configurações do servidor SMTP do Gmail
    $mail = new PHPMailer(true);
    try {
        // Configurações do servidor SMTP
        $mail->isSMTP();
        $mail->Host = getenv('SMTP_HOST');
        $mail->SMTPAuth = true;
        $mail->Username = getenv('SMTP_USERNAME');
        $mail->Password = getenv('SMTP_PASSWORD');
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port = getenv('SMTP_PORT');

        // Remetente e destinatário
        $mail->setFrom('codewaveptw@gmail.com', 'Contato do Site');
        $mail->addAddress('codewaveptw@gmail.com');

        // Conteúdo do e-mail
        $mail->isHTML(true);
        $mail->Subject = $assunto;
        $mail->Body = "<html>
                            <body>
                                <h2>Formulário de Contato</h2>
                                <p><strong>Nome:</strong> $nome</p>
                                <p><strong>Email:</strong> $email</p>
                                <p><strong>Número de telemovel:</strong> $telemovel</p>
                                <p><strong>Assunto:</strong> $assunto</p>
                                <p><strong>Mensagem:</strong></p>
                                <p>$mensagem</p>
                            </body>
                          </html>";

        // Envia o e-mail
        $mail->send();
    } catch (Exception $e) {
        $error_message = urlencode("Erro ao enviar email: {$mail->ErrorInfo}. Exception: {$e->getMessage()}");
        header("Location: contact.php?error={$error_message}");
    }

    header('Location: contact.php');
    exit();
}
?>