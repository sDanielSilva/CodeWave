<?php
session_start();

$admin_prefix = 'Funcionario: ';
$user_name = $_SESSION['userf_name'];

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
// Carrega a biblioteca PHPMailer
require '../eventos/PHPMailer-master/src/Exception.php';
require '../eventos/PHPMailer-master/src/PHPMailer.php';
require '../eventos/PHPMailer-master/src/SMTP.php';
$data = json_decode(file_get_contents('php://input'), true);
$id_aluguer = $data['id_aluguer'];
$id_funcionario = $data['id_funcionario'];

$HOST = getenv('DB_HOST');
$DATABASE = getenv('DB_NAME');
$USER = getenv('DB_USERNAME');
$PASSWORD = getenv('DB_PASSWORD');
$PORT = getenv('DB_PORT');
try {

    $conn = new PDO("pgsql:host=$HOST;port=$PORT;dbname=$DATABASE", $USER, $PASSWORD);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    // Procura o e-mail do utilizador que fez o aluguer
    $stmt = $conn->prepare("SELECT utilizador.email FROM aluguer JOIN compra ON aluguer.id_compra = compra.id_compra JOIN utilizador ON compra.id_utilizador = utilizador.id_utilizador WHERE aluguer.id_aluguer = :id_aluguer");
    $stmt->bindParam(':id_aluguer', $id_aluguer);
    $stmt->execute();
    $user_email = $stmt->fetchColumn();
    $verification_code = $data['verificationCode'];
    // Armazena o código de verificação na sessão
    $_SESSION['verification_code'] = $verification_code;
    // Configurações do servidor SMTP do Gmail
    $mail = new PHPMailer(true);
    try {
        // Configurações do servidor SMTP
        $mail->isSMTP();
        $mail->Host       = getenv('SMTP_HOST');
        $mail->SMTPAuth   = true;
        $mail->Username   = getenv('SMTP_USERNAME');
        $mail->Password   = getenv('SMTP_PASSWORD');
        $mail->SMTPSecure = 'tls';
        $mail->Port       = getenv('SMTP_PORT');
        // Remetente e destinatário
        $mail->setFrom('codewaveptw@gmail.com', $admin_prefix . ' ' . $user_name);
        $mail->addAddress($user_email, 'Utilizador');
        // Conteúdo do e-mail
        $mail->isHTML(true);
        $mail->Subject = 'Codigo de Verificacao';
        $mail->Body    = 'O seu codigo de verificacao para levantamento do aluguer e: ' . $verification_code;
        // Enviar email
        $mail->send();
        echo json_encode(['message' => 'Email enviado com sucesso']);
    } catch (Exception $e) {
        echo json_encode(['error' => "Erro ao enviar o email: {$mail->ErrorInfo}"]);
    }
} catch (PDOException $e) {
    echo "Erro na conexão com a base de dados: " . $e->getMessage();
}
$conn = null;
