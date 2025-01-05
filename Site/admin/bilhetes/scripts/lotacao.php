<?php

// Conexão com a base de dados
$HOST = getenv('DB_HOST');
$DATABASE = getenv('DB_NAME');
$USER = getenv('DB_USERNAME');
$PASSWORD = getenv('DB_PASSWORD');
$PORT = getenv('DB_PORT');

try {

    $conn = new PDO("pgsql:host=$HOST;port=$PORT;dbname=$DATABASE", $USER, $PASSWORD);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Executa a consulta para validar o bilhete
    $stmt = $conn->prepare("SELECT COUNT(id_bilhete) AS num_bilhetes FROM public.bilhete WHERE DATE(data_inicio) = CURRENT_DATE AND status = true");
    $stmt->execute();
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    $num_bilhetes = $row['num_bilhetes'];
  
    // Seleciona a capacidade total
    $stmt = $conn->prepare("SELECT SUM(capacidade) AS capacidade_total FROM public.produto WHERE nome IN ('Bilhete completo júnior', 'Bilhete completo sénior', 'Bilhete completo normal', 'Bilhete tarde júnior', 'Bilhete tarde normal', 'Bilhete tarde sénior')");
    $stmt->execute();
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    $capacidade_total = $row['capacidade_total'];
  
    // Calcula a lotação
    $lotacao = ($num_bilhetes / $capacidade_total) * 100;


  
    // Retorna a lotação como um objeto JSON
    echo json_encode(array('lotacao' => $lotacao, 'num_bilhetes' => $capacidade_total - $num_bilhetes));
  
  } catch(PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
  }
$conn = null;
