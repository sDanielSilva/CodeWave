<?php
session_start();


use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '../admin/eventos/PHPMailer-master/src/Exception.php';
require '../admin/eventos/PHPMailer-master/src/PHPMailer.php';
require '../admin/eventos/PHPMailer-master/src/SMTP.php';

include './phpqrcode/qrlib.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {


    error_log(print_r($_POST, true));
    // Capturar os valores do formulário
    $morada_entrega = isset($_POST['morada_entrega']) ? $_POST['morada_entrega'] : '';
    $id_utilizador = isset($_POST['id_utilizador']) ? $_POST['id_utilizador'] : '';
    $preco_total = isset($_POST['preco_total']) ? $_POST['preco_total'] : 0;
    $tipo_pagamento = isset($_POST['tipo_pagamento']) ? $_POST['tipo_pagamento'] : '';
    $data_hora = isset($_POST['data_hora']) ? $_POST['data_hora'] : '';
    $quantidades = isset($_POST['quantidade']) ? $_POST['quantidade'] : array();
    $ids_produto = isset($_POST['id_produto']) ? $_POST['id_produto'] : array();
    $precos_totais_detalhe = isset($_POST['subtotal_produto']) ? $_POST['subtotal_produto'] : array();
    $data_fim = isset($_POST['data_fim']) ? $_POST['data_fim'] : '';
    $data_inicio = isset($_POST['data_inicio']) ? $_POST['data_inicio'] : '';
    $nome_produto = isset($_POST['nome_produto']) ? $_POST[''] :

        $user_name = $_SESSION['user_name'];
    $user_email = $_SESSION['user_email'];

    $uniqueId = uniqid();

    // Depois de capturar os valores do formulário
    $id_produto = isset($_POST['id_produto']) ? $_POST['id_produto'] : array();

    // Imprima os valores de id_produto para depuração
    error_log(print_r($id_produto, true));


    // Conectar a base de dados
    $host = getenv('DB_HOST');
    $dbname = getenv('DB_NAME');
    $username = getenv('DB_USERNAME');
    $password = getenv('DB_PASSWORD');
    $port = getenv('DB_PORT');

    try {
        $pdo = new PDO("pgsql:host=$host;port=$port;dbname=$dbname", $username, $password);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Iniciar transação
        $pdo->beginTransaction();

        // Primeiro insert
        $stmt1 = $pdo->prepare("INSERT INTO Compra (morada_entrega, id_utilizador) VALUES (?, ?) RETURNING id_compra");
        $stmt1->execute([$morada_entrega, $id_utilizador]);
        $id_compra = $stmt1->fetchColumn();

        // Segundo insert
        $stmt2 = $pdo->prepare("INSERT INTO Pagamento (preco_total, tipo_pagamento, id_compra) VALUES (?, ?, ?) RETURNING id_pagamento, id_compra");
        $stmt2->execute([$preco_total, $tipo_pagamento, $id_compra]);
        $result = $stmt2->fetch(PDO::FETCH_ASSOC);
        $id_pagamento = $result['id_pagamento'];
        $id_compra_from_pagamento = $result['id_compra'];

        // Terceiro insert para cada produto
        $stmt3 = $pdo->prepare("INSERT INTO Compra_Detalhe (data_hora, quantidade, preco_total, id_produto, id_compra) VALUES (?, ?, ?, ?, ?)");


        $stmt4 = $pdo->prepare("INSERT INTO Aluguer (quantidade, hora_inicio, hora_fim, id_produto, id_compra) VALUES (?, ?, ?, ?, ?)");

        $stmt_bilhete = $pdo->prepare("INSERT INTO Bilhete (data_inicio, tipo, codigo, status, preco, id_funcionario, id_produto, data_compra, id_utilizador) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");

        foreach ($quantidades as $index => $quantidade) {
            $id_produto = $ids_produto[$index];
            $preco_total_detalhe = $precos_totais_detalhe[$index];

            $hora_inicio = isset($_SESSION['carrinho'][$index]['hora_inicio']) ? $_SESSION['carrinho'][$index]['hora_inicio'] . ':00' : null;
            $hora_fim = isset($_SESSION['carrinho'][$index]['hora_fim']) ? $_SESSION['carrinho'][$index]['hora_fim'] . ':00' : null;
            $data_inicio = isset($_SESSION['carrinho'][$index]['data_inicio']) ? $_SESSION['carrinho'][$index]['data_inicio'] . ':00' : null;
            $data_fim = isset($_SESSION['carrinho'][$index]['data_fim']) ? $_SESSION['carrinho'][$index]['data_fim'] . ':00' : null;

            // Obtenha o produto atual a partir da sessão do carrinho
            $product = $_SESSION['carrinho'][$index];

            $status_bilhete = false; // Exemplo de status (verdadeiro para ativo)
            $preco_bilhete = floatval($product['preco']);
            $id_funcionario_bilhete = 7; // Id do funcionário, por exemplo, pode ser obtido da sessão
            $id_produto_bilhete = $product['id_produto'];

            // Convertendo a data atual para um timestamp sem informação de fuso horário
            $data_compra_bilhete = date('Y-m-d H:i:s');
            $timestamp = strtotime($data_compra_bilhete);
            $data_compra_bilhete_timestamp = date('Y-m-d H:i:s', $timestamp);

            // Lista de sintaxes específicas
            $bilhete_sintaxes = [
                "Bilhete completo júnior",
                "Bilhete completo normal",
                "Bilhete completo sénior",
                "Bilhete manhã júnior",
                "Bilhete manhã normal",
                "Bilhete manhã sénior",
                "Bilhete tarde júnior",
                "Bilhete tarde normal",
                "Bilhete tarde sénior"
            ];

            // Verifica se o nome do produto contém qualquer uma das sintaxes especificadas
            foreach ($bilhete_sintaxes as $sintaxe) {
                if (strpos($product['nome'], $sintaxe) !== false) {
                    // Define o tipo de bilhete como a sintaxe correspondente
                    $tipo_bilhete = $sintaxe;

                    // Extrair a data entre parênteses
                    preg_match('/\((.*?)\)/', $product['nome'], $matches);
                    $data_inicio_bilhete = isset($matches[1]) ? $matches[1] : null;

                    // Converter a data do formato "dd-mm-yyyy" para "yyyy-mm-dd"
                    $data_inicio_bilhete = implode('-', array_reverse(explode('-', $data_inicio_bilhete)));

                    for ($i = 0; $i < $quantidade; $i++) {
                        $codigo_bilhete = rand(00000, 99999); // Gera um código aleatório para o bilhete
                        $stmt_bilhete->execute([$data_inicio_bilhete, $tipo_bilhete, $codigo_bilhete, $status_bilhete ? 't' : 'f', $preco_bilhete, $id_funcionario_bilhete, $id_produto_bilhete, $data_compra_bilhete_timestamp, $id_utilizador]);
                    }


                    $query = "
                            SELECT 
                                id_bilhete, 
                                data_inicio, 
                                data_fim, 
                                tipo, 
                                codigo, 
                                status, 
                                preco, 
                                id_funcionario, 
                                id_produto, 
                                data_compra, 
                                id_utilizador
                            FROM 
                                public.bilhete
                            WHERE 
                                data_compra = (
                                    SELECT MAX(data_compra)
                                    FROM public.bilhete
                                )
                            AND
                                id_utilizador = :user_id 
                            AND 
                                status = false
                        ";

                    $stmt6 = $pdo->prepare($query);
                    $stmt6->bindParam(':user_id', $id_utilizador, PDO::PARAM_INT);
                    $stmt6->execute();
                    $bilhetes = $stmt6->fetchAll(PDO::FETCH_ASSOC);


                    // Preparar o conteúdo do email
                    $body = "<h1>Bilhete(s) Comprado(s)</h1>";
                    if (count($bilhetes) > 0) {
                        $body .= "<ul>";
                        foreach ($bilhetes as $index => $bilhete) {
                            $body .= "Data Início: {$bilhete['data_inicio']}<br>";
                            $body .= "Tipo: {$bilhete['tipo']}<br>";
                            $body .= "Preço: {$bilhete['preco']}<br>";
                            $body .= "Data da Compra: {$bilhete['data_compra']}<br>";

                            // Gerar QR Code para o código do bilhete
                            $qrCodeFileName = "QRcodes/qrcode_{$bilhete['codigo']}.png";
                            QRcode::png($bilhete['codigo'], $qrCodeFileName);

                            // Adicionar o QR Code ao corpo do email
                            $body .= "<img src='cid:qrCode{$bilhete['codigo']}' alt='QR Code'><br>";

                            $body .= "</li><br>";
                        }
                        $body .= "</ul>";
                    }

                    // Enviar email usando PHPMailer
                    $mail = new PHPMailer(true);
                    try {
                        // Configurações do servidor SMTP
                        $mail->isSMTP();
                        $mail->Host = 'smtp.gmail.com';
                        $mail->SMTPAuth = true;
                        $mail->Username = 'codewaveptw@gmail.com';
                        $mail->Password = 'teps kyra uimm tprv'; // Nova senha do aplicativo
                        $mail->SMTPSecure = 'tls';
                        $mail->Port = 587;

                        // Remetente e destinatário
                        $mail->setFrom('codewaveptw@gmail.com', 'NoReply');
                        $mail->addAddress($user_email, $user_name);

                        // Conteúdo do e-mail
                        $mail->isHTML(true);
                        $mail->CharSet = 'UTF-8';
                        $mail->Subject = 'Bilhetes Comprados';
                        $mail->Body = $body;

                        // Adicionar os anexos dos QR Codes
                        foreach ($bilhetes as $index => $bilhete) {
                            $qrCodeFileName = "QRcodes/qrcode_{$bilhete['codigo']}.png";
                            $mail->addEmbeddedImage($qrCodeFileName, "qrCode{$bilhete['codigo']}");
                        }

                        // Enviar email
                        $mail->send();
                        echo 'Email enviado com sucesso';
                    } catch (Exception $e) {
                        echo "Erro ao enviar o email: {$mail->ErrorInfo}";
                    }
                }
            }

            // Verifica se o produto é um aluguer
            if (isset($product['isRental']) && $product['isRental'] === "true") {
                // Se for um aluguer, calcula o subtotal com base nas horas
                $horas = $product['horas'];

                // Debug: Print the product data to the error log
                error_log(print_r($product, true));

                $preco_total_detalhe = number_format(floatval($product['preco']) * floatval($quantidade) * floatval($horas), 2, '.', '');

                // Inserir o novo registo na tabela aluguer
                $stmt4->execute([$quantidade, $hora_inicio, $hora_fim, $id_produto, $id_compra]);
            }

            file_put_contents('C:/Users/danim/Desktop/log.txt', "FORA data_inicio: " . $data_inicio . "\n", FILE_APPEND);
            file_put_contents('C:/Users/danim/Desktop/log.txt', "FORA hora_fim: " . $data_fim . "\n", FILE_APPEND);

            if (isset($product['isAlojamento']) && $product['isAlojamento'] === "true") {

                file_put_contents('C:/Users/danim/Desktop/log.txt', "DENTRO data_inicio: " . $data_inicio . "\n", FILE_APPEND);
                file_put_contents('C:/Users/danim/Desktop/log.txt', "DENTRO hora_fim: " . $data_fim . "\n", FILE_APPEND);
                // Se for um alojamento, insere na tabela "aluguer"
                $stmt4->execute([$quantidade, $data_inicio, $data_fim, $id_produto, $id_compra]);
            }

            $stmt3->execute([$data_hora, $quantidade, $preco_total_detalhe, $id_produto, $id_compra]);
        }



        // Commit da transação
        $pdo->commit();

        //echo "<script>alert('Encomenda finalizada com sucesso!'); window.location.href = 'index.php';</script>";
        require_once 'limpar_carrinho.php';
    } catch (Exception $e) {
        // Rollback da transação em caso de erro
        $pdo->rollBack();
        echo "Erro ao finalizar encomenda: " . $e->getMessage();
    } finally {
        // Fechar a conexão
        $pdo = null;
    }


    require_once 'EnvioFatura.php';


}