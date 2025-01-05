<?php
session_start();
$admin_prefix = 'Admin: ';
$user_name = $_SESSION['userf_name'];

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// Carrega a biblioteca PHPMailer
require './PHPMailer-master/src/Exception.php';
require './PHPMailer-master/src/PHPMailer.php';
require './PHPMailer-master/src/SMTP.php';


$HOST = getenv('DB_HOST');
$DATABASE = getenv('DB_NAME');
$USER = getenv('DB_USERNAME');
$PASSWORD = getenv('DB_PASSWORD');
$PORT = getenv('DB_PORT');

// Verifica se o formulário foi enviado
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtem os valores do formulário
    $subject = $_POST['subject'];
    $body = $_POST['body'];
    $id_utilizador = $_POST['id_utilizador'];

    try {

        $conn = new PDO("pgsql:host=$HOST;port=$PORT;dbname=$DATABASE", $USER, $PASSWORD);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Procura o e-mail do utilizador
        $stmt = $conn->prepare("SELECT email FROM utilizador WHERE id_utilizador = :id_utilizador");
        $stmt->bindParam(':id_utilizador', $id_utilizador);
        $stmt->execute();
        $user_email = $stmt->fetchColumn();

        // Configurações do servidor SMTP do Gmail
        $mail = new PHPMailer(true);
        // Configurações do servidor SMTP
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'codewaveptw@gmail.com';
        $mail->Password = 'teps kyra uimm tprv'; // Senha do email
        $mail->SMTPSecure = 'tls';
        $mail->Port = 587;

        // Remetente e destinatário
        $mail->setFrom('codewaveptw@gmail.com', $admin_prefix . ' ' . $user_name);
        $mail->addAddress($user_email, 'Utilizador');

        // Conteúdo do e-mail
        $mail->isHTML(true);
        $mail->Subject = $subject;
        $mail->Body = $body;

         // Tenta enviar o email
         if ($mail->send()) {
            // Se o email foi enviado com sucesso, define a resposta como sucesso
            $response['status'] = 'success';
        } else {
            // Se houve um erro ao enviar o email, define a resposta como erro
            $response['status'] = 'error';
        }

    } catch (PDOException $e) {
        // Em caso de erro da base de dados, define a resposta como erro
        $response['status'] = 'error';
        $response['message'] = "Erro na conexão com a base de dados: " . $e->getMessage();
    } catch (Exception $e) {
        // Em caso de erro geral, define a resposta como erro
        $response['status'] = 'error';
        $response['message'] = "Erro ao enviar o email: {$mail->ErrorInfo}";
    }
} else {
    // Se o formulário não foi enviado, define a resposta como erro
    $response['status'] = 'error';
    $response['message'] = "Erro: O formulário não foi enviado.";
}

// Retorna a resposta como JSON
header('Content-Type: application/json');
echo json_encode($response);
?>