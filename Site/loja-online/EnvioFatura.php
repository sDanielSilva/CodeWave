<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require_once('TCPDF/tcpdf.php');

// Limpe qualquer saída anterior
ob_end_clean();
ob_start();

// Crie uma nova instância do TCPDF
$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

// Defina as informações do documento
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('Codewave');
$pdf->SetTitle('Fatura ' . $uniqueId);
$pdf->SetSubject('Fatura Gerada');
$pdf->SetKeywords('PDF, fatura, Codewave, compra, loja online');

// Remova cabeçalhos e rodapés automáticos
$pdf->setPrintHeader(false);
$pdf->setPrintFooter(false);

// Adicione uma página
$pdf->AddPage();

// Defina a fonte
$pdf->SetFont('helvetica', '', 12);~

$imagePath = '..\images\codewave_logo.png';

// Conteúdo da fatura
$html = '
        <div style="text-align: left;">
            <img src="' . $imagePath . '" alt="Logo" width="150" height="auto" />
            <h1>Fatura '. $uniqueId .'</h1>
        </div>
        <div style="text-align: left;">
            <p>Data: ' . $data_hora . '</p>
            <p>Nome do Cliente: ' . $user_name . '</p>
            <p>Email do Cliente: ' . $user_email . '</p>
            <p>Morada de Entrega: ' . $morada_entrega . '</p>
            <p>Tipo de Pagamento: ' . $tipo_pagamento . '</p>
        </div>
        <h2>Detalhes dos Produtos</h2>
        <table border="1" cellpadding="5">
            <tr>
                <th>Produto ID</th>
                <th>Nome do Produto</th>
                <th>Quantidade</th>
                <th>Subtotal</th>
            </tr>
        ';

try {
    // Configurações de conexão com a base de dados
    $host = getenv('DB_HOST');
    $dbname = getenv('DB_NAME');
    $username = getenv('DB_USERNAME');
    $password = getenv('DB_PASSWORD');
    $port = getenv('DB_PORT');

    // DSN para o PDO
    $dsn = "pgsql:host=$host;port=$port;dbname=$dbname;user=$username;password=$password";

    // Conexão PDO com a base de dados
    $pdo = new PDO($dsn);

    // Definindo o modo de erros do PDO para lançar exceções em caso de erros
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Consulta SQL para procurar os nomes dos produtos com base nos IDs fornecidos
    $sql = "SELECT id_produto, nome FROM produto WHERE id_produto IN (" . implode(",", $ids_produto) . ")";

    // Preparar e executar a consulta
    $stmt = $pdo->query($sql);

    // Extrair os resultados da consulta
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        $produto_id = $row['id_produto'];
        $produto_nome = $row['nome'];
        $indice = array_search($produto_id, $ids_produto);
        $html .= '
        <tr>
            <td>' . $produto_id . '</td>
            <td>' . $produto_nome . '</td>
            <td>' . $quantidades[$indice] . '</td>
            <td>' . $precos_totais_detalhe[$indice] . '</td>
        </tr>';
    }
} catch (PDOException $e) {
    // Lidar com erros de conexão ou consulta
    die("Erro na conexão com a base de dados: " . $e->getMessage());
} finally {
    // Fechar a conexão com a base de dados
    $pdo = null;
}

$html .= '
</table>
<h3>Total: €' . number_format($preco_total, 2, ',', '.') . '</h3>';

// Escreva o conteúdo HTML na página PDF
$pdf->writeHTML($html, true, false, true, false, '');

// Defina o caminho absoluto do arquivo PDF
$dir = __DIR__ . "/Faturas";
if (!is_dir($dir)) {
    mkdir($dir, 0777, true);
}
$path = "$dir/fatura_$uniqueId.pdf";


// Guarda o arquivo PDF no servidor
$pdf->Output($path, 'F');

// Limpa o buffer de saída
ob_end_flush();

$mailFatura = new PHPMailer(true);

try {
    // Configurações do servidor SMTP
    $mailFatura->isSMTP();
    $mailFatura->Host = 'smtp.gmail.com';
    $mailFatura->SMTPAuth = true;
    $mailFatura->Username = 'codewaveptw@gmail.com';
    $mailFatura->Password = 'teps kyra uimm tprv'; // Nova senha do aplicativo
    $mailFatura->SMTPSecure = 'tls';
    $mailFatura->Port = 587;

    // Remetente e destinatário
    $mailFatura->setFrom('codewaveptw@gmail.com', 'Loja Codewave');
    $mailFatura->addAddress($user_email, $user_name);

    // Anexar a fatura em PDF
    $mailFatura->addAttachment($path, "fatura_$uniqueId.pdf");

    // Conteúdo do e-mail
    $mailFatura->isHTML(true);
    $mailFatura->CharSet = 'UTF-8';
    $mailFatura->Subject = 'Compra CodeWave';
    $mailFatura->Body = 'Prezado cliente, <br><br> Em anexo está a fatura referente à sua compra. <br><br> Atenciosamente, <br> CodeWave';

    // Enviar email
    $mailFatura->send();
    echo 'Email enviado com sucesso';
} catch (Exception $e) {
    echo "Erro ao enviar o email: {$mailFatura->ErrorInfo}";
}

echo'<script> window.location.href = "finalCarrinho.html"; </script>';