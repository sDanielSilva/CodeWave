<?php
setlocale(LC_TIME, 'pt_BR', 'pt_BR.utf-8', 'portuguese');

// Conexão com a base de dados
$host = getenv('DB_HOST');
$dbname = getenv('DB_NAME');
$username = getenv('DB_USERNAME');
$password = getenv('DB_PASSWORD');
$port = getenv('DB_PORT');

try {
    // Estabelece conexão com a base de dados
    $conn = new PDO("pgsql:host=$host;port=$port;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Consulta SQL para selecionar os alertas mais recentes da tabela de alertas
    $sql = "SELECT * FROM public.alertas ORDER BY data DESC LIMIT 5"; // Seleciona os 5 alertas mais recentes

    // Prepara e executa a consulta
    $stmt = $conn->prepare($sql);
    $stmt->execute();

    // Exibe os alertas
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        // Formata a data do alerta em português
        $data_alerta = strftime("%e de %B de %Y", strtotime($row['data']));

        // Gera HTML para o alerta
        echo '<a class="dropdown-item d-flex align-items-center" href="#">
                <div class="me-3">
                    <div class="bg-warning icon-circle"><i class="fas fa-exclamation-triangle text-white"></i></div>
                </div>
                <div>
                    <span class="small text-gray-500">' . $data_alerta . '</span>
                    <p>' . $row['mensagem'] . '</p>
                </div>
            </a>';
    }

} catch(PDOException $e) {
    echo 'Erro de conexão: ' . $e->getMessage();
}
?>
